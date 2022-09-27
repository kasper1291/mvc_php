<?php

use Core\Route;
/**
 * Composer
 */
require dirname(__DIR__) . '/test_php_mvc/vendor/autoload.php';

ini_set('display_errors', 1);
/**
 * Routing
 */

$route = new Route();
$route->get('/', function(){
    echo 'Home';
});
$route->get('/auth', 'ControllerAuth@index');
$route->notFoundRoute(function (){
    echo '404';
});
$route->dispatch();