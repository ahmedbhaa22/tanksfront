<?php
namespace App\Classes\Modules;

use App\Classes\Api\Api;
use App\Classes\Api\GetMethodStrategy;
use App\Classes\Api\PostMethodStrategy;
use App\Classes\Api\DeleteMethodStrategy;
use App\Classes\Api\Response;
use App\Classes\Modules\Interfaces\ModuleInterface;

class Cart implements ModuleInterface
{
    public static function getAll(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new GetMethodStrategy(str_replace('{$user_id}', $additionalData['user_id'], config('app.api_endpoints.cart')), $requestData), $additionalData);
            //dd($jsonData);
        }

        $response = (new Response($jsonData))->decode()->content();

        if(isset($additionalData['limit'])) {
            return new \LimitIterator(new \ArrayIterator($response), 0, $additionalData['limit']);
        }

        return new \ArrayIterator($response);
    }

    public static function addToCart(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(str_replace('{$user_id}', $additionalData['user_id'], config('app.api_endpoints.addToCart')), $requestData), $additionalData);
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }

    public static function removeFromCart(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(str_replace('{$user_id}', $additionalData['user_id'], config('app.api_endpoints.removeFromCart')), $requestData), $additionalData);
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }

    public static function extraData(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new GetMethodStrategy(str_replace('{$user_id}', $additionalData['user_id'], config('app.api_endpoints.cartExtraData')), $requestData), $additionalData);
        }

        $response = (new Response($jsonData))->decode()->content();

        if(isset($additionalData['limit'])) {
            return new \LimitIterator(new \ArrayIterator($response), 0, $additionalData['limit']);
        }

        return new \ArrayIterator($response);
    }

    public static function checkout(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(str_replace('{$user_id}', $additionalData['user_id'], config('app.api_endpoints.checkout')), $requestData), $additionalData);
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }


    public static function notify(array $requestData, array $additionalData = array()) : \Iterator
    {

     $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.notify'), $requestData), $additionalData);


        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }
}