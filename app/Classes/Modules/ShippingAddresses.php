<?php
namespace App\Classes\Modules;

use App\Classes\Api\Api;
use App\Classes\Api\GetMethodStrategy;
use App\Classes\Api\PostMethodStrategy;
use App\Classes\Api\DeleteMethodStrategy;
use App\Classes\Api\Response;
use App\Classes\Modules\Interfaces\ModuleInterface;

class ShippingAddresses implements ModuleInterface
{
    public static function getAll(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new GetMethodStrategy(str_replace('{$access_token}', $additionalData['access_token'], config('app.api_endpoints.shippingAddresses')), $requestData));
        }

        $response = (new Response($jsonData))->decode()->content();

        return new \ArrayIterator($response);
    }

    public static function get(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $url = str_replace('{$access_token}', $additionalData['access_token'], config('app.api_endpoints.shippingAddress'));
            $url = str_replace('{$address_id}', $additionalData['address_id'], $url);
            $jsonData = Api::makeRequest(new GetMethodStrategy($url, $requestData));
        }

        $response = (new Response($jsonData))->decode()->content();

        return new \ArrayIterator($response);
    }

    public static function add(array $requestData, array $additionalData = array())  : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.addShippingAddress'), $requestData));
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }

    public static function edit(array $requestData, array $additionalData = array())  : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.editShippingAddress'), $requestData));
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }

    public static function delete(array $requestData, array $additionalData = array())  : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new DeleteMethodStrategy(config('app.api_endpoints.deleteShippingAddress'), $requestData));
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }

    public static function setMain(array $requestData, array $additionalData = array())  : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.setMainShippingAddress'), $requestData));
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }
}