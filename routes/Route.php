<?php

namespace Root\routes;

class Route
{
    public $path;
    public $action;
    public $matches = [];
    public function __construct($path, $action)
    {
        $this->action = $action;
        $this->path = trim($path, '/');
    }
    public function matches(string $url)
    {
        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path);
        $pathToMatch = "#^$path$#";
        if (preg_match($pathToMatch, $url, $matches)) {
            $this->matches = $matches;
            return true;
        } else {
            return false;
        }
    }
    /**
     * La fonction qui permet d'enlever le / a la fin de l'url
     * @return void
     */
    private function verify()
    {
        $uri = $_SERVER['REQUEST_URI'];

        //on verifie si $uri n'est pas vide et si elle se termine par /

        if (!empty($uri) && $uri != '/' && $uri[-1] === '/') {
            //on enleve /
            $uri = substr($uri, 0, -1);

            // on envoie un code de reedirection permenante
            http_response_code(301);
            //on redirige vers l'URL sans /

            header('Location: ' . $uri);
        }
    }
    /**
     * La methode execute de notre route 
     *
     * @return void
     */
    public function execute()
    {
        if (is_string($this->action)) {
            $this->verify();
            $params = explode('@', $this->action);
            $controller = new $params[0]();
            $methode = $params[1];
            return isset($this->matches[1]) ? $controller->$methode($this->matches[1]) : $controller->$methode();
        } else {
            call_user_func_array($this->action, $this->matches);
        }
    }
}
