<?php

namespace App\Model;

class User
{
    public static $table = 'users';
    public $id;
    public $login;
    public $password;
    public $first_name;
    public $last_name;
    public $second_name;
}