<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::index');
/* Home*/

/*Login*/
$routes->post('/auth/login', 'LoginController::Auth');
/*Dashboard*/
$routes->get('/dev/dashboard', 'DashboardController::index');
