<?php

namespace Core;

class DBConnection
{
    public function getPDO()
    {
        $host = '127.0.0.1';
        $userName = 'root';
        $password = 'root';
        $port = '3399';
        $DBName = 'mvc';
        try {
            return new \PDO("mysql:host=$host;port=$port;dbname=$DBName", $userName, $password);
        } catch (\PDOException $PDOException) {
            dd($PDOException->getMessage());
        }
    }
}


