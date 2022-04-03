<?php

namespace App\Models;

use Core\DBConnection;
use PDO;

abstract class Model
{
	private DBConnection $dbConnection;

	protected $table = null;

	public function __construct(DBConnection $dbConnection)
	{
		$this->dbConnection = $dbConnection;
	}

	public function getTable()
	{
		if ($this->table) {
			return $this->table;
		}

		$ref = new \ReflectionClass(get_called_class());

		return sprintf('%ss', strtolower($ref->getShortName()));
	}

	public function create(array $array)
	{
		$cols = array_keys($array);

		$placeholders = array_map(function ($col) {
			return ':'.$col;
		}, $cols);

		$values = array_values($array);

		$query = sprintf('INSERT INTO %s (%s) VALUES (%s)', $this->getTable(), implode(', ', $cols), implode(', ', $placeholders));

		$stmt = $this->dbConnection->getPdo()->prepare($query);

		foreach ($cols as $index => $col) {
			$stmt->bindValue(':'.$col, $values[$index]);
		}
		$stmt->execute();

		return $this->find($this->dbConnection->getPdo()->lastInsertId());
	}

	public function find(string $id)
	{
		$query = sprintf('SELECT * FROM %s WHERE id = :id', $this->getTable());

		$stmt = $this->dbConnection->getPdo()->prepare($query);
		$stmt->bindValue(':id', $id);
		$stmt->execute();

		return $stmt->fetch(PDO::FETCH_ASSOC);
	}
}