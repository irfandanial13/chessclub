<?php

use CodeIgniter\Router\RouteCollection;

$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::loginPost');
$routes->get('register', 'AuthController::register');
$routes->post('register', 'AuthController::registerPost');
$routes->get('logout', 'AuthController::logout');
$routes->get('dashboard', 'DashboardController::index');
$routes->get('membership', 'MembershipController::index');
$routes->post('membership/upgrade', 'MembershipController::upgrade');
$routes->get('membership', 'Membership::index');
$routes->post('membership/upgrade', 'Membership::upgrade');
$routes->get('events', 'EventController::index');
$routes->get('events/join/(:num)', 'EventController::join/$1');
$routes->get('my-events', 'EventController::myEvents');
$routes->get('leaderboard', 'LeaderboardController::index');
$routes->get('/', 'Home::index');


$routes->get('admin/users', 'AdminController::manageUsers');
$routes->get('admin/users/edit/(:num)', 'AdminController::editUser/$1');
$routes->post('admin/users/update/(:num)', 'AdminController::updateUser/$1');
$routes->get('admin/users/delete/(:num)', 'AdminController::deleteUser/$1');
$routes->get('admin/dashboard', 'AdminController::dashboard');
$routes->get('admin/manage-users', 'AdminController::manageUsers');
$routes->get('admin/edit-user/(:num)', 'AdminController::editUser/$1');
$routes->post('admin/update-user/(:num)', 'AdminController::updateUser/$1');
$routes->get('admin/delete-user/(:num)', 'AdminController::deleteUser/$1');



/**
 * @var RouteCollection $routes
 */




