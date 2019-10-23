<?php
namespace App\Classes\Modules;

use App\Classes\Api\Api;
use App\Classes\Api\GetMethodStrategy;
use App\Classes\Api\Response;
use App\Classes\Modules\Interfaces\ModuleInterface;

class Offers implements ModuleInterface
{
    public static function getAll(array $requestData = array(), array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new GetMethodStrategy(config('app.api_endpoints.offers'), $requestData));
        }

        $response = (new Response($jsonData))->decode()->content();

        if(isset($additionalData['limit'])) {
            return new \LimitIterator(new \ArrayIterator($response), 0, $additionalData['limit']);
        }

        return new \ArrayIterator($response);
    }

    public static function getById(array $requestData = array(), array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../json/" . $additionalData['mockFile']);
        } else {
            $jsonData = Api::makeRequest(new GetMethodStrategy(str_replace('{$id}', $additionalData['id'], config('app.api_endpoints.offer')), $requestData));
        }

        $response = (new Response($jsonData))->decode()->content();

        return new \ArrayIterator($response);
    }

    public static function getHomeOffers(array $requestData = array(), array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new GetMethodStrategy(config('app.api_endpoints.homeOffers'), $requestData));
        }

        $response = (new Response($jsonData))->decode()->content();


        return new \ArrayIterator($response);
    }

    public static function productsInOffer(array $requestData = array(), array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../json/" . $additionalData['mockFile']);
        } else {
            $jsonData = Api::makeRequest(new GetMethodStrategy(str_replace('{$offer_id}', $additionalData['offer_id'], config('app.api_endpoints.productsInOffer')), $requestData));
        }

        $response = (new Response($jsonData))->decode()->content();

        return new \ArrayIterator($response);
    }

    public static function getByName(array $requestData, array $additionalData = []) : \Iterator
    {
        $json_data = Api::makeRequest(new GetMethodStrategy(str_replace('{$name}', $additionalData['name'], config('app.api_endpoints.getOffersByName')),$requestData));
        $response = (new Response($json_data))->decode()->content();
        return new \ArrayIterator($response);
    }
}