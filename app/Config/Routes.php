<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('product', 'Pages::product');
$routes->get('solutions', 'Pages::solutions');
$routes->get('pricing', 'Pages::pricing');
$routes->get('privacy', 'Pages::privacy');
$routes->get('contact', 'Pages::contact');
$routes->post('contact', 'Pages::contactSubmit');

$routes->get('login', 'Auth::loginForm');
$routes->post('login', 'Auth::login');
$routes->get('get-started', 'Auth::registerForm');
$routes->post('get-started', 'Auth::register');
$routes->get('logout', 'Auth::logout');
$routes->get('forgot-password', 'Auth::forgotForm');
$routes->post('forgot-password', 'Auth::forgot');
// Token travels as a query string, not a path segment — same reason as
// /unsubscribe (see BUILD-STATUS): CI4 decodes the URI before checking it
// against $permittedURIChars, so path segments are the fragile place to put
// generated values.
$routes->get('reset-password', 'Auth::resetForm');
$routes->post('reset-password', 'Auth::reset');

$routes->get('blog', 'Blog::index');
$routes->get('blog/(:segment)', 'Blog::show/$1');

$routes->post('waitlist', 'Waitlist::store');
$routes->get('unsubscribe', 'Waitlist::unsubscribe');

// -----------------------------------------------------------------
// Docs — public hub + per-page routes; /docs/developer is gated and
// must be registered before the generic '(:segment)' catch-all below.
// -----------------------------------------------------------------
$routes->get('docs', 'Docs::index');

$routes->group('docs', ['filter' => 'auth:admin'], static function ($routes) {
    $routes->get('developer', 'Docs::developer');
    $routes->get('developer/(:segment)', 'Docs::developerShow/$1');
});

$routes->get('docs/(:segment)', 'Docs::show/$1');

// -----------------------------------------------------------------
// Authenticated (any logged-in user)
// -----------------------------------------------------------------
$routes->group('account', ['filter' => 'auth'], static function ($routes) {
    $routes->get('/', 'Account::index');
});

// -----------------------------------------------------------------
// Admin — own auth system, role must be 'admin'.
// -----------------------------------------------------------------
$routes->group('admin', ['filter' => 'auth:admin'], static function ($routes) {
    $routes->get('/', 'Admin\Dashboard::index');

    $routes->post('upload-image', 'Admin\UploadController::image');

    $routes->get('blog', 'Admin\BlogController::index');
    $routes->get('blog/new', 'Admin\BlogController::new');
    $routes->post('blog', 'Admin\BlogController::create');
    $routes->get('blog/(:num)/edit', 'Admin\BlogController::edit/$1');
    $routes->post('blog/(:num)', 'Admin\BlogController::update/$1');
    $routes->post('blog/(:num)/delete', 'Admin\BlogController::delete/$1');

    $routes->get('docs', 'Admin\DocsController::index');
    $routes->get('docs/new', 'Admin\DocsController::new');
    $routes->post('docs', 'Admin\DocsController::create');
    $routes->get('docs/(:num)/edit', 'Admin\DocsController::edit/$1');
    $routes->post('docs/(:num)', 'Admin\DocsController::update/$1');
    $routes->post('docs/(:num)/delete', 'Admin\DocsController::delete/$1');

    $routes->get('waitlist', 'Admin\WaitlistController::index');
    $routes->post('waitlist/send', 'Admin\WaitlistController::send');

    $routes->get('settings', 'Admin\SettingsController::index');
    $routes->post('settings', 'Admin\SettingsController::save');
});
