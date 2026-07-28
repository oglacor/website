<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */
$routes->get('/', 'Home::index');

$routes->get('product', 'Pages::product');
$routes->get('solutions', 'Pages::solutions');
$routes->get('pricing', 'Pages::pricing');
$routes->get('contact', 'Pages::contact');
$routes->get('login', 'Pages::login');
$routes->get('get-started', 'Pages::getStarted');
$routes->get('docs', 'Pages::docs');

$routes->get('blog', 'Blog::index');
$routes->get('blog/(:segment)', 'Blog::show/$1');

$routes->post('waitlist', 'Waitlist::store');

// -----------------------------------------------------------------
// Gated / admin routes — scaffolded for the next build phase.
// Auth filter + admin blog CRUD + docs CMS + Resend config land here.
// -----------------------------------------------------------------
// $routes->group('docs', ['filter' => 'auth'], static function ($routes) {
//     $routes->get('developer', 'Docs::developer');
// });
// $routes->group('admin', ['filter' => 'auth:admin'], static function ($routes) {
//     $routes->resource('blog', ['controller' => 'Admin\BlogController']);
//     $routes->get('waitlist', 'Admin\WaitlistController::index');
//     $routes->post('waitlist/settings', 'Admin\WaitlistController::saveSettings');
// });
