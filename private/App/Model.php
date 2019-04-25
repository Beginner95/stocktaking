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

    /**
     * @param $id
     * @return bool
     * @throws DbException
     */
    public static function findById($id)
    {
        $db = new Db();
        $data = $db->query(
            'SELECT * FROM ' . static::$table . 'WHERE id=:id',
            [':id' => $id],
            static::class
        );
        return $data[0] ?? false;
    }

}