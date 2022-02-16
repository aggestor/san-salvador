<?php

use Root\Autoloader;

require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'Autoloader.php';
require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'vendor'.DIRECTORY_SEPARATOR.'autoload.php';
Autoloader::register();

use Root\App\Models\ReturnInvestObserver;

if(!ReturnInvestObserver::isRunning()) {
    ReturnInvestObserver::run();
}