<?php

namespace App\Model;

use App\Model;

class User
    extends Model
{
    public static $table = 'users';
    public $id;
    public $login;
    public $password;
    public $first_name;
    public $last_name;
    public $second_name;
    public $role;
}