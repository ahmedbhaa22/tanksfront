<?php
/**
 * Here you register the breadcrumbs like Home > About
 * note that breadcrumb are based on the
 * existing routes that you defined on
 * the routes/web.php file so if you need
 * to register a new breadcrumb
 * you have to define the route first on the
 * web.php file on the routes folder
 */

// Home
Breadcrumbs::register('home', function ($breadcrumbs) {
    $breadcrumbs->push(__('_header.home'), route('home'));
});

// Store
Breadcrumbs::register('store', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('_header.store'), route('store'));
});

// Site Breadcrumbs

// Home > About
Breadcrumbs::register('about-us', function ($breadcrumbs, $page) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($page['name'], route('about-us'));
});

Breadcrumbs::register('profile', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('_header.profile'), route('profile'));
});

Breadcrumbs::register('branches', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('_header.branches'), route('branches'));
});

Breadcrumbs::register('factory', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('_header.factory'), route('factory'));
});

Breadcrumbs::register('brochures', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('_header.brochures'), route('brochures'));
});

Breadcrumbs::register('events', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('_header.events'), route('events'));
});

Breadcrumbs::register('event-details', function ($breadcrumbs, $event) {
    $breadcrumbs->parent('events');
    $breadcrumbs->push($event['name'], route('event-details', $event));
});

Breadcrumbs::register('photo-gallery', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('_header.photo_gallery'), route('photo-gallery'));
});

Breadcrumbs::register('video-gallery', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('_header.video_gallery'), route('video-gallery'));
});

Breadcrumbs::register('page', function ($breadcrumbs, $page) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($page['name'], route('page', $page));
});

Breadcrumbs::register('contact-us', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('_header.contact_us'), route('contact-us'));
});

Breadcrumbs::register('careers', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('_footer.join_us'), route('careers'));
});

Breadcrumbs::register('careers-apply', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('_footer.join_us'), route('careers-apply'));
});

Breadcrumbs::register('faq', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('_footer.faq'), route('faq'));
});

Breadcrumbs::register('terms-conditions', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('_footer.terms'), route('terms-conditions'));
});

Breadcrumbs::register('sitemap', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('_footer.site_map'), route('sitemap'));
});

Breadcrumbs::register('rss', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('_footer.rss'), route('rss'));
});

Breadcrumbs::register('maintainance', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('_footer.maintenance'), route('maintainance'));
});

Breadcrumbs::register('maintainance-tracking', function ($breadcrumbs) {
    $breadcrumbs->parent('maintainance');
    $breadcrumbs->push('Maintainance Tracking', route('maintainance-tracking'));
});

Breadcrumbs::register('product-category', function ($breadcrumbs, $category) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($category['name'], route('product-category', $category));
});

Breadcrumbs::register('service-details', function ($breadcrumbs, $service) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push($service['name'], route('service-details', $service));
});

// Store breadcrumbs
Breadcrumbs::register('offers', function ($breadcrumbs) {
    $breadcrumbs->parent('store');
    $breadcrumbs->push(__('_store_offers.offers'), route('offers'));
});

Breadcrumbs::register('offer-details', function ($breadcrumbs, $offer) {
    $breadcrumbs->parent('offers');
    $breadcrumbs->push($offer['name'], route('offer-details', $offer));
});

Breadcrumbs::register('shopping-center', function ($breadcrumbs) {
    $breadcrumbs->parent('store');
    $breadcrumbs->push(__('_store_shopping_center.shopping_center'), route('shopping-center'));
});

Breadcrumbs::register('manufactures', function ($breadcrumbs) {
    $breadcrumbs->parent('store');
    $breadcrumbs->push(__('_store_manufacturers.manufacturers'), route('manufactures'));
});

Breadcrumbs::register('product-details', function ($breadcrumbs, $product) {
    $breadcrumbs->parent('shopping-center');
    $breadcrumbs->push($product['name'], route('product-details', $product));
});

Breadcrumbs::register('wish-list', function ($breadcrumbs) {
    $breadcrumbs->parent('store');
    $breadcrumbs->push(__('_store_wishlist.wishlist'), route('wish-list'));
});

Breadcrumbs::register('compare-product', function ($breadcrumbs) {
    $breadcrumbs->parent('store');
    $breadcrumbs->push(__('_store_compare.compare_products'), route('compare-product'));
});

Breadcrumbs::register('shopping-cart', function ($breadcrumbs) {
    $breadcrumbs->parent('store');
    $breadcrumbs->push(__('_store_shopping_cart.shopping_cart'), route('shopping-cart'));
});

Breadcrumbs::register('checkout', function ($breadcrumbs) {
    $breadcrumbs->parent('shopping-cart');
    $breadcrumbs->push('Checkout', route('checkout'));
});

// Users
Breadcrumbs::register('login', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('_user_login.login'), route('login'));
});

Breadcrumbs::register('register', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('_user_register.register'), route('register'));
});

Breadcrumbs::register('reset-password', function ($breadcrumbs) {
    $breadcrumbs->parent('home');
    $breadcrumbs->push(__('_user_reset_password.reset'), route('reset-password'));
});

// User Account
Breadcrumbs::register('user-orders', function ($breadcrumbs) {
    $breadcrumbs->parent('shopping-center');
    $breadcrumbs->push(__('_user_orders.orders'), route('user-orders'));
});

Breadcrumbs::register('shipping-addresses', function ($breadcrumbs) {
    $breadcrumbs->parent('user-orders');
    $breadcrumbs->push(__('_user_shipping_addresses.shipping_addresses'), route('shipping-addresses'));
});

Breadcrumbs::register('add-shipping-address', function ($breadcrumbs) {
    $breadcrumbs->parent('shipping-addresses');
    $breadcrumbs->push(__('_user_add_address.add_address'), route('add-shipping-address'));
});

Breadcrumbs::register('edit-shipping-address', function ($breadcrumbs) {
    $breadcrumbs->parent('shipping-addresses');
    $breadcrumbs->push(__('_user_edit_address.edit_address'), route('edit-shipping-address'));
});

Breadcrumbs::register('account-settings', function ($breadcrumbs) {
    $breadcrumbs->parent('user-orders');
    $breadcrumbs->push(__('_user_account_settings.settings'), route('account-settings'));
});

Breadcrumbs::register('change-password', function ($breadcrumbs) {
    $breadcrumbs->parent('user-orders');
    $breadcrumbs->push(__('_user_change_password.change_password'), route('change-password'));
});