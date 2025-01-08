<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::index');
/* Home*/

/*Login*/
$routes->get('/login', 'LoginController::index');
/*Dashboard*/
$routes->get('/dev/dashboard', 'DashboardController::index');
$routes->get('/dev/monitoring', 'DevController::index');
$routes->get('/dev/model', 'DevController::model');
$routes->get('/dev/model-tambah', 'DevController::tambahModel');
$routes->get('/dev/costumer', 'DevController::costumer');
$routes->get('/dev/costumer-tambah', 'DevController::tambahCostumer');
