<?php

namespace Core;

class Router
{
    private $routes = [];

    public function get($path, $action)
    {
        $path = preg_replace('/\{(.*?)\}/i', "(\w+)", $path);
        $this->routes[$path] = $action;
    }

    public function match($path)
    {
        foreach ($this->routes as $route => $action) {
            $route = str_replace('/', '\/', $route);
            preg_match('/' . $route . '/', $path, $matches);

            if (count($matches) > 0) {
                array_shift($matches);
                $action[] = $matches;
                
                return $action;
            }
        }
        throw new \Exception('Route not found');
    }
}