<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Disable auto-routing for security
$routes->setAutoRoute(false);

// Home page
$routes->get('/', 'Home::index');

// Authentication routes (clean URLs)
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::loginPost');
$routes->get('register', 'Auth::register');
$routes->post('register', 'Auth::registerPost');
$routes->get('logout', 'Auth::logout');

// Dashboard routes
$routes->get('dashboard', 'Dashboard::index');
$routes->get('member/dashboard', 'Member::dashboard');

// Admin routes (clean URLs)
$routes->group('admin', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Admin::dashboard');
    $routes->get('dashboard', 'Admin::dashboard');
    
    // User management
    $routes->get('users', 'Admin::manageUsers');
    $routes->get('users/create', 'Admin::createUser');
    $routes->post('users/store', 'Admin::storeUser');
    $routes->get('users/edit/(:num)', 'Admin::editUser/$1');
    $routes->post('users/update/(:num)', 'Admin::updateUser/$1');
    $routes->get('users/delete/(:num)', 'Admin::deleteUser/$1');
    
    // Event management
    $routes->get('events', 'Admin::manageEvents');
    $routes->get('events/create', 'Admin::createEvent');
    $routes->post('events/store', 'Admin::storeEvent');
    $routes->get('events/edit/(:num)', 'Admin::editEvent/$1');
    $routes->post('events/update/(:num)', 'Admin::updateEvent/$1');
    $routes->get('events/delete/(:num)', 'Admin::deleteEvent/$1');
    
    // Merchandise management
    $routes->get('merchandise', 'Admin::manageMerchandise');
    $routes->get('merchandise/create', 'Admin::createMerchandise');
    $routes->post('merchandise/store', 'Admin::storeMerchandise');
    $routes->get('merchandise/edit/(:num)', 'Admin::editMerchandise/$1');
    $routes->post('merchandise/update/(:num)', 'Admin::updateMerchandise/$1');
    $routes->get('merchandise/delete/(:num)', 'Admin::deleteMerchandise/$1');
    
    // Leaderboard management
    $routes->get('leaderboard', 'Admin::manageLeaderboard');
    $routes->post('leaderboard/update/(:num)', 'Admin::updateUserPoints/$1');
    $routes->post('leaderboard/bulk-update', 'Admin::bulkUpdatePoints');
    $routes->get('leaderboard/reset', 'Admin::resetLeaderboard');
    $routes->get('leaderboard/export', 'Admin::exportLeaderboard');
    $routes->get('leaderboard/analytics', 'Admin::leaderboardAnalytics');
    
    // Order management
    $routes->get('orders', 'Admin::manageOrders');
    $routes->get('orders/view/(:num)', 'Admin::viewOrder/$1');
    $routes->post('orders/update-status/(:num)', 'Admin::updateOrderStatus/$1');
    $routes->get('orders/delete/(:num)', 'Admin::deleteOrder/$1');
    
    // Payment management
    $routes->get('payments', 'Admin::managePayments');
    $routes->get('payments/approve/(:num)', 'Admin::approvePayment/$1');
    $routes->get('payments/reject/(:num)', 'Admin::rejectPayment/$1');
});

// Public routes (clean URLs)
$routes->get('events', 'Events::index');
$routes->get('events/my-events', 'Events::myEvents');
$routes->get('events/join/(:num)', 'Events::joinEvent/$1');
$routes->get('events/confirm-join/(:num)', 'Events::confirmJoin/$1');

$routes->get('merchandise', 'Merchandise::index');
$routes->get('merchandise/cart', 'Merchandise::cart');
$routes->get('merchandise/checkout', 'Merchandise::checkout');
$routes->get('merchandise/bank-payment', 'Merchandise::bankPayment');
$routes->get('merchandise/card-payment', 'Merchandise::cardPayment');

$routes->get('leaderboard', 'Leaderboard::index');

$routes->get('contact', 'Contact::index');
$routes->post('contact/send', 'Contact::send');

$routes->get('about', 'Pages::about');
$routes->get('policy', 'Pages::policy');

// Membership routes
$routes->get('membership', 'Membership::index');
$routes->get('membership/payment-upload', 'Membership::paymentUpload');
$routes->post('membership/upload-payment', 'Membership::uploadPayment');

// Error pages
$routes->get('errors/404', 'Errors::error404');
$routes->get('errors/403', 'Errors::error403');
$routes->get('errors/500', 'Errors::error500');

// API routes (if needed)
$routes->group('api', ['namespace' => 'App\Controllers\Api'], function($routes) {
    $routes->get('events', 'Events::list');
    $routes->get('leaderboard', 'Leaderboard::list');
    $routes->get('merchandise', 'Merchandise::list');
});

// Catch-all route for 404
$routes->set404Override('App\Controllers\Errors::error404');

// Prevent access to sensitive files
$routes->addRedirect('app/(:any)', 'errors/403');
$routes->addRedirect('system/(:any)', 'errors/403');
$routes->addRedirect('writable/(:any)', 'errors/403');
$routes->addRedirect('vendor/(:any)', 'errors/403');
$routes->addRedirect('tests/(:any)', 'errors/403');
$routes->addRedirect('.env', 'errors/403');
$routes->addRedirect('composer.json', 'errors/403');
$routes->addRedirect('composer.lock', 'errors/403');

