<?php

namespace App\Models;

use Core\DBConnection;

abstract class Model
{
    private DBConnection $DBConnection;

    public function __construct(DBConnection $DBConnection)
    {
        $this->DBConnection = $DBConnection;
    }

    public function getPDO()
    {
        return $this->DBConnection->getPDO();
    }

    public function getTable()
    {
    }

    public function create(array $array)
    {
        // get table name
        $table = $this->getTable();
        //  get cols
        // get values
        // insert
        // find by id
    }
}