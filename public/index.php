<?php

use Root\Autoloader;
use Root\routes\Router;
use Root\App\Exceptions\NotFoundException;

include("../Autoloader.php");
Autoloader::register();
//les constantes pour acceder au repertoire View
define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR);
//on demarre la session
session_start();
//on recupere l'instance de notre routeur
$routes = new Router($_GET['url']);

//les routes pour les pages statics
$routes->get('/', 'Root\App\Controllers\StaticController@home');
$routes->get('/packages', 'Root\App\Controllers\StaticController@packages');
$routes->get('/help', 'Root\App\Controllers\StaticController@help');
$routes->get('/services', 'Root\App\Controllers\StaticController@service');
$routes->get('/with-us', 'Root\App\Controllers\StaticController@with_us');

//les routes en get pour la page login et register
$routes->get('/login/:id', 'Root\App\Controllers\userController@login');
$routes->get('/register', 'Root\App\Controllers\userController@register');
//la routes en post pour la page login et register
$routes->post('/login', 'Root\App\Controllers\userController@signin');
$routes->post('/register', 'Root\App\Controllers\userController@add');

try {
    $routes->run();
} catch (NotFoundException $e) {
    return $e->error404();
}
