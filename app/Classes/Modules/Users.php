<?php
namespace App\Classes\Modules;

use App\Classes\Api\Api;
use App\Classes\Api\GetMethodStrategy;
use App\Classes\Api\PostMethodStrategy;
use App\Classes\Api\Response;

class Users
{
    public static function login(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.login'), $requestData));
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }

    public static function register(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.register'), $requestData));
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }

    public static function confirmRegisteration(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new GetMethodStrategy(config('app.api_endpoints.confirmRegisteration'), $requestData));
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }

    public static function requestToken(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.requestToken'), $requestData));
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }

    public static function userProfile(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new GetMethodStrategy(config('app.api_endpoints.userProfile'), $requestData));
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }

    public static function logout(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.logout'), $requestData));
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }

    public static function changePassword(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.changePassword'), $requestData));
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }

    public static function userOrders(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.userOrders'), $requestData));
        }

        $response = (new Response($jsonData))->decode()->content();

        return new \ArrayIterator($response);
    }

    public static function editUserProfile(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.editUserProfile'), $requestData));
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }

    public static function checkNewsLetterSubscription($request_data, $additional_data = []) : \Iterator
    {
        $json_data = Api::makeRequest(new GetMethodStrategy(config('app.api_endpoints.newsLetterSubscription'), $request_data));
        $response = (new Response($json_data))->decode()->content();
        return new \ArrayIterator($response);
    }

    public static function checkEmail(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.checkEmail'), $requestData));
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }

    public static function resetPassword(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.forgetPassword'), $requestData));
        }

        $response = (new Response($jsonData))->decode();

        return new \ArrayIterator(['response' => $response]);
    }

    public static function changeProfileImage(array $requestData) : \Iterator
    {
        $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.changeProfileImage'), $requestData));

        $response = (new Response($jsonData))->decode()->content();

        return new \ArrayIterator($response);
    }

    public static function addPurchaseProve(array $requestData) : \Iterator
    {

        $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.addPurchaseProve'), $requestData));
        $response = (new Response($jsonData))->decode()->content();

        return new \ArrayIterator($response);
    }
}