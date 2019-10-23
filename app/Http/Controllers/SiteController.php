<?php

namespace App\Http\Controllers;
use App\Classes\Modules\Products;
use App\Classes\Modules\Services;
use App\Http\Controllers\ParentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Session;
use Lang;
use App\Classes\Modules\Events;
use App\Classes\Modules\Pages;
use App\Classes\Modules\Categories;
use App\Classes\Modules\Offers;
use App\Classes\Modules\Branches;
use App\Classes\Modules\Ads;
use App\Classes\Modules\Forms;

class SiteController extends ParentController
{
    // public function __construct() {
    //     // parent::__construct();
    // }

    public function index() {

        $this->setActiveLang();

        // get about us
        $pageIterator = Pages::getAll([
            "application_id" => 1,
            "module_id" => 2,
            "action" => "content_search",
            "lang_id" => $this->activeLang
        ],
                [
                    //"mockFile"=> "about.json"
                ]
            );
        $pageArray = iterator_to_array($pageIterator);
        $aboutPage = array_pop($pageArray);

        // get events
        $eventsIterator = Events::getAll([
                "application_id" => 1,
                "module_id" => 1,
                "action" => "content_search",
                "lang_id" => $this->activeLang,
        ], [
            'limit' => 4,
            //"mockFile" => "events.json"
        ]);
        $eventsArray = iterator_to_array($eventsIterator);

        // get product categories
        $categoriesIterator = Categories::getAll([
                "application_id" => 1,
                "module_id" => 8,
                "action" => "depts_search",
                "core_dept_id" => 4,
                "lang_id" => $this->activeLang
        ],
            [
                //"mockFile"=> "categories.json"
            ]
        );
        $categoriesArray = iterator_to_array($categoriesIterator);

        // Home Offers
        $offersIterator = Offers::getHomeOffers(["lang_id" => $this->activeLang]);
        $offers = iterator_to_array($offersIterator);

        // Ads
        $ads = [];
        $adsIterator = Ads::getAll(["lang_id" => $this->activeLang]);
        $ads = iterator_to_array($adsIterator);


        //Islam
        // Products
        $productsIterator = Products::getMostSelling([
            "application_id" => 1,
            "module_id" => 8,
            "action" => "content_search",
            "lang_id" => $this->activeLang,
            "most_selling"=>1,
        ], ['limit' => 30]);
        $products = iterator_to_array($productsIterator);

        return view('site.home', ['products' => $products,'events' => $eventsArray, 'productCategories' => $categoriesArray, 'offers' => $offers, 'ads' => $ads, 'about' => $aboutPage]);
    }

    public function productCategory($id, $slug)
    {
        $this->setActiveLang();

        if (!$id) {
            return response()
                ->view('errors.404');
        }

        $categoryIterator = Categories::getOne([
                "application_id" => 1,
                "module_id" => 8,
                "action" => "depts_search",
                "core_dept_id" => 4,
                "dept_id" => $id,
                "lang_id" => $this->activeLang
            ]
        );

        $categoryArray = iterator_to_array($categoryIterator);
        $categoryArray = array_pop($categoryArray);


        if (!$categoryArray) {
            return response()
                ->view('errors.404');
        }

        $productsArray = [];

        if($categoryArray['id']) {
            $productsIterator = Categories::getCategoryProducts([
                    "application_id" => 1,
                    "module_id" => 8,
                    "action" => "content_search",
                    "departments" => [$categoryArray['id']],
                    "lang_id" => $this->activeLang
                ]
            );
            $productsArray = iterator_to_array($productsIterator);
        }

        // Child Categories
        $categoryTree = \Helpers::getCategoryTree();
        $childCats = [];
        array_walk($categoryTree, function($v, $k)use(&$childCats, $categoryArray){
            if($v['parent_id'] == $categoryArray['id']) {
                $childCats = $v["children"];
            }
        });


        return view('site.productCategory', ['products' => $productsArray, "category" => $categoryArray, "childCats" => $childCats]);
    }

    public function serviceDetails($id, $slug)
    {
        $this->setActiveLang();
        if(!$id) {
            return response()
                ->view('errors.404');
        }

        $servicesIterator = Services::getOne([
            "application_id" => 1,
            "module_id" => 11,
            "action" => "content_search",
            "departments" => [$id],
            "lang_id" => $this->activeLang
        ]
        );

        $servicesArray = iterator_to_array($servicesIterator);
        $servicesArray = array_pop($servicesArray);

        if(!$servicesArray) {
            return response()
                ->view('errors.404');
        }

        return view('site.serviceDetails', ['service' => $servicesArray]);
    }

