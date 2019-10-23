<?php
namespace App\Classes\Api;

class Api
{
    public static function makeRequest(HttpMethodStrategyInterface $methodStrategy) : array
    {
        return (new self())->sendHttpRequest($methodStrategy);
    }

    private function sendHttpRequest(HttpMethodStrategyInterface $methodStrategy) : array
    {
        try {

            $result = $methodStrategy->send();

            if(!$result || empty($result)) {
                throw new \Exception("curl response error");
            }

            return ["state" => 1,"result" => $result];
        }catch (Exception $ex){
            return ["state" => 0, "result" => $ex->getMessage()];
        }
    }

//    public static function sendHttpRequest(HttpMethodStrategyInterface $methodStrategy) : array
//    {
//        try {
//
//            if($methodStrategy->getMethod() == "POST" || $methodStrategy->getMethod() == "DELETE") {
//                $opts = array(
//                    'http' => array(
//                        "method" => $methodStrategy->getMethod(),
//                        "max_redirects" => 10,
//                        "header" => "Content-type: application/json; cache-control: no-cache; User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0",
//                        "content" => json_encode($methodStrategy->getRequestData())
//                    )
//                );
//            } else {
//                $opts = array(
//                    'http' => array(
//                        "method" => "GET",
//                        "max_redirects" => 10,
//                        "header" => "Content-type: application/json; cache-control: no-cache; User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0"
//                    )
//                );
//
//                if(!empty($methodStrategy->getRequestData())) {
//                    $opts['http']['content'] = http_build_query($methodStrategy->getRequestData());
//                }
//            }
//
//            $default = stream_context_create($opts);
//            $result = file_get_contents($methodStrategy->getUrl(), false, $default);
//
//            if(!$result || empty($result)) {
//                throw new \Exception("curl response error");
//            }
//
//            return ["state" => 1,"result" => $result, true];
//        }catch (Exception $ex){
//            return ["state" => 0, "result" => $ex->getMessage()];
//        }
//    }

//    public static function sendHttpRequest(HttpMethodStrategyInterface $methodStrategy) : array
//    {
//        try {
//
//            $curl_handle = curl_init();
//
//            if($methodStrategy->getMethod() == "GET") {
//                if(!empty($methodStrategy->getRequestData())) {
//                    curl_setopt($curl_handle, CURLOPT_URL, $methodStrategy->getUrl()."?".http_build_query($methodStrategy->getRequestData()));
//                } else {
//                    curl_setopt($curl_handle, CURLOPT_URL, $methodStrategy->getUrl());
//                }
//                curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "GET");
//                curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 1);
//                curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
//                curl_setopt($curl_handle, CURLOPT_USERAGENT, 'User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
//            } else if($methodStrategy->getMethod() == "POST") {
//                curl_setopt($curl_handle, CURLOPT_URL, $methodStrategy->getUrl());
//                curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 1);
//                curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
//                curl_setopt($curl_handle, CURLOPT_USERAGENT, 'User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
//                curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "POST");
//                curl_setopt($curl_handle, CURLOPT_POSTFIELDS, json_encode($methodStrategy->getRequestData()));
//            } else if($methodStrategy->getMethod() == "DELETE") {
//                curl_setopt($curl_handle, CURLOPT_URL, $methodStrategy->getUrl());
//                curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 1);
//                curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, TRUE);
//                curl_setopt($curl_handle, CURLOPT_USERAGENT, 'User-Agent: Mozilla/5.0 (Windows NT 5.1; rv:31.0) Gecko/20100101 Firefox/31.0');
//                curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, "DELETE");
//                if(!empty($methodStrategy->getRequestData())) {
//                    curl_setopt($curl_handle, CURLOPT_POSTFIELDS, json_encode($methodStrategy->getRequestData()));
//                }
//            }
//
//            curl_setopt($curl_handle, CURLOPT_MAXREDIRS, 10);
//            curl_setopt($curl_handle, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
//            curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
//            curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST, false);
//            curl_setopt($curl_handle, CURLOPT_HTTPHEADER, array(
//                "cache-control: no-cache",
//                "postman-token: 3401996f-e28a-d34e-23b6-2ccadfe1cd0c"
//            ));
//
//            $curl_log = fopen(__DIR__."/log.txt", 'w');
//            curl_setopt($curl_handle, CURLOPT_VERBOSE, 1);
//            curl_setopt($curl_handle, CURLOPT_STDERR, $curl_log);
//
//            $result = curl_exec($curl_handle);
//            curl_close($curl_handle);
//
//            if(!$result || empty($result)) {
//                throw new \Exception("curl response error");
//            }
//
//            return ["state" => 1,"result" => $result, true];
//        }catch (Exception $ex){
//            return ["state" => 0, "result" => $ex->getMessage()];
//        }
//    }
}