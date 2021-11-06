<?php

namespace Root\routes;

use Root\App\Exceptions\NotFoundException;


class Router
{
    public $url;
    public $routes = [];
    /**
     * Constructeur de la classe route
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = trim($url, '/');
    }
    /**
     * La methode get de notre routeur
     *
     * @param string $path La methode de notre routeur
     * @param string $action L'action de notre routeur
     * @return void
     */
    public function get(string $path, string $action)
    {
        $this->routes['GET'][] = new Route($path, $action);
    }
    /**
     * La methode run de notre routeur
     * @return void
     */
    public function run()
    {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) {
            if ($route->matches($this->url)) {
                return $route->execute();
            }
        }
        throw new NotFoundException("La page demandée n'a pas été trouvé");
    }
}
