<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->group('api', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('users/login', 'Users::login');
    $routes->post('users/validate_login', 'Users::validate_login');
    $routes->get('users/logout', 'Users::logout');
});
