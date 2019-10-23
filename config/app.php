<?php
$api_provider_url = "https://apitanks.tk/";
return [

    /*
    |--------------------------------------------------------------------------
    | Application Name
    |--------------------------------------------------------------------------
    |
    | This value is the name of your application. This value is used when the
    | framework needs to place the application's name in a notification or
    | any other location as required by the application or its packages.
    |
    */

    'name' => env('APP_NAME', 'Arabia Tanks'),

    'api_endpoints' => [
        'default'               => $api_provider_url.'cms_module/apis/index',
        'branches'              => $api_provider_url.'cms_module/apis/companyBranches',
        'regions'               => $api_provider_url.'offers_module/apis/regions',
        'cities'                => $api_provider_url.'offers_module/apis/cities',
        'countries'             => $api_provider_url.'offers_module/apis/countries',
        'offers'                => $api_provider_url.'offers_module/apis/get',
        'offer'                 => $api_provider_url.'offers_module/apis/get/{$id}',
        'productsInOffer'       => $api_provider_url.'offers_module/apis/items/{$offer_id}',
        'cart'                  => $api_provider_url.'cart_module/apis/cart/{$user_id}',
        'cartExtraData'         => $api_provider_url.'cart_module/apis/extraData/{$user_id}',
        'checkout'              => $api_provider_url.'cart_module/apis/checkout/{$user_id}',
        'addToCart'             => $api_provider_url.'cart_module/apis/addToCart/{$user_id}',
        'removeFromCart'        => $api_provider_url.'cart_module/apis/removeFromCart/{$user_id}',
        'homeOffers'            => $api_provider_url.'offers_module/apis/inHomePage',
        'wishList'              => $api_provider_url.'cart_module/apis/wishlist/{$user_id}',
        'addToWishList'         => $api_provider_url.'cart_module/apis/addToWishlist/{$user_id}',
        'login'                 => $api_provider_url.'users_module/auth/login',
        'logout'                => $api_provider_url.'users_module/auth/logout',
        'register'              => $api_provider_url.'users_module/auth/register',
        'confirmRegisteration'  => $api_provider_url.'users_module/auth/confirmRegister',
        'requestToken'          => $api_provider_url.'users_module/auth/requestToken',
        'userProfile'           => $api_provider_url.'users_module/auth/userProfile',
        'editUserProfile'       => $api_provider_url.'users_module/user/editProfile',
        'changePassword'        => $api_provider_url.'users_module/auth/resetPassword',
        'products'              => $api_provider_url.'cms_module/apis/index',
        'product'               => $api_provider_url.'cms_module/apis/index',
        'bestSellingProducts'   => $api_provider_url.'cms_module/apis/index',
        'relatedProducts'       => $api_provider_url.'cms_module/apis/index',
        'shippingAddresses'     => $api_provider_url.'users_module/user/addresses/{$access_token}',
        'shippingAddress'       => $api_provider_url.'users_module/user/addresses/{$access_token}/{$address_id}',
        'addShippingAddress'    => $api_provider_url.'users_module/user/addAddress',
        'editShippingAddress'   => $api_provider_url.'users_module/user/updateAddress',
        'deleteShippingAddress' => $api_provider_url.'users_module/user/deleteAddress',
        'setMainShippingAddress'=> $api_provider_url.'users_module/user/setMainAddress',
        'userOrders'            => $api_provider_url.'users_module/user/orders',
        'ads'                   => $api_provider_url.'ads_module/api/index',
        'contactForm'           => $api_provider_url.'cms_module/apis/formSave/1',
        'compareProducts'       => $api_provider_url.'cms_module/apis/compare/%s/%s',
        'getCompareProducts'    => $api_provider_url.'cms_module/apis/comparedItems/%s',
        'removeCompared'        => $api_provider_url.'cms_module/apis/removeCompared/%s/%s',
        'newsletter'            => $api_provider_url.'cms_module/apis/newsletter',
        'requestVisit'          => $api_provider_url.'cms_module/apis/requestVisit',
        'staticData'            => $api_provider_url.'cms_module/apis/index',
        'productReviews'        => $api_provider_url.'cms_module/apis/getReviews/{$product_id}',
        'submitReview'          => $api_provider_url.'cms_module/apis/addReview',
        'getProductsByName'     => $api_provider_url.'cms_module/apis/index',
        'getOffersByName'       => $api_provider_url.'offers_module/apis/getOffersByName/{$name}',
        'newsLetterSubscription'=> $api_provider_url.'users_module/user/userSubscribedInNewsLetter',
        'newsletterUnsubscribe' => $api_provider_url.'users_module/user/newsletterUnsubscribe',
        'checkEmail'            => $api_provider_url.'users_module/auth/checkEmail',
        'forgetPassword'        => $api_provider_url.'users_module/auth/changePassword',
        'changeProfileImage'    => $api_provider_url.'users_module/user/changeProfileImage',
        'addPurchaseProve'    => $api_provider_url.'cart_module/apis/addOrderProve',
        'notify' =>$api_provider_url.'cms_module/apis/notify',
        'backend_url' => $api_provider_url.''
    ],

    /*
    |--------------------------------------------------------------------------
    | Application Environment
    |--------------------------------------------------------------------------
    |
    | This value determines the "environment" your application is currently
    | running in. This may determine how you prefer to configure various
    | services your application utilizes. Set this in your ".env" file.
    |
    */

    'env' => env('APP_ENV', 'production'),

    /*
    |--------------------------------------------------------------------------
    | Application Debug Mode
    |--------------------------------------------------------------------------
    |
    | When your application is in debug mode, detailed error messages with
    | stack traces will be shown on every error that occurs within your
    | application. If disabled, a simple generic error page is shown.
    |
    */

    'debug' => env('APP_DEBUG', TRUE),

    /*
    |--------------------------------------------------------------------------
    | Application URL
    |--------------------------------------------------------------------------
    |
    | This URL is used by the console to properly generate URLs when using
    | the Artisan command line tool. You should set this to the root of
    | your application so that it is used when running Artisan tasks.
    |
    */

    'url' => env('APP_URL', 'http://localhost'),

    /*
    |--------------------------------------------------------------------------
    | Application Timezone
    |--------------------------------------------------------------------------
    |
    | Here you may specify the default timezone for your application, which
    | will be used by the PHP date and date-time functions. We have gone
    | ahead and set this to a sensible default for you out of the box.
    |
    */

    'timezone' => 'UTC',

    /*
    |--------------------------------------------------------------------------
    | Application Locale Configuration
    |--------------------------------------------------------------------------
    |
    | The application locale determines the default locale that will be used
    | by the translation service provider. You are free to set this value
    | to any of the locales which will be supported by the application.
    |
    */

    'locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Application Fallback Locale
    |--------------------------------------------------------------------------
    |
    | The fallback locale determines the locale to use when the current one
    | is not available. You may change the value to correspond to any of
    | the language folders that are provided through your application.
    |
    */

    'fallback_locale' => 'en',

    /*
    |--------------------------------------------------------------------------
    | Encryption Key
    |--------------------------------------------------------------------------
    |
    | This key is used by the Illuminate encrypter service and should be set
    | to a random, 32 character string, otherwise these encrypted strings
    | will not be safe. Please do this before deploying an application!
    |
    */

    'key' => env('APP_KEY'),

    'cipher' => 'AES-256-CBC',

    /*
    |--------------------------------------------------------------------------
    | Logging Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the log settings for your application. Out of
    | the box, Laravel uses the Monolog PHP logging library. This gives
    | you a variety of powerful log handlers / formatters to utilize.
    |
    | Available Settings: "single", "daily", "syslog", "errorlog"
    |
    */

    'log' => env('APP_LOG', 'single'),

    'log_level' => env('APP_LOG_LEVEL', 'debug'),

    /*
    |--------------------------------------------------------------------------
    | Autoloaded Service Providers
    |--------------------------------------------------------------------------
    |
    | The service providers listed here will be automatically loaded on the
    | request to your application. Feel free to add your own services to
    | this array to grant expanded functionality to your applications.
    |
    */

    'providers' => [

        /*
         * Laravel Framework Service Providers...
         */
        Illuminate\Auth\AuthServiceProvider::class,
        Illuminate\Broadcasting\BroadcastServiceProvider::class,
        Illuminate\Bus\BusServiceProvider::class,
        Illuminate\Cache\CacheServiceProvider::class,
        Illuminate\Foundation\Providers\ConsoleSupportServiceProvider::class,
        Illuminate\Cookie\CookieServiceProvider::class,
        Illuminate\Database\DatabaseServiceProvider::class,
        Illuminate\Encryption\EncryptionServiceProvider::class,
        Illuminate\Filesystem\FilesystemServiceProvider::class,
        Illuminate\Foundation\Providers\FoundationServiceProvider::class,
        Illuminate\Hashing\HashServiceProvider::class,
        Illuminate\Mail\MailServiceProvider::class,
        Illuminate\Notifications\NotificationServiceProvider::class,
        Illuminate\Pagination\PaginationServiceProvider::class,
        Illuminate\Pipeline\PipelineServiceProvider::class,
        Illuminate\Queue\QueueServiceProvider::class,
        Illuminate\Redis\RedisServiceProvider::class,
        Illuminate\Auth\Passwords\PasswordResetServiceProvider::class,
        Illuminate\Session\SessionServiceProvider::class,
        Illuminate\Translation\TranslationServiceProvider::class,
        Illuminate\Validation\ValidationServiceProvider::class,
        Illuminate\View\ViewServiceProvider::class,

        /*
         * Package Service Providers...
         */

        /*
         * Application Service Providers...
         */
        App\Providers\AppServiceProvider::class,
        App\Providers\AuthServiceProvider::class,
        // App\Providers\BroadcastServiceProvider::class,
        App\Providers\EventServiceProvider::class,
        App\Providers\RouteServiceProvider::class,
        App\Providers\ShareWithViewServiceProvider::class,
        App\Providers\HelpersServiceProvider::class,
        Illuminate\Html\HtmlServiceProvider::class,
        

    ],

    /*
    |--------------------------------------------------------------------------
    | Class Aliases
    |--------------------------------------------------------------------------
    |
    | This array of class aliases will be registered when this application
    | is started. However, feel free to register as many as you wish as
    | the aliases are "lazy" loaded so they don't hinder performance.
    |
    */

    'aliases' => [

        'App' => Illuminate\Support\Facades\App::class,
        'Artisan' => Illuminate\Support\Facades\Artisan::class,
        'Auth' => Illuminate\Support\Facades\Auth::class,
        'Blade' => Illuminate\Support\Facades\Blade::class,
        'Broadcast' => Illuminate\Support\Facades\Broadcast::class,
        'Bus' => Illuminate\Support\Facades\Bus::class,
        'Cache' => Illuminate\Support\Facades\Cache::class,
        'Config' => Illuminate\Support\Facades\Config::class,
        'Cookie' => Illuminate\Support\Facades\Cookie::class,
        'Crypt' => Illuminate\Support\Facades\Crypt::class,
        'DB' => Illuminate\Support\Facades\DB::class,
        'Eloquent' => Illuminate\Database\Eloquent\Model::class,
        'Event' => Illuminate\Support\Facades\Event::class,
        'File' => Illuminate\Support\Facades\File::class,
        'Gate' => Illuminate\Support\Facades\Gate::class,
        'Hash' => Illuminate\Support\Facades\Hash::class,
        'Lang' => Illuminate\Support\Facades\Lang::class,
        'Log' => Illuminate\Support\Facades\Log::class,
        'Mail' => Illuminate\Support\Facades\Mail::class,
        'Notification' => Illuminate\Support\Facades\Notification::class,
        'Password' => Illuminate\Support\Facades\Password::class,
        'Queue' => Illuminate\Support\Facades\Queue::class,
        'Redirect' => Illuminate\Support\Facades\Redirect::class,
        'Redis' => Illuminate\Support\Facades\Redis::class,
        'Request' => Illuminate\Support\Facades\Request::class,
        'Response' => Illuminate\Support\Facades\Response::class,
        'Route' => Illuminate\Support\Facades\Route::class,
        'Schema' => Illuminate\Support\Facades\Schema::class,
        'Session' => Illuminate\Support\Facades\Session::class,
        'Storage' => Illuminate\Support\Facades\Storage::class,
        'URL' => Illuminate\Support\Facades\URL::class,
        'Validator' => Illuminate\Support\Facades\Validator::class,
        'View' => Illuminate\Support\Facades\View::class,
        'Html' => Illuminate\Html\HtmlFacade::class,
        'Form' => Illuminate\Html\FormFacade::class

    ],

];
