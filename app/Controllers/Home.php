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