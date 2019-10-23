<?php

namespace App\Http\Controllers\Store;

use App\Classes\Modules\Branches;
use App\Classes\Modules\Users;
use App\Classes\Modules\WishList;
use App\Http\Controllers\ParentController;
use App\Classes\Modules\Manufacturers;
use App\Classes\Modules\Offers;
use App\Classes\Modules\Cart;
use App\Classes\Modules\Products;
use App\Classes\Modules\Ads;
use App\Classes\Modules\Compare;

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class StoreController extends ParentController
{
    function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->setActiveLang();
        // Manufacturers
        $manufacturerIterator = Manufacturers::getAll([
                    "application_id" => 1,
                    "module_id" => 8,
                    "action" => "depts_search",
                    "core_dept_id" => 5,
                    "lang_id" => $this->activeLang
                    ], ['limit' => 20]);
        $manufacturers = iterator_to_array($manufacturerIterator);

        // Home Offers
        $offersIterator = Offers::getHomeOffers(["lang_id" => $this->activeLang]);
        $offers = iterator_to_array($offersIterator);

        // Products
        $productsIterator = Products::getMostSelling([
                      "application_id" => 1,
                      "module_id" => 1,
                      "action" => "content_search",
                      "lang_id" => $this->activeLang,
            "most_selling"=>"1",
            ], ['limit' => 15]);
        $products = iterator_to_array($productsIterator);

        // Categories
        $categories = \Helpers::getCategories();

        // Ads
        $ads = [];
        $adsIterator = Ads::getAll(["lang_id" => $this->activeLang]);
        $ads = iterator_to_array($adsIterator);

        //Islam
        // Products
        $products_all_Iterator = Products::getAll([
            "application_id" => 1,
            "module_id" => 8,
            "action" => "content_search",
            "lang_id" => $this->activeLang
        ], ['limit' => 100]);
        $products_all = iterator_to_array($products_all_Iterator);

        return view('store.home', ['products_all' => $products_all,'manufacturers' => $manufacturers, 'offers' => $offers, 'products' => $products, 'categories' => $categories, 'ads' => $ads]);
    }

    public function offers(Request $request)
    {
        $this->setActiveLang();
        if(isset($request['region_id']) &&!empty($request['region_id'])) {
            $offersIterator = Offers::getAll(["region_id" => $request['region_id'], "lang_id" => $this->activeLang]);
        } else {
            $offersIterator = Offers::getAll(["lang_id" => $this->activeLang]);
        }

        $offers = iterator_to_array($offersIterator);

        $regions = \Helpers::getRegions();

        if($request->ajax()) {
            $viewData = view('partials._offers', ['offers' => $offers]);
            return (string) $viewData;
        }

        return view('store.offers', ['regions' => $regions]);
    }

    public function offerDetails($id, $slug)
    {
        $this->setActiveLang();
        if(!$id) {
            return response()
                ->view('errors.404');
        }


        // Offers
      //  dd($this->activeLang);
        $offerIterator = Offers::getById(["lang_id" => $this->activeLang],
                ['id' => $id]
            );
        $offer = iterator_to_array($offerIterator);

        $offer = array_pop($offer);
 //       dd($offer);

        if(!$offer) {
            return response()
                ->view('errors.404');
        }

        // offer attributes
        $deliveryPlaces = \Helpers::getOfferGroup($offer, 'branch_id');
        $originalPrice = \Helpers::getProductKeyValueItemText($offer, 'original_price');
        $newPrice = \Helpers::getProductKeyValueItemText($offer, 'price');
        $discountPercent = \Helpers::getProductKeyValueItemText($offer, 'discount_percent');
        $offerTypesIds = \Helpers::getOfferTypesIds($offer);
        $offerEndDate = (int) \Helpers::getProductKeyValueItemText($offer, 'end_date');
        $tags = \Helpers::getTags($offer);

        // Products in offers
        $productsIterator = Offers::productsInOffer(["lang_id" => $this->activeLang],
                ['offer_id' => $id]
            );
        $products = iterator_to_array($productsIterator);

        // Categories
        $categories = \Helpers::getCategories();

        return view('store.offerDetails', ['offer' => $offer, 'products' => $products, 'categories' => $categories,
        'deliveryPlaces' => $deliveryPlaces, 'originalPrice' => $originalPrice, 'newPrice' => $newPrice, 'discountPercent' =>
            $discountPercent, 'offerTypesIds' => $offerTypesIds, 'offerEndDate' => $offerEndDate, 'tags' => $tags
        ]);
    }

    public function shoppingCenter(Request $request)
    {
        $this->setActiveLang();
        $requestDataArr = [
            "application_id" => 1,
            "module_id" => 8,
            "action" => "content_search",
            "lang_id" => $this->activeLang
        ];


        // Filter and sort params
        if($request->filterCategory && !empty($request->filterCategory)) {
            $requestDataArr['departments'] = $request->filterCategory;
        }

        if($request->filterManf && !empty($request->filterManf)) {
            //$manufacturersFilter = $request->filterManf;
        }

        $sortField = '';
        $sortType = '';

        if($request->sort && in_array($request->sort, ["name", "price"])) {
            $sortField = $request->sort;
            $sortType = $request->sort_type && in_array($request->sort_type, ["asc", "desc"])?$request->sort_type:"desc";
            $requestDataArr['sort'] = ["by" => $request->sort, "type" => $sortType];
        }

        // Products
        $productsIterator = Products::getAll($requestDataArr,
            []);
        $products = iterator_to_array($productsIterator);

        $totalProducts = count($products);

        // Filter manufactures and categories by items count
        $manufacturersList = array_filter(\Helpers::getManufacturers(), function($v){
            if($v['items_count'] > 0) return true;
        });

        $categoriesList = array_filter(\Helpers::getCategories(), function($v){
            if($v['items_count'] > 0) return true;
        });

        $allCategoriesProductCount = array_sum(array_column(\Helpers::getCategories(), 'items_count'));

        // Set display mode
        $displayMode = ($request->display == "list"?"list":"grid");


        // prepare search form params
        $links = [];
        $queryParams = $request->except('__token');
        if(!$queryParams) {
            $links["listLink"] = "?display=list";
            $links["gridLink"] = "?display=grid";
            $links["sortName"] = "?sort=name";
            $links["sortPrice"] = "?sort=price";
            $links["sortAsc"] = "?sort_type=asc";
            $links["sortDesc"] = "?sort_type=desc";
        }

        if($queryParams) {
            // Display mode links
            if(array_key_exists("display", $queryParams)) {
                    unset($queryParams["display"]);
                    $queryParams["display"] = "list";
                    $links["listLink"] = "?".http_build_query($queryParams);
                    unset($queryParams["display"]);
                    $queryParams["display"] = "grid";
                    $links["gridLink"] = "?".http_build_query($queryParams);
            } else {
                $links["listLink"] = "?".http_build_query($queryParams)."&display=list";
                $links["gridLink"] = "?".http_build_query($queryParams)."&display=grid";
            }

            // Sort links
            if(array_key_exists("sort", $queryParams)) {
                unset($queryParams["sort"]);
                $queryParams["sort"] = "name";
                $links["sortName"] = "?".http_build_query($queryParams);
                unset($queryParams["sort"]);
                $queryParams["sort"] = "price";
                $links["sortPrice"] = "?".http_build_query($queryParams);
            } else {
                $links["sortName"] = "?".http_build_query($queryParams)."&sort=name";
                $links["sortPrice"] = "?".http_build_query($queryParams)."&sort=price";
            }

            if(array_key_exists("sort_type", $queryParams)) {
                unset($queryParams["sort_type"]);
                $queryParams["sort_type"] = "asc";
                $links["sortAsc"] = "?".http_build_query($queryParams);
                unset($queryParams["sort_type"]);
                $queryParams["sort_type"] = "desc";
                $links["sortDesc"] = "?".http_build_query($queryParams);
            } else {
                $links["sortAsc"] = "?".http_build_query($queryParams)."&sort_type=asc";
                $links["sortDesc"] = "?".http_build_query($queryParams)."&sort_type=desc";
            }
        }

        return view('store.shoppingCenter', ['products' => $products,
            'totalProducts' => $totalProducts,
            'displayMode' => $displayMode, 'manufacturersList' => $manufacturersList,
            'categoriesList' => $categoriesList, 'allCategoriesProductCount' => $allCategoriesProductCount,
        'links' => $links, 'sortField' => $sortField, 'sortType' => $sortType]);
    }

    public function productDetails($id, $slug)
    {
        $this->setActiveLang();
        if(!$id) {
            return response()
                ->view('errors.404');
        }

        // Top Categories
        $categories = \Helpers::getCategories();

        // Fetch Product
        $productsIterator = Products::getById([
            "application_id" => 1,
	        "module_id" => 8,
	        "action" => "content_search",
	        "id" => $id,
            "lang_id" => $this->activeLang
            ],
            [
                //'mockFile' => 'product.json'
            ]);
        $product = iterator_to_array($productsIterator);
        $product = array_pop($product);

        $reviewsIterator = Products::getProductReviews([],["product_id"=>$id]);
        $reviews = iterator_to_array($reviewsIterator);


        $branches = Branches::getAll([]);

        if(!$product) {
            return response()
                ->view('errors.404');
        }

        // set product data
        $productData = [];
        $productData['colors'] = \Helpers::getProductDataItemFromGroup($product, "keyvalue", "avaliable_colors_entity");
        $productData['deliveryPlaces'] = \Helpers::getProductGroup($product, 'branch_id');
        $productData['CartMin'] = \Helpers::getProductDataItemFromGroup($product, 'extra', 'minimum_in_cart');
        $productData['CartMax'] = \Helpers::getProductDataItemFromGroup($product, 'extra', 'maximum_in_cart');
        $productData['oldPrice'] = \Helpers::getProductDataItemFromGroup($product, 'extra', 'old_price');
        $productData['newPrice'] = \Helpers::getProductDataItemFromGroup($product, 'extra', 'price');
        $productData['discountPercent'] = \Helpers::getProductDataItemFromGroup($product, 'extra', 'discount_percent');
        $productData['deliveryDate'] = \Helpers::getProductKeyValueItemText($product, 'delivery_date');
        $productData['importantNotes'] = \Helpers::getProductKeyValueItemText($product, 'important_notes');
        $productData['inWarranty'] = \Helpers::getProductDataItemFromGroup($product, 'keyvalue', 'in_warranty');
        $productData['warrantyPeriod'] = \Helpers::getProductKeyValueItemText($product, 'warranty_period');
        $productData['otherWarranty'] = \Helpers::getProductKeyValueItemText($product, 'other_warranty_period');
        $productData['productAttrs'] = \Helpers::getProductAttributes($product);
        $productData['tags'] = \Helpers::getTags($product);


        $productCategory = \Helpers::getProductGroup($product, 'category_id');
        $productCategory = array_pop($productCategory);

        $relatedProducts = [];
        if(isset($productCategory['category_id'])) {
            // Related Products
            $relatedProductsIterator = Products::getAll([
                "application_id" => 1,
                "module_id" => 8,
                "action" => "content_search",
                "departments" => [$productCategory['category_id']],
                "lang_id" => $this->activeLang
            ]);
            $relatedProducts = iterator_to_array($relatedProductsIterator);
        }


        return view('store.productDetails', [
            'product'         => $product,
            'relatedProducts' => $relatedProducts,
            'categories'      => $categories,
            'productData'     => $productData,
            'branches'        =>$branches,
            'reviews'         => $reviews]);
    }

    public function manufactures()
    {
        $this->setActiveLang();
        $manufacturerIterator = Manufacturers::getAll([
            "application_id" => 1,
            "module_id" => 8,
            "action" => "depts_search",
            "core_dept_id" => 5,
            "lang_id" => $this->activeLang
        ]);
        $manufacturers = iterator_to_array($manufacturerIterator);

        return view('store.manufactures', ['manufacturers' => $manufacturers]);
    }

    public function wishList()
    {
        $this->setActiveLang();
        if(!\Session::get('loggedIn')) {
            return Redirect::route('login');
        }

        $wishListIterator = WishList::getAll(["lang_id" => $this->activeLang],
            ['user_id' => \Session::get('id')]
        );

        $products = iterator_to_array($wishListIterator);

        return view('store.wishList', ['products' => $products]);
    }

    public function addToWishList(Request $request)
    {
        $this->setActiveLang();
        if($request->ajax()) {

            if(!\Session::get('loggedIn')) {
                return json_encode(["status" => 0, "message" => __("messages.auth_required"), "errors" => []], true);
            }

            $fields = [];

            if (!isset($request->item_id)) {
                array_push($fields, "item_id missing");
            }

            if (!isset($request->item_type)) {
                array_push($fields, "item_type missing");
            }

            if (count($fields)) {
                return json_encode(["status" => 0, "message" => "Missing fields", "errors" => $fields], true);
            }

            $process = WishList::addToWishList([
                "id" => $request->item_id,
                "type_id" => $request->item_type,
                "lang_id" => $this->activeLang
            ], ['user_id' => \Session::get('id')]);

            $addToWishArray = iterator_to_array($process);
            $returnObject = array_pop($addToWishArray);

            if($returnObject->code() != 200 || !empty($returnObject->errorMessages())) {
                return json_encode(["status" => 0, "message" => $returnObject->message(), "errors" => $returnObject->errorMessages()], true);
            }

            if($returnObject->code() == 200 && empty($returnObject->errorMessages())) {
                $user_controller = new UserController();
                $user_controller->getUserProfile();
                return json_encode(["status" => 1, "message" => $returnObject->message()]);
            }
        }
    }

    public function compareProduct()
    {
        $this->setActiveLang();
        if(!\Session::get('loggedIn')) {
            return Redirect::route('login');
        }

        $products = Compare::getAll([], ['user_id' => \Session::get('id')]);
        $products = iterator_to_array($products);


        $productData['ids'] = [];
        $productData['images'] = [];
        $productData['names'] = [];
        $productData['descs'] = [];
        $productData['deliveries'] = [];
        $productData['manufacturers'] = [];
        $productData['prices'] = [];
        $productData['colors'] = [];
        $productData['delivery_places'] = [];
        foreach ($products as $product) {
            $productData['ids'][] = $product['id'];
            $productData['names'][] = $product['name'];
            $productData['images'][] = $product['image'];
            $productData['descs'][] = $product['description'];
            $productData['deliveries'][] = \Helpers::getProductKeyValueItemText($product, 'delivery_date');
            $productData['manufacturers'][] = \Helpers::getManufacturer($product);
            $productData['prices'][] = \Helpers::getProductDataItemFromGroup($product, 'extra', 'price');
            if(is_array(\Helpers::getProductDataItemFromGroup($product, "keyvalue", "avaliable_colors_entity"))) {
                $productData['colors'][] = \Helpers::getProductDataItemFromGroup($product, "keyvalue", "avaliable_colors_entity");
            }else{
                $productData['colors'][] = [];
            }
                $productData['delivery_places'][] = \Helpers::getProductGroup($product, 'branch_id');
        }

        return view('store.compareProduct', ['productData' => $productData]);
    }

    public function postCompareProduct(Request $request)
    {
        $this->setActiveLang();
        if($request->ajax()) {

            if(!\Session::get('loggedIn')) {
                return json_encode(["status" => 0, "message" => __("messages.auth_required"), "errors" => []], true);
            }

            $fields = [];

            if (!isset($request->item_id)) {
                array_push($fields, "item_id missing");
            }

            if (count($fields)) {
                return json_encode(["status" => 0, "message" => "Missing fields", "errors" => $fields], true);
            }

            $process = Compare::compareProducts([
            ], ['user_id' => \Session::get('id'), 'item_id' => $request->item_id]);

            $dataArray = iterator_to_array($process);
            $returnObj = array_pop($dataArray);

            if($returnObj->code() != 200 || !empty($returnObj->errorMessages())) {
                return json_encode(["status" => 0, "message" => $returnObj->message(), "errors" => $returnObj->errorMessages()], true);
            }

            if($returnObj->code() == 200 && empty($returnObj->errorMessages())) {
                return json_encode(["status" => 1, "message" => $returnObj->message()]);
            }
        }
    }

    public function removeComparedProduct(Request $request)
    {
        $this->setActiveLang();
        if($request->ajax()) {

            if(!\Session::get('loggedIn')) {
                return json_encode(["status" => 0, "message" => __("messages.auth_required"), "errors" => []], true);
            }

            $fields = [];

            if (!isset($request->item_id)) {
                array_push($fields, "item_id missing");
            }

            if (count($fields)) {
                return json_encode(["status" => 0, "message" => "Missing fields", "errors" => $fields], true);
            }

            $process = Compare::remove(["lang_id" => $this->activeLang
            ], ['user_id' => \Session::get('id'), "item_id" => $request->item_id]);

            $dataArray = iterator_to_array($process);
            $returnObject = array_pop($dataArray);

            if($returnObject->code() != 200 || !empty($returnObject->errorMessages())) {
                return json_encode(["status" => 0, "message" => $returnObject->message(), "errors" => $returnObject->errorMessages()], true);
            }

            if($returnObject->code() == 200 && empty($returnObject->errorMessages())) {
                return json_encode(["status" => 1, "message" => $returnObject->message()]);
            }
        }
    }

    public function shoppingCart()
    {
        $this->setActiveLang();
        if(!\Session::get('loggedIn')) {
            return Redirect::route('login');
        }

        $cartIterator = Cart::getAll([
            "lang_id" => $this->activeLang
        ],
            [
                'user_id' => \Session::get('id')
            ]
        );

        $cart = iterator_to_array($cartIterator);

        $extraDataIterator = Cart::extraData([
            "lang_id" => $this->activeLang
        ],
            [
                'user_id' => \Session::get('id')
            ]
        );

        $extraData = iterator_to_array($extraDataIterator);


        $extraData = array_pop($extraData);

        return view('store.shoppingCart', ['products' => $cart, 'extraData' => $extraData]);
    }

    public function addToCart(Request $request)
    {
        $this->setActiveLang();
        if($request->ajax()) {

            if(!\Session::get('loggedIn')) {
                return json_encode(["status" => 0, "message" => __("messages.auth_required"), "errors" => []], true);
            }

            $fields = [];

            if (!isset($request->item_id)) {
                array_push($fields, "item_id missing");
            }

            if (!isset($request->item_type)) {
                array_push($fields, "item_type missing");
            }

            if (!isset($request->count)) {
                array_push($fields, "count missing");
            }

            // if (!isset($request->delivery_place)) {
            //     array_push($fields, "delivery_place missing");
            // }

            if (count($fields)) {
                return json_encode(["status" => 0, "message" => "Missing fields", "errors" => $fields], true);
            }

            $addToCart = Cart::addToCart([
                "id" => $request->item_id,
                "type_id" => $request->item_type,
                "count" => $request->count,
                "delivery_place" => $request->delivery_place,
                "lang_id" => $this->activeLang
            ], ['user_id' => \Session::get('id')]);

            $addToCartArray = iterator_to_array($addToCart);
            $addToCartObject = array_pop($addToCartArray);

            if($addToCartObject->code() != 200 || !empty($addToCartObject->errorMessages())) {
                return json_encode(["status" => 0, "message" => $addToCartObject->message(), "errors" => $addToCartObject->errorMessages()], true);
            }

            if($addToCartObject->code() == 200 && empty($addToCartObject->errorMessages())) {
                $user_controller = new UserController();
                $user_controller->getUserProfile();
                return json_encode(["status" => 1, "message" => $addToCartObject->message()]);
            }
        }
    }

    public function removeFromCart(Request $request)
    {
        $this->setActiveLang();
        if($request->ajax()) {

            if(!\Session::get('loggedIn')) {
                return json_encode(["status" => 0, "message" => __("messages.auth_required"), "errors" => []], true);
            }

            $fields = [];

            if (!isset($request->item_id)) {
                array_push($fields, "item_id missing");
            }

            if (!isset($request->item_type)) {
                array_push($fields, "item_type missing");
            }

            if (count($fields)) {
                return json_encode(["status" => 0, "message" => "Missing fields", "errors" => $fields], true);
            }
// dd($request->all(), \Session::get('id'));
            $process = Cart::removeFromCart([
                "item_id" => $request->item_id,
                "type_id" => $request->item_type,
                "lang_id" => $this->activeLang
            ], ['user_id' => \Session::get('id')]);

            $dataArray = iterator_to_array($process);
            $returnObject = array_pop($dataArray);

            if($returnObject->code() != 200 || !empty($returnObject->errorMessages())) {
                return json_encode(["status" => 0, "message" => $returnObject->message(), "errors" => $returnObject->errorMessages()], true);
            }

            if($returnObject->code() == 200 && empty($returnObject->errorMessages())) {
                return json_encode(["status" => 1, "message" => $returnObject->message()]);
            }
        }
    }

    public function checkout(Request $request)
    {
        $this->setActiveLang();
        if(!\Session::get('loggedIn')) {
            return Redirect::route('login');
        }

//        if(!isset($_FILES['payment_receipt']['name']) || (isset($_FILES['payment_receipt']['name']) && !strlen($_FILES['payment_receipt']['name']))) {
//            \Session::flash('error', ['message' => __('messages.must_upload_certificate')]);
//            return redirect('store/shopping-cart#step-4');
//        }
        if(isset($_FILES['payment_receipt']['name']) && (isset($_FILES['payment_receipt']['name']) && strlen($_FILES['payment_receipt']['name']))) {

            $extension = pathinfo($_FILES['payment_receipt']['name'], PATHINFO_EXTENSION);

            if(!in_array($extension, ["png", "jpg", "jpeg", "JPG", "JPEG", "PNG", "gif"])) {
                \Session::flash('error', ['message' => __('messages.invalid_img_extension')]);
                return redirect('store/shopping-cart#step-4');
            }

            $paymentReceipt = \Helpers::uploadFile(public_path('uploads'), 'payment_receipt', $request);
            $payment_receipt = 'data:image/' . $extension . ';base64,' . base64_encode(file_get_contents(public_path('uploads/'.$paymentReceipt)));
        }else{
            $payment_receipt="";
        }



        $process = Cart::checkout([
            "payment_receipt" => $payment_receipt,
            "user_comment" => $request->userComment,
            "lang_id" => $this->activeLang
        ], ["user_id" => \Session::get('id')]);

        $iteratorData = iterator_to_array($process);
        $returnObject = array_pop($iteratorData);

        if($returnObject->code() != 200 || !empty($returnObject->errorMessages())) {
            \Session::flash('error', ['message' => $returnObject->message(), "summary" => $returnObject->errorMessages()]);
            return Redirect::back()->withInput();
        }

        if($returnObject->code() == 200 && empty($returnObject->errorMessages())) {
            // show success and redirect
            \Session::flash('success', ['message' => $returnObject->message()]);
            //Notify

            $notify = Cart::notify([
                "user_id" =>  \Session::get('id'),
                "external_type" => 1,
                "content" =>"New Order"
            ]);
            return Redirect::route('user-orders');
        }
    }

    public function submitReview(Request $request)
    {
        $this->setActiveLang();
        $ajax_response['status'] = 0;
        $ajax_response['message'] = '';

        $request_data = [];

        if(!\Session::get('loggedIn'))
        {
            $request_data['user_id'] = 0;
        }
        else
        {
            $request_data['user_id'] = \Session::get('id');
        }

        $request_data['product_id'] = $request->product_id;
        $request_data['rating']     = (int)$request->rating;
        $request_data['review']     = $request->user_comment;

        $process = Products::submitProductReview($request_data, []);

        $iteratorData = iterator_to_array($process);
        $returnObject = array_pop($iteratorData);
        if(!empty($returnObject))
        {
            $ajax_response['status']  = 1;
            $ajax_response['message'] = 'تم اضافة التقييم';

            \Session::flash('success', $ajax_response['message']);
        }
        else
        {
            $ajax_response['message'] = 'خطأ أثناء إضافة التقييم';
            \Session::flash('error', $ajax_response['message']);
        }

        return response($ajax_response, 200, ['Content-Type'=>'application/json']);
    }
}