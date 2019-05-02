<?php

namespace App\Model;

use App\Db;
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

    /**
     * @param $login
     * @return array
     * @throws \App\DbException
     */
    public static function login($login)
    {
        $db = new Db();
        $user = $db->query(
         'SELECT * FROM ' . static::$table . ' WHERE login=:login LIMIT 1',
            [':login' => $login]
        );
        return $user[0];
    }
}