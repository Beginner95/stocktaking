<?php

namespace App\Model;


use App\Model;

class Product
    extends Model
{
    public static $table = 'product';
    public $id;
    public $category_id;
    public $manufacturer_id;
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
}