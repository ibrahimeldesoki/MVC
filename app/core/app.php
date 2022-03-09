<?php

class app{

    protected $controller = 'home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        echo $this->parseUrl();
    }

    public function parseUrl()
    {
        if (isset($_GET['url'])){
                echo $_GET['url'];
        }
    }
}