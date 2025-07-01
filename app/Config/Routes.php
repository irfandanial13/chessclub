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

// Admin Routes
$routes->get('admin/dashboard', 'AdminController::dashboard');
$routes->get('admin/users', 'AdminController::manageUsers');
$routes->get('admin/users/edit/(:num)', 'AdminController::editUser/$1');
$routes->post('admin/users/update/(:num)', 'AdminController::updateUser/$1');
$routes->get('admin/users/delete/(:num)', 'AdminController::deleteUser/$1');




