<?php
header('Content-Type: application/json');

define('DS', DIRECTORY_SEPARATOR, true);
define('BASE_PATH', __DIR__ . DS, TRUE);

require BASE_PATH.'vendor/autoload.php';

$app		    = System\App::instance();
$app->request  	= System\Request::instance();
$app->route	    = System\Route::instance($app->request);
$route		    = $app->route;

$route->post('/login', 'src\ChefGourmet\ChefGourmet@login');
$route->get('/getOrder/{date}/{orderId}?', 'src\ChefGourmet\ChefGourmet@getOrder');
$route->get('/getOrders/{from}/{to}', 'src\ChefGourmet\ChefGourmet@getOrders');
$route->get('/getOrdersList/{from}/{to}', 'src\ChefGourmet\ChefGourmet@getOrdersList');
$route->get('/setOrder/{foodId}/{dessertId}/{date}', 'src\ChefGourmet\ChefGourmet@setOrder');
$route->get('/cancelOrder/{OrderId}', 'src\ChefGourmet\ChefGourmet@setCancelOrder');

$route->end();