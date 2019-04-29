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

    /**
     * @throws \App\DbException
     */
    public function actionSave()
    {
        $product = $this->getProduct();
        if(!empty($_POST)) {
            $product->code = strip_tags($_POST['code']);
            $product->name = strip_tags($_POST['name']);
            $product->category_id = intval($_POST['category-id']);
            $product->manufacturer_id = intval($_POST['manufacturer-id']);
            $product->purchase_price = (float)$_POST['purchase-price'];
            $product->markup = (float)$_POST['markup'];
            $product->quantity = intval($_POST['quantity']);
            $product->date_added = date('Y-m-d H:i:s');
            $product->price = (float)$_POST['price'];
            $product->save();
        }
    }

    /**
     * @throws \App\DbException
     */
    public function actionDelete()
    {
        $product = $this->getProduct();
        if(null !== $product->id) {
            $product->delete();
        }
    }


    /**
     * @throws \App\DbException
     */
    public function actionEdit()
    {
        $this->view->product = $this->getProduct();
        $this->view->product->categories = \App\Model\Category::findAll();
        $this->view->product->manufacturers = \App\Model\Manufacturer::findAll();
        if ($_GET['ajax'] === 'true') {
            echo json_encode($this->view->product);
        } else {
            $this->view->display(__DIR__ . '/../../../views/products.php');
        }
    }
}