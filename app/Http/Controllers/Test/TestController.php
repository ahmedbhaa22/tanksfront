<?php

/**
 * Created by PhpStorm.
 * User: iSlAm
 * Date: 7/9/2018
 * Time: 12:43 AM
 */
namespace App\Http\Controllers\Test;
use App\Http\Controllers\ParentController;
class TestController extends ParentController
{
    public function index(){
        dd(\Session::get('loggedIn'));
    }
}