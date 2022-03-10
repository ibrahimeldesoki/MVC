<?php

class   Home extends Controller {
    public  function index($name = ''){
        echo 'home/index/'.$name;
    }

    public  function test(){
        echo 'home/test';
    }
}