<?php

namespace App\Model;


use App\Model;

class Category
    extends Model
{
    public static $table = 'categories';
    public $id;
    public $parent_id;
    public $title;
    public $description;
    public $date_added;
}