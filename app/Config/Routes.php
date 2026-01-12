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
$routes->setDefaultController('myController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('myController');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

$routes->get('signup', 'myController::signup');
$routes->post('save_signup', 'myController::save_signup');
$routes->get('login', 'myController::login');
$routes->post('/save_login','myController::save_login');
$routes->get('/admin_dashboard','myController::admin_dashboard');
$routes->get('/home','myController::home');
$routes->get('/logout','myController::logout');

$routes->get('/add_category','myController::add_category');
$routes->get('/add_item','myController::add_item');
$routes->post('/save_category','myController::save_category');
$routes->post('/get_categories','myController::get_categories');
$routes->post('/save_item','myController::save_item');
$routes->get('/items_list','myController::items_list');
$routes->post('/save_edit_category','myController::save_edit_category');
$routes->post('/delete_category','myController::delete_category');
// $routes->get('get_item_by_category/(:num)', 'MyController::get_item_by_category/$1');
$routes->get('edit_itemlist/(:num)','myController::edit_itemlist/$1');
$routes->post('save_edit_itemlist','myController::save_edit_itemlist');
$routes->post('delete_item','myController::delete_item');
$routes->get('items_by_category/(:num)','myController::items_by_category/$1');
$routes->get('cart','myController::cart');
$routes->post('add_to_cart','myController::add_to_cart');
$routes->post('cart_remove','myController::cart_remove');
$routes->post('cart_plus','myController::cart_plus');
$routes->post('cart_minus','myController::cart_minus');
$routes->post('buy_now','myController::buy_now');
$routes->get('my_orders','myController::my_orders');
$routes->get('order_details/(:num)','myController::order_details/$1');
$routes->get('orders_list','myController::orders_list');
$routes->post('cancel_order', 'myController::cancel_order');
$routes->get('report_section','myController::report_section');
$routes->get('itemwise_report','myController::itemwise_report');
$routes->get('userwise_report','myController::userwise_report');
$routes->get('report_pdf', 'myController::report_pdf');
$routes->get('report_pdf1', 'myController::report_pdf1');

$routes->get('itemwise_table','myController::report_pdf');


/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'myController::login');


 /* --------------------------------------------------------------------
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
