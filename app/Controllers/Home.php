<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;

class Home extends Controller
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function index($name = '')
    {
        $user = $this->user->create(['username' => "ali", 'email' => 'aldfk@dfsd.com']);
        
        $this->view('home/index', ['name' => $user->name]);
    }

    public function create($username = '', $email = '')
    {
        echo "POST";
//        $this->user->create([
//            'username' => $username,
//            'email' => $email
//        ]);
    }
}