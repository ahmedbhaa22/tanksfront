<?php
namespace App\Classes\Modules;

use App\Classes\Api\Api;
use App\Classes\Api\GetMethodStrategy;
use App\Classes\Api\Response;
use App\Classes\Modules\Interfaces\ModuleInterface;

class Branches implements ModuleInterface
{
    public static function getAll(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new GetMethodStrategy(config('app.api_endpoints.branches'), $requestData));
        }

        $response = (new Response($jsonData))->decode()->content();

        return new \ArrayIterator($response);
    }
}