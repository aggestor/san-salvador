<?php

use Root\App\Controllers\Controller;
use Root\Core\EnabledCashOut;


use Root\Autoloader;
use Root\routes\Router;
use Root\App\Exceptions\NotFoundException;
use Root\App\Models\ModelFactory;
use Root\App\Models\ReturnInvestCronJob;

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

$routes->get('/', 'Root\App\Controllers\StaticController@home');
//les routes pour les pages statics
//$routes->get('/packages-([0-9]+)/(add|update).php', "id,option", 'Root\App\Controllers\StaticController@packages');
$routes->get('/help', 'Root\App\Controllers\StaticController@help');
$routes->get('/services', 'Root\App\Controllers\StaticController@service');
$routes->get('/with-us', 'Root\App\Controllers\StaticController@with_us');
$routes->get('/security', 'Root\App\Controllers\StaticController@security');
$routes->get('/politics', 'Root\App\Controllers\StaticController@politics');
$routes->get('/terms', 'Root\App\Controllers\StaticController@terms');
$routes->get('/contracts', 'Root\App\Controllers\StaticController@contracts');

//les routes pour l'admin en get
$routes->get('/admin/destroy', 'Root\App\Controllers\AdminController@destroy');
//les routes pour l'admin en post
//$routes->post('/admin/register', 'Root\App\Controllers\AdminController@create');
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
$routes->get('/admin/active/inscription-([0-9]+)', 'Root\App\Controllers\AdminController@viewAllNonActiveInscription', 'page');
$routes->post('/admin/active/inscription-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{11})', 'Root\App\Controllers\AdminController@activeInscriptions', 'inscription;user');
$routes->post('/admin/canceled/inscription-([a-zA-Z0-9]{11})', 'Root\App\Controllers\AdminController@canceledInscription', 'inscription');
//route pour l'authentification de l'utilisateur en post
$routes->get('/admin/activation-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{60})', 'Root\App\Controllers\AdminController@accountActivation', 'id;token');
$routes->post('/admin/activation-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{60})', 'Root\App\Controllers\AdminController@accountActivation', 'id;token');
//les routes pour valider une demande de retrait
$routes->get('/admin/validate/cashout-([0-9]+)', 'Root\App\Controllers\AdminController@viewAllNonValideCashOut', 'page');
$routes->post('/admin/validate/cashout-([0-9]+)-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{11})', 'Root\App\Controllers\AdminController@validationCashOut', 'page;cashout;user');
$routes->post('/admin/canceled/cashout-([a-zA-Z0-9]{11})', 'Root\App\Controllers\AdminController@annulationCashOut', 'cashout');

//routes pour l'envoie du mail lors de la reinitialisation du mot de passe
$routes->post('/admin/reset-password', 'Root\App\Controllers\AdminController@resetPasswordOnMail');
$routes->get('/admin/reset-password', 'Root\App\Controllers\AdminController@resetPasswordOnMail');

//routes pour la reinitialisation du mot de passe
$routes->get('/admin/reset-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{60})', 'Root\App\Controllers\AdminController@resetPassword', 'id;token');
$routes->post('/admin/reset-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{60})', 'Root\App\Controllers\AdminController@resetPassword', 'id;token');

//routes pour renvoie du mail
$routes->get('/admin/mail/resend', 'Root\App\Controllers\AdminController@mailResend');
$routes->post('/admin/mail/resend-(reset|activation)', 'Root\App\Controllers\AdminController@mailResend', 'action');

//route pour le succes du mot de passe
$routes->get('/admin/password', 'Root\App\Controllers\AdminController@passwordSuccess');
//route pour mail success
$routes->get('/admin/mail/success', 'Root\App\Controllers\AdminController@mailSendSuccess');



