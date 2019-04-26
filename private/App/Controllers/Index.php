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

    /**
     * @return Product|bool
     * @throws \App\DbException
     */
    public function getProduct()
    {
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $product = Product::findById($id);
        } else {
            $product = new Product();
        }
        return $product;
    }
}