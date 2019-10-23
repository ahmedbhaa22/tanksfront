<?php
namespace App\Classes\Modules;

use App\Classes\Api\Api;
use App\Classes\Api\GetMethodStrategy;
use App\Classes\Api\Response;
use App\Classes\Modules\Interfaces\ModuleInterface;

class Regions implements ModuleInterface
{
    public static function getAll(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new GetMethodStrategy(config('app.api_endpoints.regions'), $requestData), $additionalData);
        }

        $response = (new Response($jsonData))->decode()->content();

        if(isset($additionalData['limit'])) {
            return new \LimitIterator(new \ArrayIterator($response), 0, $additionalData['limit']);
        }

        return new \ArrayIterator($response);
    }
}