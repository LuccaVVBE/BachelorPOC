<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User::login');
$routes->post('/', 'User::validate_login');
$routes->get('/dashboard', 'Telephone::index');
$routes->get('/usage', 'Call_Log::index');
$routes->get('/logout', 'User::logout');
