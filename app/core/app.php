<?php

class app{

    protected $url = [];
    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $this->url = $this->parseUrl();
        $this->checkController($this->url[0]);

        require_once '../app/controllers/'.$this->controller.'.php';
        $controller = new $this->controller;
        $this->checkMethod($controller , $this->url['1']);
        $this->params = $this->url ? array_values($this->url) : [];

        call_user_func_array([$this->controller,$this->method],$this->params);
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])){
             $rtrimSlashUrl = rtrim($_GET['url'],'/');
             $filterUrl = filter_var($rtrimSlashUrl,FILTER_SANITIZE_URL);
             return explode('/',$filterUrl);
        }
    }

    public  function checkController(string $controller)
    {
        if (file_exists('../app/controllers/'.$controller.'.php'))
        {
            $this->controller = $controller;
            unset($this->url[0]);
        }
    }

    public function checkMethod(object $controller ,string $method)
    {
        if (method_exists($controller,$method))
        {
            $this->method = $method;
            unset($this->url[1]);
        }
    }
}