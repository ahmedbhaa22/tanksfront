<?php

use App\Classes\Modules\Regions;
use App\Classes\Modules\Pages;
use App\Classes\Modules\Categories;
use App\Classes\Modules\Manufacturers;
use App\Classes\Modules\Services;
use App\Classes\Api\Api;
use App\Classes\Api\PostMethodStrategy;
use App\Classes\Api\GetMethodStrategy;
use App\Classes\Api\Response;
use Illuminate\Support\Facades\Cache;

class Helpers
{
    public static function getActiveLang()
    {
        return \App::isLocale('ar')?1:2;
    }

    public static function getYoutubeVideoId(string $link) : string
    {
        preg_match('/\?v=(.*)/', $link, $match);

        return $match[1];
    }

    public static function getOtherPages() : array
    {
        $pageIterator = Pages::getAll([
            "application_id" => 1,
            "module_id" => 2,
            "action" => "content_search",
            "lang_id" => self::getActiveLang()
        ],
            [
        //"mockFile"=> "about.json"
        ]
            );
        $pagesArray = iterator_to_array($pageIterator);
        // exclude about page
        return array_filter($pagesArray, function($v) {
            if($v['id'] != 2) return true;
        });
    }

    public static function getRegions() : array
    {
        $regionIterator = Regions::getAll(["lang_id" => self::getActiveLang()], [
            //"mockFile"=> "regions.json"
        ]);

        $regionArray = iterator_to_array($regionIterator);
        return $regionArray;
    }

    public static function getCities() : array
    {
        $cities_iterator = \App\Classes\Modules\Cities::getAll(['lang_id' => self::getActiveLang()]);
        $cities_array    = iterator_to_array($cities_iterator);
        return $cities_array;
    }

    public static function getCountries()
    {
        $countries_iterator = \App\Classes\Modules\Countries::getAll(['lang_id' => self::getActiveLang()]);
        $countries_array    = iterator_to_array($countries_iterator);
        return $countries_array;
    }

    public static function getManufacturers() : array
    {
        $manufacturerIterator = Manufacturers::getAll([
            "application_id" => 1,
            "module_id" => 8,
            "action" => "depts_search",
            "core_dept_id" => 5,
            "lang_id" => self::getActiveLang()
        ]);

        $manufacturerArray = iterator_to_array($manufacturerIterator);
        return $manufacturerArray;
    }

    public static function getCategories() : array
    {
        $categoriesIterator = Categories::getAll([
            "application_id" => 1,
            "module_id" => 8,
            "action" => "depts_search",
            "core_dept_id" => 4,
            "lang_id" => self::getActiveLang()
        ]);

        $categoriesArray = iterator_to_array($categoriesIterator);
        return $categoriesArray;
    }

    public static function getCategoryTree() : array
    {
        $categoriesIterator = Categories::getAll([
            "application_id" => 1,
            "module_id" => 8,
            "action" => "depts_tree",
            "core_dept_id" => 4,
            "lang_id" => self::getActiveLang()
        ]);

        $categoriesArray = iterator_to_array($categoriesIterator);
        return $categoriesArray;
    }

    public static function getServices() : array
    {
        $pageIterator = Services::getAll([
                "application_id" => 1,
                "module_id" => 11,
                "action" => "depts_search",
                "core_dept_id" => 6,
                "lang_id" => self::getActiveLang()
            ]
        );
        $servicesArray = iterator_to_array($pageIterator);
        return $servicesArray;
    }

    public static function getServicesTree() : array
    {
        $pageIterator = Services::getAll([
                "application_id" => 1,
                "module_id" => 11,
                "action" => "depts_tree",
                "core_dept_id" => 6,
                "lang_id" => self::getActiveLang()
            ]
        );
        $servicesArray = iterator_to_array($pageIterator);
        return $servicesArray;
    }

    public static function getCmsModuleGroup($module, $group) : array
    {
        $return = [];
        if(array_key_exists("more", $module)) {
            array_walk($module["more"], function($v, $k) use ($group, &$return){
                if(isset($v['key']) && $v['key'] == $group) {
                    $return = $v['value'];
                }
            });
        }

        return $return;
    }

    public static function getCmsModuleDataItemFromGroup($module, $group, $paramter)
    {
        $return = '';

        if(array_key_exists("more", $module)) {
            array_walk($module["more"], function($v, $k) use ($paramter, $group, &$return){
                if($v['key'] == $group) {
                    if(isset($v['value']) && count($v['value'])) {
                        foreach ($v['value'] as $item) {
                            if((array_key_exists('parameter', $item)&&$item['parameter'] == $paramter) || (array_key_exists('paramter', $item)&&$item['paramter'] == $paramter)) {
                                $return = $item['value'];
                                break;
                            }
                        }
                    }
                }
            });
        }

        return $return;
    }

    public static function getCmsKeyValueItemText($cms, $paramter, $isString = true, $delimiter = ", ")
    {
        $item = self::getCmsModuleDataItemFromGroup($cms, "keyvalue", $paramter);

        if(!$item) {
            return "";
        }

        if($isString) {

            if(is_array($item)) {
                $item = array_pop($item);
                return $item["value_title"]??"";
            }

            return $item;
        }

        $values = [];

        array_walk($item, function($v, $k) use (&$values){
            array_push($values, $v["value_title"]);
        });

        return implode($delimiter, $values);
    }

