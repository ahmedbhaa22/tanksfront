<?php
namespace App\Classes\Modules;

use App\Classes\Api\Api;
use App\Classes\Api\GetMethodStrategy;
use App\Classes\Api\PostMethodStrategy;
use App\Classes\Api\Response;
use App\Classes\Modules\Interfaces\ModuleInterface;

class Products implements ModuleInterface
{
    public static function getAll(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.products'), $requestData), $additionalData);
        }

        $response = (new Response($jsonData))->decode()->content();

        if(isset($additionalData['limit'])) {
            return new \LimitIterator(new \ArrayIterator($response), 0, $additionalData['limit']);
        }

        return new \ArrayIterator($response);
    }

    public static function getMostSelling(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.products'), $requestData), $additionalData);
        }

        $response = (new Response($jsonData))->decode()->content();

        if(isset($additionalData['limit'])) {
            return new \LimitIterator(new \ArrayIterator($response), 0, $additionalData['limit']);
        }

        return new \ArrayIterator($response);
    }
    public static function getById(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.product'), $requestData), $additionalData);
        }
        $response = (new Response($jsonData))->decode()->content();

        return new \ArrayIterator($response);
    }

    public static function getRelatedProducts(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.relatedProducts'), $requestData), $additionalData);
        }

        $response = (new Response($jsonData))->decode()->content();

        return new \ArrayIterator($response);
    }

    public static function getBestSellingProducts(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.bestSellingProducts'), $requestData), $additionalData);
        }

        $response = (new Response($jsonData))->decode()->content();

        return new \ArrayIterator($response);
    }

    public static function getProductReviews(array $requestData, array $additionalData=[]) : \Iterator
    {
        $jsonData = Api::makeRequest(new GetMethodStrategy(str_replace('{$product_id}', $additionalData['product_id'], config('app.api_endpoints.productReviews')), $requestData), $additionalData);

        $response = (new Response($jsonData))->decode()->content();

        return new  \ArrayIterator($response);
    }

    public static function submitProductReview(array $requestData, array $additionalData = []) : \Iterator
    {
        $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.submitReview'), $requestData), $additionalData);

        $response = (new Response($jsonData))->decode()->content();

        return new \ArrayIterator($response);
    }

    public static function getByName(array $requestData, array $additionalData = []) : \Iterator
    {
        $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.getProductsByName'), $requestData), $additionalData);

        $response = (new Response($jsonData))->decode()->content();

        return new \ArrayIterator($response);
    }
}