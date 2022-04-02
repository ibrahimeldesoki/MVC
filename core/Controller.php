<?php

namespace Core;

class Controller
{
    public function model(string $model)
    {
        $this->model = $model;
        require_once '../app/Models/' . $this->model . '.php';
        return new $this->model();
    }

    public function view($view, $data = [])
    {
        require_once '../app/views/' . $view . '.html';
    }
}