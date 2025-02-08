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
$routes->get('dev/monitoring/getModelsByCustomer/(:num)', 'DashboardController::getModelsByCustomer/$1');
$routes->get('dev/monitoring/getLeadTimeComparison/(:num)/(:num)', 'DashboardController::getLeadTimeComparison/$1/$2');



/*Monitoring*/
$routes->get('/dev/monitoring', 'MonitoringController::index');

$routes->get('/dev/monitoring-view', 'MonitoringController::view');  //routes baru view project
$routes->get('/dev/monitoring-editView', 'MonitoringController::editView');  //routes baru view project

$routes->post('/monitoring-save', 'MonitoringController::saveMonitoring');
$routes->get('/dev/monitoring-tambah', 'MonitoringController::tambahMonitoring');
$routes->get('monitoring/planFinish/(:num)', 'MonitoringController::getPlanFinish/$1');
$routes->get('monitoring/getProjects/(:num)', 'MonitoringController::getProjects/$1');
$routes->get('monitoring/getPlanFinish/(:num)', 'MonitoringController::getPlanFinish/$1');

/*Model*/
$routes->get('/dev/model', 'ModelController::model');
$routes->get('/dev/model-tambah', 'ModelController::tambahModel');
$routes->post('/model-save', 'ModelController::save');
$routes->get('/dev/model-edit/(:num)', 'ModelController::editModel/$1');
$routes->post('/dev/model-update/(:num)', 'ModelController::updateModel/$1');
$routes->get('/Model/delete/(:num)', 'ModelController::delete/$1');

/*Customer*/
$routes->get('/dev/costumer', 'CustomerController::customer');
$routes->get('/dev/costumer-tambah', 'CustomerController::tambahCustomer');
$routes->post('/Customer-save', 'CustomerController::save');
$routes->get('/dev/costumer-edit/(:num)', 'CustomerController::editCustomer/$1');
$routes->post('/dev/updateCustomer/(:num)', 'CustomerController::updateCustomer/$1');
$routes->get('/Customer/delete/(:num)', 'CustomerController::delete/$1');


/* manajemen pic */
$routes->get('/dev/manajemenPIC', 'LoginController::pic');
$routes->get('/dev/tambahPIC', 'LoginController::tambahPIC');
//$routes->get('/dev/editPIC', 'LoginController::editPIC');
$routes->post('/PIC-save', 'LoginController::savePic');
$routes->post('dev/updatePIC/(:num)', 'LoginController::updatePIC/$1');
$routes->get('dev/editPIC/(:num)', 'LoginController::editPIC/$1');
$routes->get('/account/delete/(:num)', 'LoginController::delete/$1');



/*Monitoring*/
$routes->get('monitoring/projects/(:num)', '\App\Controllers\MonitoringController::getProjects/$1');
$routes->get('monitoring/details/(:num)', '\App\Controllers\MonitoringController::getDetails/$1');
$routes->get('monitoring/tasks/(:num)', '\App\Controllers\MonitoringController::getTasks/$1');


/*Khusus Role PIC*/
//$routes->get('/PIC/ReDrawing', 'DashboardController::ReDrawing');

$routes->get('/PIC', 'DashboardController::dashboardPIC');
$routes->get('/PIC/edit-task/(:num)', 'DashboardController::editTask/$1'); // Route untuk edit task
$routes->post('/PIC/update-task/(:num)', 'DashboardController::update/$1'); // Route untuk update task
$routes->get('/PIC/TASK', 'DashboardController::Task');
// $routes->get('/PIC/ApprovalRedraw-edit', 'DashboardController::editApprovalReDraw');


