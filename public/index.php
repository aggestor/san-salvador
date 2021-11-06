<?php

use Root\Autoloader;
use Root\routes\Router;
use Root\App\Exceptions\NotFoundException;

include("../Autoloader.php");
Autoloader::register();
//les constantes

define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR);

$routes = new Router($_GET['url']);

$routes->get('/', 'Root\App\Controllers\HomeController@index');
$routes->get('/packages', 'Root\App\Controllers\HomeController@packages');

try {
    $routes->run();
} catch (NotFoundException $e) {
    return $e->error404();
}
