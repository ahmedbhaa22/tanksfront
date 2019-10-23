<?php
namespace App\Classes\Modules;

use App\Classes\Api\Api;
use App\Classes\Api\PostMethodStrategy;
use App\Classes\Api\Response;
use App\Classes\Modules\Interfaces\ModuleInterface;

class Pages implements ModuleInterface
{
    public static function getAll(array $requestData, array $additionalData = array()) : \Iterator
    {
        if(isset($additionalData['mockFile'])) {
            $jsonData = file_get_contents(__DIR__ . "/../../../json/" . $additionalData['mockFile']);
            $jsonData = ["state" => 1, "result" => $jsonData];
        } else {
            $jsonData = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.default'), $requestData));
        }

        $response = (new Response($jsonData))->decode()->content();

        return new \ArrayIterator($response);
    }
}