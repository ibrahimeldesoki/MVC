<?php

class User extends Illuminate\Database\Eloquent\Model
{
    public $name;
    protected $fillable=[
        'username',
        'email'
    ];
}