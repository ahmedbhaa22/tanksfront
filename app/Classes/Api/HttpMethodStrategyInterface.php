<?php
namespace App\Classes\Api;

interface HttpMethodStrategyInterface
{
    public function send();

    public function getMethod();

    public function getUrl();

    public function getRequestData();
}