<?php

namespace App;


abstract class Model
{
    public $id;

    /**
     * @throws DbException
     */
    public static function findAll()
    {
        $db = new Db();
        $data = $db->query(
            'SELECT * FROM ' . static::$table,
            [],
            static::class
        );
        return $data;
    }

}