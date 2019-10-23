<?php
namespace App\Classes\Modules;

use App\Classes\Api\Api;
use App\Classes\Api\GetMethodStrategy;
use App\Classes\Api\PostMethodStrategy;
use App\Classes\Api\DeleteMethodStrategy;
use App\Classes\Api\Response;
use App\Classes\Modules\Interfaces\ModuleInterface;

class Compare implements ModuleInterface
{
    public static function getAll(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $url = sprintf(config('app.api_endpoints.getCompareProducts'), $additionalData['user_id']);
            $jsonData = Api::makeRequest(new GetMethodStrategy($url, $requestData), $additionalData);
        }

        $response = (new Response($jsonData))->decode()->content();

        if(isset($additionalData['limit'])) {
            return new \LimitIterator(new \ArrayIterator($response), 0, $additionalData['limit']);
        }

        return new \ArrayIterator($response);
    }

    public static function compareProducts(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $url = sprintf(config('app.api_endpoints.compareProducts'), $additionalData['user_id'], $additionalData['item_id']);
            $jsonData = Api::makeRequest(new PostMethodStrategy($url, $requestData), $additionalData);
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }

    public static function remove(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $url = sprintf(config('app.api_endpoints.removeCompared'), $additionalData['user_id'], $additionalData['item_id']);
            $jsonData = Api::makeRequest(new DeleteMethodStrategy($url, $requestData), $additionalData);
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }
}