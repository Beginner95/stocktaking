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

    public function isNew()
    {
        return empty ($this->id);
    }

    /**
     * @throws DbException
     */
    protected function insert()
    {
        $columns = [];
        $binds = [];
        $data = [];

        foreach ($this as $column => $value) {
            if ('id' == $column) {
                continue;
            }
            $columns[] = $column;
            $binds[] = ':' . $column;
            $data[':' . $column] = $value;
        }

        $sql = '
            INSERT INTO ' . static::$table . '
            (' . implode(', ', $columns) .')
            VALUES
            (' . implode(', ', $binds) .')
        ';

        $db = new Db();
        $db->execute($sql, $data);
        $this->id = $db->lastInsetId();
    }

    /**
     * @throws DbException
     */
    protected function update()
    {
        $columns = [];
        $data =[];
        $data[':id'] = $this->id;

        foreach ($this as $column => $value) {
            if ('id' == $column) {
                continue;
            }
            $columns[] = $column . '=:' . $column;
            $data[':' . $column] = $value;
        }

        $sql = '
            UPDATE ' . static::$table . '
            SET ' . implode(', ', $columns) . '
            WHERE id=:id
        ';
        $db = new Db();
        $db->execute($sql, $data);
    }

}