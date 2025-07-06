<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Auth Routes
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::loginPost');
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::registerPost');
$routes->get('logout', 'AuthController::logout');

// Main Routes
$routes->get('/', 'Home::index');
$routes->get('dashboard', 'DashboardController::index');
$routes->get('membership', 'MembershipController::index');
$routes->post('membership/upgrade', 'MembershipController::upgrade');
$routes->get('events', 'EventController::index');
$routes->get('events/join/(:num)', 'EventController::join/$1');
$routes->get('events/confirm-join/(:num)', 'EventController::confirmJoin/$1');
$routes->get('my-events', 'EventController::myEvents');
$routes->get('leaderboard', 'LeaderboardController::index');
$routes->get('book', 'EventController::book');
$routes->get('events/register/(:num)', 'EventController::register/$1');
$routes->post('events/register/(:num)', 'EventController::registerPost/$1');
$routes->get('merchandise', 'MerchandiseController::index');
$routes->post('merchandise/addToCart/(:num)', 'MerchandiseController::addToCart/$1');
$routes->get('merchandise/cart', 'MerchandiseController::cart');
$routes->post('merchandise/removeFromCart/(:num)', 'MerchandiseController::removeFromCart/$1');
$routes->post('merchandise/checkout', 'MerchandiseController::checkout');
$routes->post('merchandise/process-payment', 'MerchandiseController::processPayment');
$routes->get('merchandise/cash-payment', 'MerchandiseController::cashPayment');
$routes->get('merchandise/bank-payment', 'MerchandiseController::bankPayment');
$routes->get('merchandise/card-payment', 'MerchandiseController::cardPayment');
$routes->post('merchandise/complete-order', 'MerchandiseController::completeOrder');
$routes->get('merchandise/thank-you/(:num)', 'MerchandiseController::thankYou/$1');

// Contact Routes
$routes->get('contact', 'ContactController::index');
$routes->post('contact/send', 'ContactController::sendMessage');

// Admin Routes
$routes->get('admin/dashboard', 'AdminController::dashboard');
$routes->get('admin/users', 'AdminController::manageUsers');
$routes->get('admin/users/edit/(:num)', 'AdminController::editUser/$1');
$routes->post('admin/users/update/(:num)', 'AdminController::updateUser/$1');
$routes->get('admin/users/delete/(:num)', 'AdminController::deleteUser/$1');
$routes->get('admin/users/create', 'AdminController::createUser');
$routes->post('admin/users/store', 'AdminController::storeUser');
$routes->get('admin/event', 'AdminController::manageEvents');
$routes->get('admin/events/create', 'AdminController::createEvent');
$routes->post('admin/events/store', 'AdminController::storeEvent');
$routes->get('admin/events/edit/(:num)', 'AdminController::editEvent/$1');
$routes->post('admin/events/update/(:num)', 'AdminController::updateEvent/$1');
$routes->get('admin/events/delete/(:num)', 'AdminController::deleteEvent/$1');

// Order Management Routes
$routes->get('admin/orders', 'AdminController::manageOrders');
$routes->get('admin/orders/delete/(:num)', 'AdminController::deleteOrder/$1');
$routes->get('admin/orders/view/(:num)', 'AdminController::viewOrder/$1');

// Leaderboard Management Routes
$routes->get('admin/leaderboard', 'AdminController::manageLeaderboard');
$routes->post('admin/leaderboard/update-points/(:num)', 'AdminController::updateUserPoints/$1');
$routes->post('admin/leaderboard/bulk-update-points', 'AdminController::bulkUpdatePoints');
$routes->get('admin/leaderboard/reset', 'AdminController::resetLeaderboard');
$routes->get('admin/leaderboard/export', 'AdminController::exportLeaderboard');
$routes->get('admin/leaderboard/analytics', 'AdminController::leaderboardAnalytics');

$routes->get('leaderboard/profileModal/(:num)', 'LeaderboardController::profileModal/$1');
$routes->get('leaderboard/ajaxLeaderboard', 'LeaderboardController::ajaxLeaderboard');

// Merchandise Routes
$routes->get('admin/merchandise', 'AdminController::manageMerchandise');
$routes->get('admin/merchandise/create', 'AdminController::createMerchandise');
$routes->post('admin/merchandise/store', 'AdminController::storeMerchandise');
$routes->get('admin/merchandise/edit/(:num)', 'AdminController::editMerchandise/$1');
$routes->post('admin/merchandise/update/(:num)', 'AdminController::updateMerchandise/$1');
$routes->get('admin/merchandise/delete/(:num)', 'AdminController::deleteMerchandise/$1');
$routes->get('admin/merchandise/toggle-availability/(:num)', 'AdminController::toggleMerchandiseAvailability/$1');
$routes->post('admin/merchandise/update-stock/(:num)', 'AdminController::updateMerchandiseStock/$1');

