<?php

use Root\Autoloader;
use Root\routes\Router;
use Root\App\Exceptions\NotFoundException;

include("../Autoloader.php");
Autoloader::register();
//les constantes pour acceder au repertoire View
define('VIEWS', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Views' . DIRECTORY_SEPARATOR);
//le constante pour le dossier racine de notre application
define('RACINE', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'assets' . DIRECTORY_SEPARATOR . 'img' . DIRECTORY_SEPARATOR);

//on demarre la session
session_start();
//on recupere l'instance de notre routeur
$routes = new Router($_SERVER['REQUEST_URI']);

//les routes pour les pages statics
$routes->get('/', 'Root\App\Controllers\StaticController@home');
//$routes->get('/packages-([0-9]+)/(add|update).php', "id,option", 'Root\App\Controllers\StaticController@packages');
$routes->get('/help', 'Root\App\Controllers\StaticController@help');
$routes->get('/services', 'Root\App\Controllers\StaticController@service');
$routes->get('/with-us', 'Root\App\Controllers\StaticController@with_us');
$routes->get('/contact', 'Root\App\Controllers\StaticController@contact');
$routes->get('/security', 'Root\App\Controllers\StaticController@security');
$routes->get('/politics', 'Root\App\Controllers\StaticController@politics');
$routes->get('/terms', 'Root\App\Controllers\StaticController@terms');
$routes->get('/packages', 'Root\App\Controllers\StaticController@packages');

//les routes en get pour la page login et register

//la routes en post pour la page login et register
//reset password & confirm password 
$routes->get('/reset-password', 'Root\App\Controllers\UserController@pwd_reset');
$routes->post('/reset-password', 'Root\App\Controllers\UserController@pwd_reset');

//les routes pour l'admin en get
$routes->get('/admin', 'Root\App\Controllers\AdminController@index');
$routes->get('/admin/destroy', 'Root\App\Controllers\AdminController@destroy');
//les routes pour l'admin en post
$routes->post('/admin/register', 'Root\App\Controllers\AdminController@create');
$routes->post('/admin/login', 'Root\App\Controllers\AdminController@login');
$routes->get('/admin/register', 'Root\App\Controllers\AdminController@create');
$routes->get('/admin/login', 'Root\App\Controllers\AdminController@login');
$routes->get('/admin/login', 'Root\App\Controllers\AdminController@login');
$routes->get('/admin/add_test', 'Root\App\Controllers\TestController@add_admin_test');
//route pour l'admin en get
$routes->get('/admin/dashboard', 'Root\App\Controllers\AdminController@index');

//route pour ajouter un packet
$routes->post('/admin/pack', 'Root\App\Controllers\AdminController@addPack');
//route pour l'authentification de l'utilisateur en post

$routes->post('/register', 'Root\App\Controllers\UserController@create');
$routes->get('/register', 'Root\App\Controllers\UserController@create');
$routes->post('/register-(1|2)-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{11})/', 'Root\App\Controllers\UserController@create', 'side;parent;sponsor');
$routes->get('/register-(1|2)-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{11})/', 'Root\App\Controllers\UserController@create', 'side;parent;sponsor');

$routes->post('/login', 'Root\App\Controllers\UserController@login');
$routes->get('/login', 'Root\App\Controllers\UserController@login');

$routes->get('/user/dashboard', 'Root\App\Controllers\UserController@dashboard');

$routes->get('/reset_pwd/first-step', 'Root\App\Controllers\TestController@reset_pwd');
$routes->get('/reset_pwd/last-step', 'Root\App\Controllers\TestController@create_new_pwd');

//route d'activation du compte utilisateur
$routes->get('/activation-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{60})', 'Root\App\Controllers\UserController@accountActivation', 'id;token');
//route pour l'activation du compte admin
$routes->get('/admin/activation-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{60})', 'Root\App\Controllers\UserController@accountActivation', 'id;token');
//routes pour l'a reinitialisation du mot de passe'
$routes->get('/reset-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{60})', 'Root\App\Controllers\UserController@resetPassword', 'id;token');
$routes->post('/reset-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{60})', 'Root\App\Controllers\UserController@resetPassword', 'id;token');

//


$routes->get('/test', function () {
    var_dump($_SESSION);
});


try {
    $routes->run();
} catch (NotFoundException $e) {
    return $e->error404();
}
