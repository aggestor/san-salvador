<?php

use Root\Autoloader;
use Root\routes\Router;
use Root\App\Exceptions\NotFoundException;

include("../Autoloader.php");
Autoloader::register();
//les constantes pour acceder a la repertoire View
define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR);

$routes = new Router($_GET['url']);

$routes->get('/', 'Root\App\Controllers\StaticController@home');
$routes->get('/packages', 'Root\App\Controllers\StaticController@packages');

try {
    $routes->run();
} catch (NotFoundException $e) {
    return $e->error404();
}
