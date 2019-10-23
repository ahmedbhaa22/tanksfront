<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class HelpersServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // send remote call to static data api
//        \Helpers::getTranslatedStaticData();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        foreach (glob(app_path().'/Classes/Helpers.php') as $filename){
            require_once($filename);
        }
    }
}
