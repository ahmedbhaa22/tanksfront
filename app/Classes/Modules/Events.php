<?php
namespace App\Classes\Modules;

use App\Classes\Api\Api;
use App\Classes\Filters\EventsFilterIterator;
use App\Classes\Api\PostMethodStrategy;
use App\Classes\Api\Response;
use App\Classes\Modules\Interfaces\ModuleInterface;

class Events implements ModuleInterface
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

        // iterate array and append time components to each element
        array_walk($response, function(&$v, $k){
            $eventTime = getdate($v['created_at']);
            $v["created_year"] = $eventTime['year'];
            $v["created_month"] = $eventTime['month'];
            $v["created_day"] = $eventTime['mday'];
        });

        if(isset($additionalData['limit'])) {
            return new \LimitIterator(new \ArrayIterator($response), 0, $additionalData['limit']);
        }

        return new \ArrayIterator($response);
    }

    public static function getByName(array $request_data, array $additional_data = []) : \Iterator
    {
        $json_data = Api::makeRequest(new PostMethodStrategy(config('app.api_endpoints.default'), $request_data));
        $response = (new Response($json_data))->decode()->content();
        return new \ArrayIterator($response);
    }
}