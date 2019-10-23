<?php
namespace App\Classes\Api;

use \GuzzleHttp\Client;

use App\Classes\Api\HttpMethodStrategyInterface;

class PostMethodStrategy implements HttpMethodStrategyInterface
{

    private $method = "POST";

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

        return $client->request($this->method, $this->url, [
            'json' => $this->requestData
        ])->getBody()->getContents();
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