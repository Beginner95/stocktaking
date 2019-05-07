<?php

namespace App\Model;

use App\Model;
use App\Db;

class OrderProducts
    extends Model
{
    public static $table = 'order_products';
    public $id;
    public $code;
    public $name;
    public $price;
    public $quantity;
    public $total_sum;
    public $order_id;

    /**
     * @param $order_id
     * @throws \App\DbException
     */
    public static function deleteOrderProducts($order_id)
    {
        $data = [':order_id' => $order_id];
        $sql = 'DELETE FROM ' . static::$table . ' WHERE order_id=:order_id';
        $db = new Db();
        $db->execute($sql, $data);
    }

}