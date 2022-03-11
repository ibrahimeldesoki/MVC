<?php

namespace Core;

class App
{
    /**
     * @var Router
     */
    private $router;

    public function __construct(Router $router)
    {
        $this->router = $router;
    }

    public function run()
    {
        $this->url = $this->parseUrl();

        list($controller, $method, $params) = $this->router->match('/' . $this->url);

        call_user_func_array([new $controller, $method], $params);
    }

    public function parseUrl()
    {
        return $_GET['url'] ?? '/';
    }
}