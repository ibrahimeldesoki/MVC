<?php

namespace App\Models;

class User extends Model
{
//    public function create(array $array)
//    {
//        $pdo = $this->getPDO();
//        $preparedSQL = $pdo->prepare(
//            'INSERT INTO `mvc`.`users`
//                (`username`,`email`) VALUES (:username,:email)');
//
//        $preparedSQL->bindParam(':username', $array['username'], \PDO::PARAM_STR);
//        $preparedSQL->bindParam(':email', $array['email'], \PDO::PARAM_STR);
//
//        $preparedSQL->execute();
//
//        return $this->findById($pdo->lastInsertId());
//    }

    public function findById(int $id)
    {
        $pdo = $this->getPDO();
        $preparedSQL = $pdo->prepare(
            'SELECT * FROM `mvc`.`users` 
                 where `id` = :id');

        $preparedSQL->bindParam(':id', $id);
        $preparedSQL->execute();

        return $preparedSQL->fetch(\PDO::FETCH_ASSOC);
    }

}