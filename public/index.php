<?php

use Root\Autoloader;
use Root\routes\Router;

include("../Autoloader.php");
Autoloader::register();
//les constantes

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR);

$routes = new Router($_GET['url']);

$routes->get('/', 'Root\App\Controllers\HomeController@index');
$routes->get('/packages', 'Root\App\Controllers\HomeController@packages');

$routes->run();
