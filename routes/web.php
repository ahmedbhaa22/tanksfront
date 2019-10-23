<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// language route
Route::get('change-locale/{locale}', ['as'=>'locale.switch', 'uses'=>'LanguageController@switchLocale']);

// these are routes for the site controller
Route::get('/', ['as' => 'home', 'uses' => 'SiteController@index']);

Route::get('about-us', ['as' => 'about-us', 'uses' => 'SiteController@about']);

Route::get('profile', ['as' => 'profile', 'uses' => 'SiteController@profile']);

Route::get('branches', ['as' => 'branches', 'uses' => 'SiteController@branches']);

Route::get('factory', ['as' => 'factory', 'uses' => 'SiteController@factory']);

Route::get('brochures', ['as' => 'brochures', 'uses' => 'SiteController@brochures']);

Route::get('events', ['as' => 'events', 'uses' => 'SiteController@events']);

Route::get('event-details/{id}/{slug}', ['as' => 'event-details', 'uses' => 'SiteController@eventDetails']);

Route::get('photo-gallery', ['as' => 'photo-gallery', 'uses' => 'SiteController@photoGallery']);

Route::get('video-gallery', ['as' => 'video-gallery', 'uses' => 'SiteController@videoGallery']);

Route::get('page/{id}/{slug}', ['as' => 'page', 'uses' => 'SiteController@page']);

Route::get('contact-us', ['as' => 'contact-us', 'uses' => 'SiteController@contact']);

Route::post('contact-us', ['as' => 'post-contact-us', 'uses' => 'SiteController@postContact']);

Route::get('careers', ['as' => 'careers', 'uses' => 'SiteController@careers']);

Route::get('careers-apply', ['as' => 'careers-apply', 'uses' => 'SiteController@careersApply']);

Route::get('faq', ['as' => 'faq', 'uses' => 'SiteController@faq']);

Route::get('rss', ['as' => 'rss', 'uses' => 'SiteController@rss']);

Route::get('terms-conditions', ['as' => 'terms-conditions', 'uses' => 'SiteController@terms']);

Route::get('sitemap', ['as' => 'sitemap', 'uses' => 'SiteController@sitemap']);

Route::get('search', ['as'=>'search','uses'=>'SearchController@index']);
Route::post('search-products', ['as'=>'search-products','uses'=>'SearchController@searchProducts']);
Route::post('search-categories', ['as'=>'search-categories','uses'=>'SearchController@searchCategories']);
Route::post('search-offers', ['as'=>'search-offers','uses'=>'SearchController@searchOffers']);
Route::post('search-events', ['as'=>'search-events','uses'=>'SearchController@searchEvents']);

// Products and product category routes
Route::get('product-category/{id}/{slug}', ['as' => 'product-category', 'uses' => 'SiteController@productCategory']);

Route::get('service-details/{id}/{slug}', ['as' => 'service-details', 'uses' => 'SiteController@serviceDetails']);

Route::get('maintainance', ['as' => 'maintainance', 'uses' => 'SiteController@maintainance']);

Route::get('maintainance-tracking', ['as' => 'maintainance-tracking', 'uses' => 'SiteController@maintainanceTracking']);

Route::post('newsletter', ['as' => 'newsletter', 'uses' => 'SiteController@newsletter']);

Route::post('request-visit', ['as' => 'request-visit', 'uses' => 'SiteController@requestVisit']);

//
// User Routes
Route::get('login', ['as' => 'login', 'uses' => 'UserController@login']);

Route::get('logout', ['as' => 'logout', 'uses' => 'UserController@logout']);

Route::post('login', ['as' => 'postLogin', 'uses' => 'UserController@postLogin']);

Route::get('request-token', ['as' => 'requestToken', 'uses' => 'UserController@requestToken']);

Route::get('register', ['as' => 'register', 'uses' => 'UserController@register']);

Route::post('register', ['as' => 'postRegister', 'uses' => 'UserController@postRegister']);

Route::get('confirm-register', ['as' => 'confirm-register', 'uses' => 'UserController@confirmRegisteration']);

Route::get('check-email', ['as' => 'check-email', 'uses' => 'UserController@checkEmail']);

Route::post('check-email', ['as' => 'post-check-email', 'uses' => 'UserController@postCheckEmail']);

Route::get('reset-password', ['as' => 'reset-password', 'uses' => 'UserController@resetPassword']);

