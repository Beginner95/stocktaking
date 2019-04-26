<?php

namespace App\Controllers;

use App\Controller;
use App\Model\Product;

class Index
    extends Controller
{
    /**
     * @throws \App\DbException
     */
    public function actionDefault()
    {
        $products = Product::findAll();
        $this->view->products = $products;
        $this->view->display(__DIR__ . '/../../../views/products.php');
    }
}