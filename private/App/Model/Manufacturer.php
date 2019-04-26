<?php

namespace App\Model;


use App\Model;

class Manufacturer
    extends Model
{
    public static $table = 'manufacturers';
    public $id;
    public $title;
    public $description;
    public $date_added;
}