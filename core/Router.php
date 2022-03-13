<?php

namespace Core;

class Router
{
    private $routes = [];

    public function get($path, $action)
    {
        $this->addRoute('GET', $path, $action);
    }

    public function post($path, $action)
    {
        $this->addRoute('POST', $path, $action);
    }

    private function addRoute($method, $path, $action)
    {
        $path = preg_replace('/\{(.*?)\}/i', "(\w+)", $path);

        $this->routes[$path][$method] = $action;
    }

    public function match($path)
    {
        $REQUEST_METHOD = $_SERVER['REQUEST_METHOD'];
        foreach ($this->routes as $route => $methods) {
            $route = str_replace('/', '\/', $route);
            preg_match('/^' . $route . '$/', $path, $parmas);
            if (count($parmas) > 0) {

                if (isset($methods[$REQUEST_METHOD])) {
                    $action = $methods[$REQUEST_METHOD];
                    array_shift($parmas);

                    if ($action instanceof \Closure) {
                        return [$action, null, $parmas];
                    }
                    $action[] = $parmas;

                    return $action;
                }

                throw new \Exception('Method Not Allowed');
            }
        }
        throw new \Exception('Route Not Found');
    }
}