    public function about()
    {
        $this->setActiveLang();
        $pageIterator = Pages::getAll([
            "application_id" => 1,
            "module_id" => 2,
            "action" => "content_search",
            "lang_id" => $this->activeLang
        ],
                [
                    //"mockFile"=> "about.json"
                ]
            );
        $pageArray = iterator_to_array($pageIterator);
        $currentPage = array_pop($pageArray);

        if(!$currentPage) {
            return response()
                ->view('errors.404');
        }

        return view('site.about', ['page' => $currentPage]);
    }

    
    public function brochures() {
        $this->setActiveLang();
        $pageIterator = Pages::getAll([
            "application_id" => 1,
            "module_id" => 5,
            "action" => "depts_with_items",
            "core_dept_id" => 3,
            "lang_id" => $this->activeLang
        ],
                [
                    // "mockFile"=> "factory.json"
                ]
            );
        $pageArray = iterator_to_array($pageIterator);
        $currentPage = array_pop($pageArray);
        $currentPage = $this->parsePDFInProfileAndBrochure($currentPage);
        return view('site.brochures', ['page' => $currentPage]);
    }
    public function profile()  {
        $this->setActiveLang();
        $pageIterator = Pages::getAll([
             "application_id" => 1,
             "module_id" => 4,
             "action" => "depts_with_items",
             "core_dept_id" => 2,
             "lang_id" => $this->activeLang
        ],
            [
            //"mockFile"=> "profile.json"
            ]
        );
        $pageArray = iterator_to_array($pageIterator);
        $currentPage = array_pop($pageArray);
        $currentPage = $this->parsePDFInProfileAndBrochure($currentPage);
        return view('site.profile', ['page' => $currentPage]);
    }

    public function branches(Request $request)
    {
        $this->setActiveLang();
        if(isset($request['region_id']) &&!empty($request['region_id'])) {
            $process = Branches::getAll(["region_id" => $request['region_id'], "lang_id" => $this->activeLang]);
        } else {
            $process = Branches::getAll(["lang_id" => $this->activeLang]);
        }

        $branchesArray = iterator_to_array($process);

        if($request->ajax()) {
            $viewData = view('partials._branches', ['branches' => $branchesArray]);
            return (string) $viewData;
        }

        return view('site.branches');
    }

    public function factory()
    {
        $this->setActiveLang();
        $pageIterator = Pages::getAll([
                "application_id" => 1,
                "module_id" => 3,
                "action" => "depts_with_items",
                "core_dept_id" => 1,
                "lang_id" => $this->activeLang
        ],
                [
                    //"mockFile"=> "factory.json"
                ]
            );
        $pageArray = iterator_to_array($pageIterator);

        return view('site.factory', ['factories' => $pageArray]);
    }

    public function events()
    {
        $this->setActiveLang();
        $eventsIterator = Events::getAll([
            "application_id" => 1,
            "module_id" => 1,
            "action" => "content_search",
            "lang_id" => $this->activeLang,
        ],
                [
                    //"mockFile" => "events.json"
                ]
            );
        $events = iterator_to_array($eventsIterator);

        return view('site.events', ['events' => $events]);
    }

    public function eventDetails($id, $slug)
    {
        $this->setActiveLang();
        if(!$id) {
            return response()
                ->view('errors.404');
        }

        // get event details
        $eventsIterator = Events::getAll([
            "application_id" => 1,
            "module_id" => 1,
            "action" => "content_search",
            "id" => $id,
            "lang_id" => $this->activeLang, 
        ]);

        $eventsArray = iterator_to_array($eventsIterator);
        $event = array_pop($eventsArray);

        if(!$event) {
            return response()
                ->view('errors.404');
        }

        return view('site.eventDetails', ['event' => $event]);
    }

    public function photoGallery()
    {
        $this->setActiveLang();
        $pageIterator = Pages::getAll([
            "application_id" => 1,
            "module_id" => 2,
            "action" => "content_search",
            "lang_id" => $this->activeLang
        ],
                [
                    //"mockFile"=> "photoGallery.json"
                ]
            );
        $pagesArray = iterator_to_array($pageIterator);

        $galleries = [];
        if(!empty($pagesArray)) {
            $galleries = array_column($pagesArray, "media");
            $galleries = call_user_func_array('array_merge', $galleries);
            $galleries = array_filter($galleries, function ($v) {
                if ($v['type'] == "Img")
                    return true;
            });
        }

        return view('site.photoGallery', ['galleries' => $galleries]);
    }

