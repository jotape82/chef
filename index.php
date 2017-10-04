<?php
header('Content-Type: application/json');

define('DS', DIRECTORY_SEPARATOR, true);
define('BASE_PATH', __DIR__ . DS, TRUE);

require BASE_PATH.'vendor/autoload.php';


$app		    = System\App::instance();
$app->request  	= System\Request::instance();
$app->route	    = System\Route::instance($app->request);
$route		    = $app->route;

$route->get('/', function () {
	phpinfo();
});
$route->post('/login', 'src\chefgourmet\Chefgourmet@login');
$route->get('/getOrder/{date}/{orderId}?', 'src\chefgourmet\Chefgourmet@getOrder');
$route->get('/getOrders/{from}/{to}', 'src\chefgourmet\Chefgourmet@getOrders');
$route->get('/getOrdersList/{from}/{to}', 'src\chefgourmet\Chefgourmet@getOrdersList');
$route->get('/setOrder/{foodId}/{dessertId}/{date}', 'src\chefgourmet\Chefgourmet@setOrder');
$route->get('/cancelOrder/{OrderId}', 'src\chefgourmet\Chefgourmet@setCancelOrder');

$route->end();