Route::post('reset-password', ['as' => 'post-reset-password', 'uses' => 'UserController@postResetpassword']);

Route::get('user-profile', ['as' => 'user-profile', 'uses' => 'UserController@userProfile']);

Route::get('user-orders', ['as' => 'user-orders', 'uses' => 'UserController@userOrders']);

Route::get('shipping-addresses', ['as' => 'shipping-addresses', 'uses' => 'UserController@shippingAddresses']);

Route::get('add-shipping-address', ['as' => 'add-shipping-address', 'uses' => 'UserController@addShipping']);

Route::post('add-shipping-address', ['as' => 'post-add-shipping-address', 'uses' => 'UserController@PostAddShipping']);

Route::get('edit-shipping-address/{id}', ['as' => 'edit-shipping-address', 'uses' => 'UserController@editShipping']);

Route::put('edit-shipping-address/{id}', ['as' => 'update-shipping-address', 'uses' => 'UserController@updateShipping']);

Route::delete('delete-shipping-address', ['as' => 'delete-shipping-address', 'uses' => 'UserController@deleteShipping']);

Route::post('set-main-shipping-address', ['as' => 'set-main-shipping-address', 'uses' => 'UserController@setMainShipping']);

Route::get('account-settings', ['as' => 'account-settings', 'uses' => 'UserController@accountSettings']);

Route::post('account-settings', ['as' => 'post-account-settings', 'uses' => 'UserController@postAccountSettings']);

Route::get('change-password', ['as' => 'change-password', 'uses' => 'UserController@changePassword']);

Route::post('change-password', ['as' => 'post-change-password', 'uses' => 'UserController@PostChangePassword']);

Route::get('get-region-cities', ['as' => 'get-region-cities', 'uses' => 'UserController@getRegionCities']);

Route::post('change-profile-image', ['as' => 'change-profile-image' , 'uses' => 'UserController@changeProfileImage']);

Route::get('purchase-prove/{id}', ['as' => 'purchase-prove', 'uses' => 'UserController@purchaseProve']);

Route::post('add-purchase-prove', ['as' => 'add-purchase-prove', 'uses' => 'UserController@addPurchaseProve']);
//
// these are the routes for the store controller
Route::group(['namespace' => 'Store', 'prefix' => 'store'], function(){

    Route::get('/', ['as' => 'store', 'uses' => 'StoreController@index']);

    Route::get('offers', ['as' => 'offers', 'uses' => 'StoreController@offers']);

    Route::get('offer-details/{id}/{slug}', ['as' => 'offer-details', 'uses' => 'StoreController@offerDetails']);

    Route::get('shopping-center', ['as' => 'shopping-center', 'uses' => 'StoreController@shoppingCenter']);

    Route::get('manufactures', ['as' => 'manufactures', 'uses' => 'StoreController@manufactures']);

    Route::get('product-details/{id}/{slug}', ['as' => 'product-details', 'uses' => 'StoreController@productDetails']);

    Route::get('wish-list', ['as' => 'wish-list', 'uses' => 'StoreController@wishList']);

    Route::post('add-to-wish-list', ['as' => 'add-to-wish-list', 'uses' => 'StoreController@addToWishList']);

    Route::get('compare-product', ['as' => 'compare-product', 'uses'=> 'StoreController@compareProduct']);

    Route::post('post-compare-product', ['as' => 'post-compare-product', 'uses'=> 'StoreController@postCompareProduct']);

    Route::delete('remove-compare-product', ['as' => 'remove-compare-product', 'uses' => 'StoreController@removeComparedProduct']);

    Route::get('getCartCount', ['as'=>'getCartCount', 'uses'=>'StoreController@getCartCount']);

    Route::post('submitUserReview', ['as'=>'submitUserReview','uses'=>'StoreController@submitReview']);
//

//
    Route::get('shopping-cart', ['as' => 'shopping-cart', 'uses' => 'StoreController@shoppingCart']);
    Route::post('add-to-cart', ['as' => 'add-to-cart', 'uses' => 'StoreController@addToCart']);
    Route::post('remove-from-cart', ['as' => 'remove-from-cart', 'uses' => 'StoreController@removeFromCart']);

    Route::post('shopping-cart', ['as' => 'post-shopping-cart', 'uses' => 'StoreController@checkout']);
});


Route::group(['namespace' => 'Test', 'prefix' => 'test'], function(){
    Route::get('test', ['as' => 'test', 'uses' => 'TestController@index']);
});