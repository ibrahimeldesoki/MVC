<?php

namespace Core;

class QueryBuilder
{
    private $table;
    private $cols;
    private $wheres;
    private $whereStatements;

    public function table(string $tableName)
    {
        $this->table = $tableName;
        return $this;
    }

    public function select($cols = ['*'])
    {
        $this->cols = [];
        foreach ($cols as $col) {
            $this->cols[] = $col;
        }

        return $this;
    }

    public function where(string $whereCol, $whereVal, $operator = '=',)
    {
        $this->wheres[] = [
            'whereCol' => $whereCol,
            'operator' => $operator,
            'whereVal' => $whereVal
        ];

        return $this;
    }

    public function bindWheres()
    {
        foreach ($this->wheres as $where) {
            $this->wheresStatements .= " WHERE " . $where['whereCol'] . " " . $where['operator'] . " " . $where['operator'];
        }

        return $this->wheresStatements;
    }

    public function toSql()
    {
        return "SELECT " . implode(', ', $this->cols) . " FROM " . $this->table . $this->wheresStatements;
    }
}