<?php

namespace Core;

class DBConnection
{
	private $host;
	private $port;
	private $user;
	private $pass;
	private $db;

	private $pdo;

	public function __construct($host, $port, $user, $pass, $db)
	{
		$this->host = $host;
		$this->port = $port;
		$this->user = $user;
		$this->pass = $pass;
		$this->db = $db;

		$this->connect();
	}

	public function connect()
	{
		try {
			$this->pdo = new \PDO("mysql:host={$this->host};port={$this->port};dbname={$this->db}", $this->user, $this->pass);
		} catch (\PDOException $PDOException) {
			dd($PDOException->getMessage());
		}
	}

	public function getPdo()
	{
		return $this->pdo;
	}
}