//route pour le succes du mot de passe
//les routes en get vers l'admin pour afficher les users, les admin et les pacl
$routes->get('/admin/viewpacks', 'Root\App\Controllers\AdminController@allPacks');
$routes->get('/admin/users-page-([0-9]+)', 'Root\App\Controllers\AdminController@allUsers', 'page');
$routes->get('/admin/administrator', 'Root\App\Controllers\AdminController@administratorDashboard');
$routes->post('/admin/administrator', 'Root\App\Controllers\AdminController@create');

$routes->get("/admin/history-([0-9]+)", 'Root\App\Controllers\AdminController@history', 'page');
$routes->get("/admin/transaction", 'Root\App\Controllers\AdminController@transaction');

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
// $routes->post('/register-(1|2)-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{11})', 'Root\App\Controllers\UserController@create', 'side;parent;sponsor');
// $routes->get('/register-(1|2)-([a-zA-Z0-9]{11})-([a-zA-Z0-9]{11})', 'Root\App\Controllers\UserController@create', 'side;parent;sponsor');
$routes->post('/register-(1|2)-([a-zA-Z0-9]{11})', 'Root\App\Controllers\UserController@create', 'side;parent');
$routes->get('/register-(1|2)-([a-zA-Z0-9]{11})', 'Root\App\Controllers\UserController@create', 'side;parent');
$routes->get('/reset-password', 'Root\App\Controllers\UserController@resetPasswordOnMail');
$routes->post('/reset-password', 'Root\App\Controllers\UserController@resetPasswordOnMail');
$routes->post('/login', 'Root\App\Controllers\UserController@login');
$routes->get('/login', 'Root\App\Controllers\UserController@login');
$routes->get('/user/dashboard', 'Root\App\Controllers\UserController@dashboard');
$routes->get('/user/logout', 'Root\App\Controllers\UserController@logout');
$routes->get('/user/me', 'Root\App\Controllers\UserController@profil');
$routes->get('/user/edit', 'Root\App\Controllers\UserController@update');
$routes->post('/user/edit', 'Root\App\Controllers\UserController@update');
$routes->get('/user/tree', 'Root\App\Controllers\UserController@tree');
$routes->get('/user/history', 'Root\App\Controllers\UserController@history');
$routes->get('/user/tree-data', 'Root\App\Controllers\UserController@treeData');

//les routes pour le retrait dans le systeme
$routes->get('/user/cashout', 'Root\App\Controllers\CashOutController@cashout');
$routes->post('/user/cashout', 'Root\App\Controllers\CashOutController@cashout');

//les routes pour le contact
$routes->get('/contact', 'Root\App\Controllers\UserController@contact');
$routes->post('/contact', 'Root\App\Controllers\UserController@contact');




//route lors du renvoie du mail s'il ya echec
$routes->get('/mail/error', 'Root\App\Controllers\UserController@mailSendError');
//route lors du renvoie du mail
$routes->get('/mail/resend', 'Root\App\Controllers\UserController@mailResend');
$routes->post('/mail/resend-(reset|activation)', 'Root\App\Controllers\UserController@mailResend', 'action');


/*
    les routes de succes pour 
    1. l'envoie du mail
    2. la reinitialisation du mot de passe avec success
    3. l'incription terminer avec succes 
    4. view pour le lien de parainage
    5. Pour cas ou votre compte a deja atteint 300% du montant investi
 */
$routes->get('/mail/success', 'Root\App\Controllers\Controller@mailSendSuccess');
$routes->get('/user/password', 'Root\App\Controllers\UserController@passwordSuccess');
$routes->get('/user/account', 'Root\App\Controllers\UserController@registerSuccess');
$routes->get('/user/share/link', 'Root\App\Controllers\UserController@shareLink');
//$routes->get('/user/', 'Root\App\Controllers\UserController@shareLink');


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
$routes->get('/teste', function () {
    Controller::redirect("/");
});
try {
    $routes->run();
} catch (NotFoundException $e) {
    $message = $e->getMessage();
    return $e->error404($message);
}
