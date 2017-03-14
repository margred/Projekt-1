<?php

namespace HAWMS\routing;

use HAWMS\http\Request;

class Router
{
    private $routes = [];

    /**
     * @param Request $request
     * @return array
     */
    public function route(Request $request)
    {
        foreach ($this->routes as $route) {
            if (preg_match($route->getPattern(), $request->getUri())) {
                return $route->getParams();
            }
        }
        return [];
    }

    public function addRoute(Route $route)
    {
        $this->routes[] = $route;
    }

    /**
     * @return array
     */
    public function getRoutes(): array
    {
        return $this->routes;
    }

}
