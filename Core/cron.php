<?php

use Root\App\Models\ReturnInvestCronJob;
use Root\Autoloader;
use Root\Core\EnabledCashOut;

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Autoloader.php';
//require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor' . DIRECTORY_SEPARATOR . 'autoload.php';
Autoloader::register();

if (EnabledCashOut::isEnabled(getdate(), true)) {
    ReturnInvestCronJob::run();
}
