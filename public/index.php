<?php

use Root\Autoloader;
use Root\routes\Router;
use Root\App\Exceptions\NotFoundException;

include("../Autoloader.php");
Autoloader::register();
//les constantes pour acceder a la repertoire View
define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR);

$routes = new Router($_GET['url']);

//les routes pour les pages statics
$routes->get('/', 'Root\App\Controllers\StaticController@home');
$routes->get('/packages', 'Root\App\Controllers\StaticController@packages');
$routes->get('/help', 'Root\App\Controllers\StaticController@help');
$routes->get('/services', 'Root\App\Controllers\StaticController@service');
try {
    $routes->run();
} catch (NotFoundException $e) {
    return $e->error404();
}
