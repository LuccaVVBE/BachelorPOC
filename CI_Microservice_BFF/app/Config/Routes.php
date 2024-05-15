<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'UserBFF_Controller::login');
$routes->post('/', 'UserBFF_Controller::validate_login');
$routes->get('/dashboard', 'TelephoneBFF_Controller::index');
$routes->get('/usage', 'Call_LogBFF_Controller::index');
$routes->get('/logout', 'UserBFF_Controller::logout');
