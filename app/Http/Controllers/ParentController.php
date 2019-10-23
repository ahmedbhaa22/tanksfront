<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Classes\Categories;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;

class ParentController extends Controller
{
    protected $activeLang = '';

    function __construct()
    {
       // $this->activeLang = App::isLocale('ar')?1:2;
    }

    public function setActiveLang()
    {
    	$this->activeLang = \App::isLocale('ar')?1:2;
    }
}