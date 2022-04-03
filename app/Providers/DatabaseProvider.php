<?php

namespace App\Providers;

use Core\DBConnection;
use Core\ServiceProvider;

class DatabaseProvider extends ServiceProvider
{
	public function register(): void
	{
		$this->container->set(DBConnection::class, function () {
			return new DBConnection($_ENV['DB_HOST'], $_ENV['DB_PORT'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);
		});
	}
}