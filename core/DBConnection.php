<?php

namespace Core;

class DBConnection
{
    public function __construct()
    {
        $host = 'localhost';
        $userName = 'root';
        $password = 'root';
        $DBName = 'mvc';
        try {
            $connection = new \PDO("mysql:host=$host;dbname=$DBName", $userName, $password);
            return $connection;
        } catch (\PDOException $PDOException) {
            echo $PDOException->getMessage();
        }
    }
}


