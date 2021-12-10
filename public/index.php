<?php

use Root\Autoloader;
use Root\routes\Router;
use Root\App\Exceptions\NotFoundException;
use Root\App\Models\UserModel;
use Root\Core\Validator;

include("../Autoloader.php");
Autoloader::register();
//les constantes pour acceder au repertoire View
define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR);
//le constante pour le dossier racine de notre application
define('RACINE', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR);

//on demarre la session
session_start();
//on recupere l'instance de notre routeur
$routes = new Router($_GET['url']);

//les routes pour les pages statics
$routes->get('/', 'Root\App\Controllers\StaticController@home');
//$routes->get('/packages-([0-9]+)/(add|update).php', "id,option", 'Root\App\Controllers\StaticController@packages');
$routes->get('/help', 'Root\App\Controllers\StaticController@help');
$routes->get('/services', 'Root\App\Controllers\StaticController@service');
$routes->get('/with-us', 'Root\App\Controllers\StaticController@with_us');

//les routes en get pour la page login et register

//la routes en post pour la page login et register
$routes->post('/login', 'Root\App\Controllers\UserController@signIn');
$routes->post('/register', 'Root\App\Controllers\UserController@create');
//reset password & confirm password 
$routes->get('/reset-password', 'Root\App\Controllers\UserController@pwd_reset');
$routes->get('/verify-email', 'Root\App\Controllers\UserController@verify_mail');

$routes->post('/pwd_reset', 'Root\App\Controllers\UserController@reset');
//les routes pour l'admin en get
$routes->get('/admin', 'Root\App\Controllers\adminController@index');
$routes->get('/admin/destroy', 'Root\App\Controllers\adminController@destroy');
//les routes pour l'admin en post
$routes->post('/admin/add', 'Root\App\Controllers\adminController@create');
$routes->post('/admin/signIn', 'Root\App\Controllers\adminController@signIn');
//route pour l'admin en get
$routes->get('/admin/dashboard', 'Root\App\Controllers\AdminController@index');

//route pour ajouter un packet
$routes->post('/admin/pack', 'Root\App\Controllers\adminController@addPack');
//route pour l'authentification de l'utilisateur en post
$routes->post('/login', 'Root\App\Controllers\UserController@signIn');
$routes->post('/register', 'Root\App\Controllers\UserController@create');

//route pour l'utilisateur en get
$routes->get('/login', 'Root\App\Controllers\UserController@login');
$routes->get('/register', 'Root\App\Controllers\UserController@register');


$routes->get('/test', function () {
});


try {
    $routes->run();
} catch (NotFoundException $e) {
    return $e->error404();
}
