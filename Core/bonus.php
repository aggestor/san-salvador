<?php

require_once dirname(__DIR__).DIRECTORY_SEPARATOR.'Autoloader.php';

use Root\App\Models\ReturnInvestObserver;

if(!ReturnInvestObserver::isRunning()) {
    ReturnInvestObserver::run();
}