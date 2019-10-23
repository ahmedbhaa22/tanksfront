<?php
namespace App\Classes\Api;

use App\Classes\Api\HttpMethodStrategyInterface;

interface ApiInterface
{
    public static function makeRequest(HttpMethodStrategyInterface $methodStrategy, array $data) : array;
}