<?php

namespace Root\App\Controllers;

class Controller
{
    public function view(string $path, array $params = null, string $template = 'layouts')
    {
        ob_start();
        $path = str_replace('.', DIRECTORY_SEPARATOR, $path);
        require VIEWS . $path . '.php';
        if ($params) {
            $params = extract($params);
        }
        $content = ob_get_clean();
        require VIEWS . $template . '.php';
    }
}
