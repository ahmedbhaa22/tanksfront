<?php
namespace App\Classes\Api;

use \GuzzleHttp\Client;

use App\Classes\Api\HttpMethodStrategyInterface;

class DeleteMethodStrategy implements HttpMethodStrategyInterface
{

    private $method = "DELETE";

    private $url;

    private $requestData = [];

    public function __construct(string $url, array $requestData = [])
    {
        $this->url = $url;
        $this->requestData = $requestData;
    }

    public function send()
    {
        $client = new Client();

        if(!empty($this->requestData)) {
            return $client->request($this->method, $this->url, [
                'json' => $this->requestData
            ])->getBody()->getContents();
        }

        return $client->request($this->method, $this->url)->getBody()->getContents();
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function getRequestData()
    {
        return $this->requestData;
    }
}