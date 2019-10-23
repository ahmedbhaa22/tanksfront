<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests;
use Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function switchLocale($locale)
    {
        if (array_key_exists($locale, Config::get('languages'))) {
            Session::put('app_locale', $locale);
//            App::setLocale($locale);
            // send remote call to static data api
//            \Helpers::getTranslatedStaticData(true);
        }
        return Redirect::back();
    }
}