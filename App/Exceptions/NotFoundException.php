<?php

namespace Root\App\Exceptions;

use Exception;
use Root\App\Controllers\Controller;
use Throwable;

class NotFoundException extends Exception
{
    public function __construct($message = "", $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
    public function error404()
    {
        //require VIEWS . 'pages/404.php';
        http_response_code(404);
        $controller = (new Controller())->view('pages.static.404');
    }
}
