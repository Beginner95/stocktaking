<?php

namespace App\Controllers\Admin;

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
        $this->view->display(__DIR__ . '/../../../../views/admin/products.php');
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
            if ($_POST['ajax'] == 'true') {
                $product->purchase_price = (float)$_POST['purchase-price'];
                $product->markup = (float)$_POST['markup'];
                $product->quantity = intval($_POST['quantity']);
                $product->price = (float)$_POST['price'];
            } else {
                $product->code = strip_tags($_POST['code']);
                $product->name = strip_tags($_POST['name']);
                $product->category_id = intval($_POST['category-id']);
                $product->manufacturer_id = intval($_POST['manufacturer-id']);
                $product->purchase_price = (float)$_POST['purchase-price'];
                $product->markup = (float)$_POST['markup'];
                $product->quantity = intval($_POST['quantity']);
                $product->date_added = date('Y-m-d H:i:s');
                $product->price = (float)$_POST['price'];
            }
            
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
            $this->view->display(__DIR__ . '/../../../../views/admin/products.php');
        }
    }

    public function actionExists()
    {
        if (!empty($_POST)) {
            if (isset($_POST['code'])) {
                $product = \App\Model\Product::exists($_POST['code'], 'code');
            }
            if (isset($_POST['name'])) {
                $product = \App\Model\Product::exists($_POST['name'], 'name');
            }
            
            if (!empty($product)) {
                echo json_encode($product);
            } else {
                echo 0;
            }
        }
    }
}