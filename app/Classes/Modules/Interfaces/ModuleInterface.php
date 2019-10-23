<?php
namespace App\Classes\Modules\Interfaces;

interface ModuleInterface
{
    public static function getAll(array $requestData, array $additionalData = array()) : \Iterator;
}