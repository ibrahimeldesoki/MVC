<?php

class   home extends Controller {
    protected $user;

    /**
     * @param $user
     */
    public function __construct()
    {
        $this->user = $this->model('User');
    }

    public  function index($name = ''){
        $user = $this->user;
        $user->name = $name;
        $this->view('home/index' , ['name'=>$user->name]);
//        User::create(['name'=>$user->name]);
    }

    public  function create($username= '', $email = '')
    {
        print_r($email);
        $this->user->create([
            'username' => $username,
            'email' => $email
        ]);
    }
}