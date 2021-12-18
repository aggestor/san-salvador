<?php

namespace Root\routes;

class Route
{
    public $path;
    public $action;
    public $matches = [];

    /**
     * collection des noms de parametres
     * @var string[]
     */
    private $paramsNames = [];

    /**
     * @param string $path
     * @param mixed $action
     */
    public function __construct($path, $action, ?string $paramsNames = null)
    {
        $this->action = $action;
        $this->path = $path;

        if ($paramsNames != null) {
            $this->paramsNames = explode(";", $paramsNames);
        }
    }

    /**
     * comparaison du pattern avec l'URL
     * @param string $url
     * @return array|bool
     */
    public function matches(string $url)
    {
        $matches = array();
        if (preg_match("#^{$this->path}$#", $url, $matches)) {
            return $matches;
        }
        return false;
    }

    /**
     * @return multitype:string 
     */
    public function getParamsNames()
    {
        return $this->paramsNames;
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
