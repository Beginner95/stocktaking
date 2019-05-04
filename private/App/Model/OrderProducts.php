<?php

namespace App\Model;

use App\Model;

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
}