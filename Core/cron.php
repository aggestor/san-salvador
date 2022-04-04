<?php

use Root\App\Models\ReturnInvestCronJob;
use Root\Autoloader;
use Root\Core\EnabledCashOut;

require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

if (EnabledCashOut::isEnabled(getdate(), true)) {
    ReturnInvestCronJob::run();
}
