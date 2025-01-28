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
$routes->post('/monitoring-save', 'MonitoringController::saveMonitoring');
$routes->get('/dev/monitoring-tambah', 'MonitoringController::tambahMonitoring');
$routes->get('monitoring/planFinish/(:num)', 'MonitoringController::getPlanFinish/$1');
$routes->get('monitoring/getProjects/(:num)', 'MonitoringController::getProjects/$1');
$routes->get('monitoring/getPlanFinish/(:num)', 'MonitoringController::getPlanFinish/$1');

/*Model*/
$routes->get('/dev/model', 'ModelController::model');
$routes->get('/dev/model-tambah', 'ModelController::tambahModel');
$routes->post('/model-save', 'ModelController::save');
$routes->get('/dev/model-edit', 'ModelController::editModel');

/*Customer*/
$routes->get('/dev/costumer', 'CustomerController::customer');
$routes->get('/dev/costumer-tambah', 'CustomerController::tambahCustomer');
$routes->post('/Customer-save', 'CustomerController::save');
$routes->get('/dev/costumer-edit/(:num)', 'CustomerController::editCustomer/$1');
$routes->post('/dev/updateCustomer/(:num)', 'CustomerController::updateCustomer/$1');
$routes->get('/dev/deleteCustomer/(:num)', 'CustomerController::deleteCustomer/$1');


/* manajemen pic */
$routes->get('/dev/manajemenPIC', 'LoginController::pic');
$routes->get('/dev/tambahPIC', 'LoginController::tambahPIC');
//$routes->get('/dev/editPIC', 'LoginController::editPIC');
$routes->post('/PIC-save', 'LoginController::savePic');
$routes->post('dev/updatePIC/(:num)', 'LoginController::updatePIC/$1');
$routes->get('dev/editPIC/(:num)', 'LoginController::editPIC/$1');



/*Monitoring*/
$routes->get('monitoring/projects/(:num)', '\App\Controllers\MonitoringController::getProjects/$1');
$routes->get('monitoring/details/(:num)', '\App\Controllers\MonitoringController::getDetails/$1');
$routes->get('monitoring/tasks/(:num)', '\App\Controllers\MonitoringController::getTasks/$1');


/*Khusus Role PIC*/
$routes->get('/PIC/ReDrawing', 'DashboardController::ReDrawing');

$routes->get('/PIC/ApprovalRedraw', 'DashboardController::ApprovalReDraw');
$routes->get('/PIC/ApprovalRedraw/index', 'DashboardController::indexApprovalReDraw');
$routes->get('/PIC/ApprovalRedraw-edit', 'DashboardController::editApprovalReDraw');


