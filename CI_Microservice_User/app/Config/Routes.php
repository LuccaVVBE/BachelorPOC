<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('api', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->post('user/login', 'User::login');
    $routes->post('user/validate_login', 'User::validate_login');
    $routes->post('user/logout', 'User::logout');
});
