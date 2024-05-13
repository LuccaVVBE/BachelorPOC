<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('api', ['namespace' => 'App\Controllers'], function ($routes) {
    $routes->get('call-logs/(:num)', 'CallLogs::index/$1');
});