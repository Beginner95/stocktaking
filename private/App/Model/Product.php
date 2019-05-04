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
        $sql = 'SELECT `id`, `code`, `name`, `price`, `quantity`  FROM ' . static::$table . ' WHERE name LIKE ? OR code LIKE ?';
        return $db->query($sql, ["%$query%", "%$query%"]);
    }
}