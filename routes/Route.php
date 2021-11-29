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
     * La methode execute de notre route 
     *
     * @return void
     */
    public function execute()
    {
        if (is_string($this->action)) {
            $params = explode('@', $this->action);
            $controller = new $params[0]();
            $methode = $params[1];
            return isset($this->matches[1]) ? $controller->$methode($this->matches[1]) : $controller->$methode();
        } else {
            call_user_func_array($this->action, $this->matches);
        }
    }
}
