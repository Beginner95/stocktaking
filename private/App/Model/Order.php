<?php

namespace App\Model;


use App\Model;

class Order
    extends Model
{
    public static $table = 'orders';
    public $id;
    public $quantity;
    public $total_sum;
    public $date_added;
    public $user_id;
}