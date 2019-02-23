<?php

namespace Core;

class Router
{
    private $routes = [];
    private $params = [];

    public function addRoutes(string $route, array $params)
    {
        $this->routes[$route] = $params;
    }

    public function getRoutes()
    {
        return $this->routes;
    }

    public function matchRoutes($url)
    {
        foreach($this->routes as $route=>$params) {
            if($url == $route){
                $this->params = $params;
                return true;
            }
        }
        return false;
    }

    public function getParams()
    {
        return $this->params;
    }

    public function dispatch($url)
    {
        if ($this->matchRoutes($url)) {
            $controller = "App\Controllers\\" . $this->params[0];
            if (class_exists($controller)) {
                $controller_obj = new $controller($this->params);
                $action = $this->params[1];
                if (is_callable([$controller_obj, $action])) {
                    $controller_obj->$action();
                } else {
                    throw new \Exception("method $action (in controller $controller) not found");
                }
            } else {
                throw new \Exception("Controller $controller not found");
            }
        } else {
            throw new \Exception("Route not match");
        }
    }
}