    public static function getOfferGroup($offer, $group) : array
    {
        $return = [];
        if(array_key_exists("more", $offer)) {
            array_walk($offer["more"], function($v, $k) use ($group, &$return){
                if($v['key'] == $group) {
                    $return = $v['value'];
                }
            });
        }

        return $return;
    }

    public static function getOfferDataItemFromGroup($offer, $group, $paramter)
    {
        $return = '';

        if(array_key_exists("more", $offer)) {
            array_walk($offer["more"], function($v, $k) use ($paramter, $group, &$return){
                if($v['key'] == $group) {
                    if(isset($v['value']) && count($v['value'])) {
                        foreach ($v['value'] as $item) {
                            if((array_key_exists('parameter', $item)&&$item['parameter'] == $paramter) || (array_key_exists('paramter', $item)&&$item['paramter'] == $paramter)) {
                                $return = $item['value'];
                                break;
                            }
                        }
                    }
                }
            });
        }

        return $return;
    }

    public static function getOfferTypesIds($offer) : array
    {
        $ids = [];
        $types = self::getOfferGroup($offer, 'types');

        array_walk($types, function($v, $k) use (&$ids) {
            array_push($ids, $v[0]['value']);
        });

        return $ids;
    }

    public static function getProductGroup($product, $group) : array
    {
        $return = [];
        if(array_key_exists("more", $product)) {
            array_walk($product["more"], function($v, $k) use ($group, &$return){
                if($v['key'] == $group) {
                    $return = $v['value'];
                }
            });
        }

        return $return;
    }

    public static function getProductDataItemFromGroup($product, $group, $paramter)
    {
        $return = '';

        if(array_key_exists("more", $product)) {
            array_walk($product["more"], function($v, $k) use ($paramter, $group,  &$return){
                if($v['key'] == $group) {
                    if(isset($v['value']) && count($v['value'])) {
                        foreach ($v['value'] as $item) {
                            if((array_key_exists('parameter', $item)&&$item['parameter'] == $paramter) || (array_key_exists('paramter', $item)&&$item['paramter'] == $paramter)) {
                                $return = $item['value'];
                                break;
                            }
                        }
                    }
                }
            });
        }
        // dd($product);
        return $return;
    }

    public static function getProductKeyValueItemText($product, $paramter, $isSingle = true, $delimiter = ", ")
    {
        $item = self::getProductDataItemFromGroup($product, "keyvalue", $paramter);

        if(!$item) {
            return "";
        }

        if($isSingle) {

            if(is_array($item)) {
                $item = array_pop($item);
                return $item["value_title"]??"";
            }

            return $item;
        }

        $values = [];

        array_walk($item, function($v, $k) use (&$values){
            array_push($values, $v["value_title"]);
        });

        return implode($delimiter, $values);
    }

    public static function getProductAttributes($product, $group = 'attributes')
    {
        $groupValues = self::getProductGroup($product, $group);

        $attributes = [];

        array_walk($groupValues, function($v, $k) use (&$attributes){
            $attributes[$v['title']] = $v['value']['value_title'];
        });

        return $attributes;
    }

    public static function getBrancheNames($offerOrProduct) : array
    {
        $names = [];
        $branches = self::getOfferGroup($offerOrProduct, 'branch_id');

        array_walk($branches, function($v, $k) use (&$names) {
            array_push($names, $v[1]['value']);
        });

        return $names;
    }

    public static function getManufacturer($offerOrProduct, $isArray = false)
    {
        $manufacturers = self::getOfferGroup($offerOrProduct, 'manufacturer_data');

        $ret = array();

        array_walk($manufacturers, function($v, $k) use (&$ret) {
            if(isset($v['manufacturer_name'])) {
                $ret[] = $v['manufacturer_name'];
            }

        });

        if($isArray) {
            return $ret;
        }

        return implode(", ", $ret);
    }

    public static function getCount($offerOrProduct, $isArray = false)
    {
        $count = self::getOfferGroup($offerOrProduct, 'cart_count');
        return $count[0]['count'];
    }

    public static function getTags($offerOrProduct)
    {
        $tags = self::getOfferGroup($offerOrProduct, 'tags');

        return $tags[0]['tags']??[];
    }

    public static function getItemType($offerOrProduct)
    {
        return $offerOrProduct["product_type"];
    }

