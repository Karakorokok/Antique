<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setAutoRoute(false);

/** user */
$routes->match(['get', 'post'], '/barbaza-menro/home', 'UserController::userHome');
$routes->match(['get', 'post'], '/barbaza-menro/login', 'UserController::userLogin');
$routes->match(['get', 'post'], '/barbaza-menro/signup', 'UserController::userSignup');