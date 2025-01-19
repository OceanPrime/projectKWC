<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LoginController::index');
/* Home*/

/*Login*/
$routes->post('/auth/login', 'LoginController::Auth');
$routes->get('/logout', 'LoginController::logout');

/*Dashboard Admin*/
$routes->get('/dev/dashboard', 'DashboardController::index');

/*Monitoring*/
$routes->get('/dev/monitoring', 'MonitoringController::index');

/*Model*/
$routes->get('/dev/model', 'ModelController::model');
$routes->get('/dev/model-tambah', 'ModelController::tambahModel');
$routes->post('/model-save', 'ModelController::save');

/*Customer*/
$routes->get('/dev/costumer', 'CustomerController::customer');
$routes->get('/dev/costumer-tambah', 'CustomerController::tambahCustomer');
$routes->post('/Customer-save', 'CustomerController::save');

/* manajemen pic */
$routes->get('/dev/manajemenPIC', 'devController::index');
$routes->get('/dev/tambahPIC', 'devController::tambahPIC');
$routes->get('/dev/editPIC', 'devController::editPIC');

/*Monitoring*/
$routes->get('monitoring/projects/(:num)', '\App\Controllers\MonitoringController::getProjects/$1');
$routes->get('monitoring/details/(:num)', '\App\Controllers\MonitoringController::getDetails/$1');
$routes->get('monitoring/tasks/(:num)', '\App\Controllers\MonitoringController::getTasks/$1');


/*Khusus PIC*/
$routes->get('/PIC/dashboard', 'DashboardController::pic');

