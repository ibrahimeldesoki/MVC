<?php

namespace Core;

class Controller
{
//    private $model ;
    public function __construct()
    {
    }

    public function model(string $model)
    {
        $this->model = $model;
        require_once '../app/models/' . $this->model . '.php';
        return new $this->model();
    }

    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.html';
    }
}