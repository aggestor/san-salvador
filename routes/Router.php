<?php

namespace Root\routes;

use Root\App\Exceptions\NotFoundException;


class Router
{
    public $url;

    /**
     * @var Route[]
     */
    public $routes = [];


    /**
     * Constructeur de la classe route
     * @param string $url
     */
    public function __construct($url)
    {
        $this->url = $url;
    }
    /**
     * La methode get de notre routeur
     *
     * @param string $path L'url de notre routeut
     * @param string $action La methode a executer par le routeur
     * @return void
     */
    public function get(string $path, $action, ?string $paramsNames = null)
    {
        $this->addRoute("GET", $path, $action, $paramsNames);
    }
    /**
     * La methode post de notre routeur 
     *
     * @param string $path $path L'url de notre routeut
     * @param string $action $action La methode a executer par le routeur
     * @return void
     */
    public function post(string $path, string $action, ?string $paramsNames = null)
    {
        $this->addRoute("POST", $path, $action, $paramsNames);
    }

    /**
     * atout d'une route
     * @param string $path
     * @param string $action
     * @param string $paramsName
     */
    public function addRoute(string $method, string $path, $action, ?string $paramsNames = null): void
    {
        $this->routes[$method][] = new Route($path, $action, $paramsNames);
    }
    /**
     * La methode run de notre routeur pour l'execution de nos differentes routes 
     * @return void
     */
    public function run()
    {
        //         var_dump($this->routes);
        //         exit();
        foreach (($this->routes[$_SERVER['REQUEST_METHOD']]) as $route) {
            $matches = $route->matches($this->url);
            if ($matches !== false) {

                if (!empty($route->getParamsNames())) {
                    $params = [];
                    foreach ($route->getParamsNames() as $key => $name) {
                        $params[$name] = $matches[$key + 1];
                    }

                    $_GET = array_merge($_GET, $params);
                }
                try {
                    return $route->execute();
                } catch (\Exception $th) {
                    throw new NotFoundException("Une erreur est survenue dans le processuce de generation de la page: {$th->getMessage()}");
                }
            }
        }


        throw new NotFoundException("La page demandée n'a pas été trouvé");
    }
}
