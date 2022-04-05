<?php

namespace Core;

class QueryBuilder
{
    private $table;
    private $cols;
    private $wheres;
    private $whereStatements = '';

    public function table(string $tableName)
    {
        $this->table = $tableName;
        return $this;
    }

    public function select($cols = ['*'])
    {
        if ($cols == '*') {
            $this->cols[] = '*';

            return $this;
        }

        $this->cols = [];
        foreach ($cols as $col) {
            $this->cols[] = $col;
        }


        return $this;
    }

    public function where(string $whereCol, $operator = '=', $whereVal)
    {
        $this->wheres[] = [
            'whereCol' => $whereCol,
            'operator' => $operator,
            'whereVal' => gettype($whereVal) == 'string' ? "'" . $whereVal . "'" : $whereVal
        ];

        $this->bindWheres();

        return $this;
    }

    public function bindWheres()
    {
        $this->whereStatements = ' WHERE ';
        foreach ($this->wheres as $where) {
            $this->whereStatements .= " " . $where['whereCol'] . " " . $where['operator'] . " " . $where['whereVal'] . ' AND';
        }
        return $this->whereStatements;
    }

    public function wheresStatementsProcess()
    {
        $words = explode(" ", $this->whereStatements);
        array_splice($words, -1);

        $this->whereStatements = implode(" ", $words);
    }


    public function toSql()
    {
        $this->wheresStatementsProcess();
        $query = "SELECT " . implode(', ', $this->cols) . " FROM " . $this->table . $this->whereStatements;

        return $query;
    }
}