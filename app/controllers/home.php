<?php

class   home extends Controller {

    public  function index($name = ''){
        $user = $this->model('User');
        $user->name = $name;
        $this->view('home/index' , ['name'=>$user->name]);
    }
}