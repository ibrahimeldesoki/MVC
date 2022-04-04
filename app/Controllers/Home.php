<?php

namespace App\Controllers;

use App\Models\User;
use Core\Controller;
use Core\QueryBuilder;

class Home extends Controller
{
	protected $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function index($name = '')
	{
        $users = new QueryBuilder();
        $users->table('users')
            ->select('*')
            ->where('username', '=', 'ibra')
            ->where('id', '=', 1)
            ->toSql();

        dd($users);
		$user = $this->user->find(1);

		$this->view('home/index', ['name' => $user['username']]);
	}

	public function create($username = '', $email = '')
	{
		$this->user->create([
			'username' => $username,
			'email' => $email,
		]);
	}
}