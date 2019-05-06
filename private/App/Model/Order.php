<?php

namespace App\Model;

use App\Db;
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

    public function __get($var)
    {
    	if ('user' === $var) {
    		return User::findById($this->user_id);
    	}
    	return null;
    }

    public function __isset($var)
    {
    	if ('user' === $var) {
    		return true;
    	}
    	return false;
    }
}