    public static function getFooter() : array
    {
        $pageIterator = Pages::getAll([
            "application_id" => 1,
            "module_id" => 7,
            "action" => "content_search",
            "lang_id" => self::getActiveLang()
        ]);
        $pageArray = iterator_to_array($pageIterator);
        $pageArray = array_pop($pageArray);
        $pageArray['emails'] = [];
        $pageArray['mobiles'] = [];
        $pageArray['addresses'] = [];
        $pageArray['faxes'] = [];

        $keyValueData = self::getCmsModuleGroup($pageArray, 'keyvalue');

        array_walk($keyValueData, function($v, $k) use (&$pageArray){
            if($v['parameter'] == 'email') {
                array_push($pageArray['emails'], $v['value']['value_title']);
            }
            if($v['parameter'] == 'mobile1' || $v['parameter'] == 'mobile2') {
                array_push($pageArray['mobiles'], $v['value']['value_title']);
            }
            if($v['parameter'] == 'address') {
                array_push($pageArray['addresses'], $v['value']['value_title']);
            }
            if($v['parameter'] == 'fax') {
                array_push($pageArray['faxes'], $v['value']['value_title']);
            }
        });
        
        return $pageArray;
    }

    public static function getTranslatedStaticData($onChangeLang = false)
    {
        if(!\Cache::has('static-data') || $onChangeLang == true) {
//            $textToTranslate = \Lang::get('messages');

            $requestData = [
                "application_id" => 1,
                "action" => "static_loc",
                "lang_id" => self::getActiveLang()
            ];

            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.staticData'), $requestData), []);
            $response = (new Response($jsonData))->decode()->content();

            // check and store item in the cache
            \Cache::forget('static-data');
            \Cache::put('static-data', $response, 24*60);
        }
    }

    public static function langCacheItem($key)
    {
        $staticData = \Cache::get('static-data');
        foreach ($staticData as $value) {
            if($key == $value['word_key']) {
                return $value['value'];
            }
        }

        return $key;
    }

    public static function str2url($title, $sep = "-") {
        $title = trim($title);
        $exclude = array("'s", "!", "@", "#", "$", "%", "^", "&", "*", "(", ")", "=", "{", "}", "[", "]", "|", "\\", "/", "?", "<", ">", "~", "`", "_", "+", "=", "-");
        $pieces = explode(' ', str_replace($exclude, "", $title));

        $output = NULL;
        foreach ($pieces as $key => $val) {

            $output .= $val . $sep;
        }

        $output = substr($output, 0, -1);
        return $output;
    }

    public static function uploadFile($destination, $file, $request)
    {
        $extension = $request->file($file)->getClientOriginalExtension();
        $fileName = md5(uniqid()).'.'.$extension;
        $request->file($file)->move($destination, $fileName);
        return $fileName;
    }

    public static function getCartCount()
    {
        if(\Session::has('accessToken'))
        {
            $process = \App\Classes\Modules\Users::userProfile([
                "access_token" => \Session::get('accessToken'),
            "lang_id" => self::getActiveLang()
            ]);

            $iteratorData = iterator_to_array($process);
            $returnObject = array_pop($iteratorData);

            $code = $returnObject->code();
            $content = $returnObject->content();
            $contentArray = array_pop($content);

            if($code == 200 && empty($errorMessages)) {
                return $contentArray['cart_count'];
            }
        }
    }

    public static function getWishlistCount()
    {
        if(\Session::has('accessToken'))
        {
            $process = \App\Classes\Modules\Users::userProfile([
                "access_token" => \Session::get('accessToken'),
//            "lang_id" => self::getActiveLang()
            ]);

            $iteratorData = iterator_to_array($process);
            $returnObject = array_pop($iteratorData);

            $code = $returnObject->code();
            $content = $returnObject->content();
            $contentArray = array_pop($content);

            if($code == 200 && empty($errorMessages)) {
                return $contentArray['wishlist_count'];
            }
        }
    }

    public static function getSimpleProducts($products)
    {
        $products_arr = [];

        foreach($products as $product)
        {
            $product_model['id']   = $product['id'];
            $product_model['name'] = $product['name'];
            $product_model['desc'] = $product['description'];

            $products_arr[] = $product_model;
        }

        return $products_arr;
    }

    public static function getSimpleCategories($categories)
    {
        $categories_arr = [];

        foreach($categories as $category)
        {
            $categories_model['id']   = $category['id'];
            $categories_model['name'] = $category['name'];
            $categories_model['desc'] = $category['description'];

            $categories_arr[] = $categories_model;
        }

        return $categories_arr;
    }

    public static function getSimpleOffers($offers)
    {
        $offers_arr = [];

        foreach($offers as $offer)
        {
            $offer_model['id']   = $offer['id'];
            $offer_model['name'] = $offer['name'];
            $offer_model['desc'] = $offer['description'];

            $offers_arr[] = $offer_model;
        }

      return $offers_arr;
    }

    public static function getSimpleEvents($events)
    {
        $events_arr = [];

        foreach($events as $event)
        {
            $event_model['id']   = $event['id'];
            $event_model['name'] = $event['name'];
            $event_model['desc'] = $event['description'];

            $events_arr[] = $event_model;
        }

        return $events_arr;
    }

    public static function userAlreadySubscribed()
    {
        $subscribedInNewsletterIterator = \App\Classes\Modules\Users::checkNewsLetterSubscription([
            'access_token' => \Session::get('accessToken')
        ]);

        $subscribed_in_newsletter = iterator_to_array($subscribedInNewsletterIterator);
        $subscribed = isset($subscribed_in_newsletter['subscribed'])?$subscribed_in_newsletter['subscribed']:false;

        return $subscribed;
    }
}