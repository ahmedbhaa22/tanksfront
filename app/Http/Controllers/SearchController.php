<?php

namespace App\Http\Controllers;

use App\Classes\Modules\Categories;
use App\Classes\Modules\Events;
use App\Classes\Modules\Offers;
use App\Classes\Modules\Products;
use Illuminate\Http\Request;

class SearchController extends ParentController
{
    function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $keyword = $request->keyword ?? '';
        return view('site.searchResults', ['search_keyword' => $keyword]);
    }

    public function searchProducts(Request $request)
    {
        $ajax_response['status']  = 0;
        $ajax_response['content'] = '';

        if($request->ajax())
        {
            $keyword = $request->keyword;

            if(strlen($keyword))
            {
                $request_data = [
                    'application_id' => 1,
                    'module_id'      => 8,
                    'action'         => 'content_search',
                    'lang_id'        => 2, // todo $this->activeLang
                    'name'           => $keyword
                ];

                $productsIterator = Products::getByName($request_data);

                $products = iterator_to_array($productsIterator);

                $ajax_response['status']  = 1;
                $ajax_response['content'] = \Helpers::getSimpleProducts($products);
            }
        }
        else
        {
            $ajax_response['content'] = 'Request error!';
        }

      return response($ajax_response, 200, ['Content-Type'=>'application/json']);
    }

    public function searchCategories(Request $request)
    {
        $ajax_response['status']  = 0;
        $ajax_response['content'] = '';

        if($request->ajax())
        {
            $keyword = $request->keyword;

            if(strlen($keyword))
            {
                $request_data = [
                    'application_id' => 1,
                    'module_id'      => 8,
                    'action'         => 'depts_search',
                    'core_dept_id'   => 4,
                    'dept_name'      => $keyword,
                    'lang_id'        => 2 // todo $this->activeLang
                ];

                $categoriesIterator = Categories::getCategoryByName($request_data);

                $categories = iterator_to_array($categoriesIterator);

                $ajax_response['status']  = 1;
                $ajax_response['content'] = \Helpers::getSimpleCategories($categories);
            }
        }
        else
        {
            $ajax_response['content'] = 'Request error!';
        }

        return response($ajax_response, 200, ['Content-Type'=>'application/json']);
    }

    public function searchOffers(Request $request)
    {
        $ajax_response['status']  = 0;
        $ajax_response['content'] = '';

        if($request->ajax())
        {
            $keyword = $request->keyword;

            if(strlen($keyword))
            {
                $request_data    = [];
                $additional_data = [
                    'name' => $keyword
                ];

                $offers_iterator = Offers::getByName($request_data, $additional_data);

                $offers = iterator_to_array($offers_iterator);

                $ajax_response['status']  = 1;
                $ajax_response['content'] = \Helpers::getSimpleOffers($offers);
            }
        }
        else
        {
            $ajax_response['content'] = 'Request error!';
        }

        return response($ajax_response, 200, ['Content-Type'=>'application/json']);
    }

    public function searchEvents(Request $request)
    {
        $ajax_response['status']  = 0;
        $ajax_response['content'] = '';

        if($request->ajax())
        {
            $keyword = $request->keyword;

            if(strlen($keyword))
            {
                $request_data = [
                    'application_id' => 1,
                    'module_id'      => 1,
                    'action'         => 'content_search',
                    'name'           => $keyword,
                    'lang_id'        => 2, // todo $this->activeLang
                ];

                $events_iterator = Events::getByName($request_data);
                $events = iterator_to_array($events_iterator);

                $ajax_response['status']  = 1;
                $ajax_response['content'] = \Helpers::getSimpleEvents($events);
            }
        }
        else
        {
            $ajax_response['content'] = 'Request error!';
        }

        return response($ajax_response, 200, ['Content-Type'=>'application/json']);
    }
}
