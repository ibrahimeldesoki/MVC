<?php

namespace Core;

class DBConnection
{
    public function getPDO()
    {
        $host = 'localhost';
        $userName = 'root';
        $password = 'root';
        $DBName = 'mvc';
        try {
            return new \PDO("mysql:host=$host;dbname=$DBName", $userName, $password);
        } catch (\PDOException $PDOException) {
            echo $PDOException->getMessage();
        }
    }
}