    public function videoGallery()
    {
        $this->setActiveLang();
        $pageIterator = Pages::getAll([
            "application_id" => 1,
            "module_id" => 2,
            "action" => "content_search",
            "lang_id" => $this->activeLang
        ]);
        $pagesArray = iterator_to_array($pageIterator);

        $galleries = [];
        if(!empty($pagesArray)) {
            $galleries = array_column($pagesArray, "media");
            $galleries = call_user_func_array('array_merge', $galleries);
            $galleries = array_filter($galleries, function ($v) {
                if ($v['type'] == "Video")
                    return true;
            });
        }

        return view('site.videoGallery', ['galleries' => $galleries]);
    }

    public function page($id, $slug)
    {
        $this->setActiveLang();
        if(!$id) {
            return response()
                ->view('errors.404');
        }

        $pageIterator = Pages::getAll([
            "application_id" => 1,
            "module_id" => 2,
            "action" => "content_search",
            "id" => $id,
            "lang_id" => $this->activeLang
        ]);
        $pageArray = iterator_to_array($pageIterator);
        $currentPage = array_pop($pageArray);

        if(!$currentPage) {
            return response()
                ->view('errors.404');
        }

        return view('site.otherPage', ['page' => $currentPage]);
    }

    public function contact()
    {
        $this->setActiveLang();
        return view('site.contact');
    }

    public function postContact(Request $request)
    {
        $this->setActiveLang();
        $process = Forms::contactUs([
            "name" => $request->name,
            "message" => $request->message,
            "ip" => $_SERVER["REMOTE_ADDR"],
            "email" => $request->email,
            "lang_id" => $this->activeLang
        ]);

        $iteratorData = iterator_to_array($process);
        $returnObject = array_pop($iteratorData);

        if($returnObject->code() != 200 || !empty($returnObject->errorMessages())) {
            \Session::flash('error', ['message' => $returnObject->message(), "summary" => $returnObject->errorMessages()]);
            return Redirect::back()->withInput();
        }

        if($returnObject->code() == 200 && empty($returnObject->errorMessages())) {
            // show success and redirect
            \Session::flash('success', ['message' => $returnObject->message()]);
            return redirect('contact-us');
        }
    }

    public function newsletter(Request $request)
    {
        $this->setActiveLang();
        if($request->ajax()) {

            $process = Forms::newsletter([
                "application_id" => 1,
                "mail" => $request->email,
                "lang_id" => $this->activeLang
            ]);

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

    public function requestVisit(Request $request)
    {
        $this->setActiveLang();
        $process = Forms::requestVisit([
            "date" => $request->date,
            "name" => $request->name,
            "mobile" => $request->mobile,
            "location" => $request->location,
            "user_id" => (\Session::get('loggedIn')?\Session::get('id'):""),
            "lang_id" => $this->activeLang
        ]);

        $iteratorData = iterator_to_array($process);
        $returnObject = array_pop($iteratorData);

        if($returnObject->code() != 200 || !empty($returnObject->errorMessages())) {
            \Session::flash('error', ['message' => $returnObject->message(), "summary" => $returnObject->errorMessages()]);
            return Redirect::to($request->current_url);
        }

        if($returnObject->code() == 200 && empty($returnObject->errorMessages())) {
            // show success and redirect
            \Session::flash('success', ['message' => $returnObject->message()]);
            return Redirect::to($request->current_url);
        }
    }

    public function careers()
    {
        $this->setActiveLang();
        return view('site.careers');
    }

    public function careersApply()
    {
        $this->setActiveLang();
        return view('site.careersApply');
    }

    public function faq()
    {
        $this->setActiveLang();
        return view('site.faq');
    }

    public function rss()
    {
        $this->setActiveLang();
        return view('site.rss');
    }

    public function terms()
    {
        $this->setActiveLang();
        return view('site.terms');
    }

    public function sitemap()
    {
        $this->setActiveLang();
        return view('site.sitemap');
    }

    public function maintainance()
    {
        $this->setActiveLang();
        return view('site.maintainance');
    }

    public function maintainanceTracking()
    {
        $this->setActiveLang();
        return view('site.maintainanceTracking');
    }
    
    private function parsePDFInProfileAndBrochure($currentPage) {
        foreach ($currentPage['cms'] as $cms_index => $cms) {
            $mores = $cms['more'];
            foreach($mores as $index => $more) {
                if($more['key'] == 'keyvalue') {
                    if(!empty($more['value']) || $more['value'] != []) {
                        $value = current($more['value']);
                        $pdf_url = $value['value']['value_title'];
                        $currentPage['cms'][$cms_index]['more'] = array('pdf_url' => $pdf_url);
                    } else {
                        $currentPage['cms'][$cms_index]['more'] = array('pdf_url' => '#');
                    }
                } else {
                    unset($currentPage['cms'][$cms_index]['more'][$index]);
                }
            }
        }
        return $currentPage;
    }
}
