<?php
namespace App\Classes\Modules;

use App\Classes\Api\Api;
use App\Classes\Api\GetMethodStrategy;
use App\Classes\Api\PostMethodStrategy;
use App\Classes\Api\Response;

class Forms
{
    public static function contactUs(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.contactForm'), $requestData), $additionalData);
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }

    public static function newsletter(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.newsletter'), $requestData), $additionalData);
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }

    public static function requestVisit(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.requestVisit'), $requestData), $additionalData);
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }

    public static function newsletterUnsubscribe($request_data): \Iterator
    {
        $json_data = Api::makeRequest(new GetMethodStrategy(config('app.api_endpoints.newsletterUnsubscribe'), $request_data));
        $response  = (new Response($json_data))->decode()->content();
        return new \ArrayIterator($response);
    }
}