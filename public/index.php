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

//les routes pour l'admin en get
$routes->get('/admin/destroy', 'Root\App\Controllers\AdminController@destroy');
//les routes pour l'admin en post
$routes->post('/admin/register', 'Root\App\Controllers\AdminController@create');
$routes->post('/admin/login', 'Root\App\Controllers\AdminController@login');
$routes->get('/admin/register', 'Root\App\Controllers\AdminController@create');
$routes->get('/admin/login', 'Root\App\Controllers\AdminController@login');
//route pour l'admin en get
$routes->get('/admin/dashboard', 'Root\App\Controllers\AdminController@index');
// $routes->get('/admin/administrator/dashboard', 'Root\App\Controllers\AdminController@administratorDashboard');

//route pour ajouter un packet
$routes->post('/admin/pack', 'Root\App\Controllers\PackController@addPack');
$routes->get('/admin/pack', 'Root\App\Controllers\PackController@addPack');
//route d'activation de l'inscrption
$routes->get('/admin/active/inscription', 'Root\App\Controllers\AdminController@viewAllNonActiveInscription');
$routes->post('/admin/active/inscription-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{11})', 'Root\App\Controllers\AdminController@activeInscriptions', 'inscription;user');
//route pour l'authentification de l'utilisateur en post
$routes->get('/admin/activation-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{60})', 'Root\App\Controllers\AdminController@accountActivation', 'id;token');
$routes->post('/admin/activation-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{60})', 'Root\App\Controllers\AdminController@accountActivation', 'id;token');
//les routes en get vers l'admin pour afficher les users, les admin et les pacl
$routes->get('/admin/viewpacks', 'Root\App\Controllers\AdminController@allPacks');
$routes->get('/admin/viewusers-page-([0-9]+)', 'Root\App\Controllers\AdminController@allUsers', 'page');
$routes->get('/admin/administrator', 'Root\App\Controllers\AdminController@administratorDashboard');

//route pour afficher les pack
$routes->get('/packages', 'Root\App\Controllers\PackController@packages');
//route pour souscrire a une pack
$routes->get('/user/pack/subscribe', 'Root\App\Controllers\PackController@sucribeOnPack');
$routes->post('/user/pack/subscribe', 'Root\App\Controllers\PackController@sucribeOnPack');
//routes pour upgrade packages
$routes->get('/user/pack/upgrade', 'Root\App\Controllers\PackController@upgradePackages');
$routes->post('/user/pack/upgrade', 'Root\App\Controllers\PackController@upgradePackages');


// les routes pour l'activation du pack
// $routes->get('/user/pack/activation-([a-zA-Z0-9]{11})', 'Root\App\Controllers\PackController@activationPackages', 'inscription');
// $routes->post('/user/pack/activation-([a-zA-Z0-9]{11})', 'Root\App\Controllers\PackController@activationPackages', 'inscription');

//les routes pour les utilisateurs
$routes->post('/register', 'Root\App\Controllers\UserController@create');
$routes->get('/register', 'Root\App\Controllers\UserController@create');
$routes->post('/register-(1|2)-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{11})/', 'Root\App\Controllers\UserController@create', 'side;parent;sponsor');
$routes->get('/register-(1|2)-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{11})/', 'Root\App\Controllers\UserController@create', 'side;parent;sponsor');
$routes->get('/reset-password', 'Root\App\Controllers\UserController@resetPasswordOnMail');
$routes->post('/reset-password', 'Root\App\Controllers\UserController@resetPasswordOnMail');
$routes->post('/login', 'Root\App\Controllers\UserController@login');
$routes->get('/login', 'Root\App\Controllers\UserController@login');
$routes->get('/user/dashboard', 'Root\App\Controllers\UserController@dashboard');
$routes->get('/user/logout', 'Root\App\Controllers\UserController@logout');
$routes->get('/user/me', 'Root\App\Controllers\UserController@profil');
$routes->get('/user/tree', 'Root\App\Controllers\UserController@tree');

//route lors du renvoie du mail s'il ya echec
$routes->get('/user/mail/error', 'Root\App\Controllers\UserController@mailSendError');
//route lors du renvoie du mail
$routes->get('/user/mail/resend', 'Root\App\Controllers\UserController@mailResend');
$routes->post('/user/mail/resend-(reset|activation)', 'Root\App\Controllers\UserController@mailResend', 'action');


/*
    les routes de succes pour 
    1. l'envoie du mail
    2. la reinitialisation du mot de passe avec success
    3. l'incription terminer avec succes 
    4. view pour le lien de parainage
 */
$routes->get('/user/mail/success', 'Root\App\Controllers\UserController@mailSendSuccess');
$routes->get('/user/password', 'Root\App\Controllers\UserController@passwordSuccess');
$routes->get('/user/account', 'Root\App\Controllers\UserController@registerSuccess');
$routes->get('/user/share/link', 'Root\App\Controllers\UserController@shareLink');


//route d'activation du compte utilisateur
$routes->get('/activation-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{60})', 'Root\App\Controllers\UserController@accountActivation', 'id;token');
//route pour l'activation du compte admin
//routes pour l'a reinitialisation du mot de passe'
$routes->get('/reset-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{60})', 'Root\App\Controllers\UserController@resetPassword', 'id;token');
$routes->post('/reset-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{60})', 'Root\App\Controllers\UserController@resetPassword', 'id;token');

/**
 * ROUTES pour test Aggestor
 */
$routes->get('/admin/administrator/dashboard', 'Root\App\Controllers\TestController@admins');



$routes->get('/test', function () {
    //var_dump($_SESSION['users']);
    unset($_SESSION['users']);
});


try {
    $routes->run();
} catch (NotFoundException $e) {
    $message = $e->getMessage();
    return $e->error404($message);
}
