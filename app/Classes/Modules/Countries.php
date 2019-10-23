<?php
/**
 * Created by PhpStorm.
 * User: Ash
 * Date: 11/16/2017
 * Time: 1:42 PM
 */

namespace App\Classes\Modules;


use App\Classes\Api\Api;
use App\Classes\Api\GetMethodStrategy;
use App\Classes\Api\Response;
use App\Classes\Modules\Interfaces\ModuleInterface;

class Countries implements ModuleInterface
{
    public static function getAll(array $requestData, array $additionalData = array()) : \Iterator
    {
        $json_data = Api::makeRequest(new GetMethodStrategy(config('app.api_endpoints.countries'), $requestData), $additionalData);
        $response  = (new Response($json_data))->decode()->content();
        return new \ArrayIterator($response);
    }

}