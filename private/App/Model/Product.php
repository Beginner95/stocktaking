<?php

namespace App\Model;


use App\Db;
use App\Model;

class Product
    extends Model
{
    public static $table = 'products';
    public $id;
    public $category_id;
    public $manufacturer_id;
    public $code;
    public $name;
    public $purchase_price;
    public $markup;
    public $price;
    public $quantity;
    public $date_added;

    /**
     * @param $var
     * @return bool|null
     * @throws \App\DbException
     */
    public function __get($var)
    {
        if ('category' == $var) {
            return Category::findById($this->category_id);
        } else if ('manufacturer' == $var) {
            return Manufacturer::findById($this->manufacturer_id);
        }
        return null;
    }

    public function __isset($var)
    {
        if ('category' == $var || 'manufacturer' == $var) {
            return true;
        }
        return false;
    }

    /**
     * @param $query
     * @return array
     * @throws \App\DbException
     */
    public static function search($query)
    {
        $db = new Db();
        $sql = 'SELECT *  FROM ' . static::$table . ' WHERE name LIKE ? OR code LIKE ?';
        return $db->query($sql, ["%$query%", "%$query%"]);
    }

    public static function exists($query, $column)
    {
        $db = new Db();

        if ($column == 'code') {
            $where = ' WHERE code=:code';
        } else {
            $whree = ' WHERE name=:name';
        }

        $sql = 'SELECT `code`, `name` FROM ' . static::$table . ' WHERE ' . $column . '=:' . $column;
        return $db->query($sql, [':'.$column => $query]);

    }
}