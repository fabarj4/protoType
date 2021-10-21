<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');
$routes->get('/login', 'Login::index');
$routes->post('/login/process', 'Login::process');
$routes->post('/login/logout', 'Login::logout');
$routes->get('/beranda', 'Beranda::index');
$routes->get('/register', 'Register::index');
$routes->get('/register/process', 'Register::Process');
$routes->get('/register/sucess/', 'Register::Success');
$routes->get('/register/upload/', 'Register::Upload');

$routes->get('/panel/kanal/', 'Kanal::index');
$routes->get('/panel/kanal/card/(:any)', 'Kanal::card/$1');
$routes->post('/panel/kanal/save/(:any)', 'Kanal::save/$1');
$routes->get('/panel/kanal/delete/(:any)', 'Kanal::delete/$1');
$routes->get('/panel/kanal/view/(:any)', 'Kanal::view/$1');

$routes->get('/panel/setup/', 'Setup::index');
$routes->post('/panel/setup/save/(:any)', 'Setup::save/$1');

$routes->get('/panel/datakanal/', 'DataKanal::index');
$routes->get('/panel/datakanal/card/(:any)', 'DataKanal::card/$1');
$routes->post('/panel/datakanal/save/(:any)', 'DataKanal::save/$1');
$routes->get('/panel/datakanal/delete/(:any)', 'DataKanal::delete/$1');

$routes->get('/panel/staff/', 'Staff::index');
$routes->get('/panel/staff/card/(:any)', 'Staff::card/$1');
$routes->post('/panel/staff/save/(:any)', 'Staff::save/$1');
$routes->get('/panel/staff/delete/(:any)', 'Staff::delete/$1');

$routes->get('/panel/member/', 'Member::index');
$routes->get('/panel/member/card/(:any)', 'Member::card/$1');
$routes->post('/panel/member/save/(:any)', 'Member::save/$1');
$routes->get('/panel/member/delete/(:any)', 'Member::delete/$1');
$routes->get('/panel/member/exp_add/(:any)', 'Member::exp_add/$1');

$routes->get('/panel/registerwizard/', 'Registerwizard::index');
$routes->get('/panel/registerwizard/card/(:any)', 'Registerwizard::card/$1');
$routes->post('/panel/registerwizard/save/(:any)', 'Registerwizard::save/$1');
$routes->get('/panel/registerwizard/delete/(:any)', 'Registerwizard::delete/$1');
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
