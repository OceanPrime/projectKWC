<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::index');
/* Home*/

/*Dashboard*/
$routes->get('/dev/dashboard', 'DashboardController::index');
