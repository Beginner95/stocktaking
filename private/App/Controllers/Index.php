<?php

namespace App\Controllers;

use App\Controller;
use App\Model\Order;
use App\Model\OrderProducts;
use App\Model\Product;

class Index
    extends Controller
{
    public function actionDefault()
    {
        $this->view->display(__DIR__ . '/../../../views/manager/index.php');
    }

    /**
     * @throws \App\DbException
     */
    public function actionSearch()
    {
        if (!empty($_POST['q'])) {
            $products = Product::search($_POST['q']);
            echo json_encode($products);
        }
    }

    /**
     * @throws \App\DbException
     */
    public function actionProduct()
    {
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            echo json_encode(Product::findById($_GET['id']));
        }
    }

    /**
     * @throws \App\DbException
     */
    public function actionCheckout()
    {
        $order = new Order();
        if (!empty($_POST['products'])) {
            $total_quantity = (int)$_POST['quantity'];
            $total_sum = (float)$_POST['total-sum'];
            $user_id = $_SESSION['user']['id'];
            $order->quantity = $total_quantity;
            $order->total_sum = $total_sum;
            $order->date_added = date('Y-m-d H:i:s');
            $order->user_id = $user_id;
            $order->save();
            $products = json_decode($_POST['products'], true);
            foreach ($products as $product) {
                $order_product = new OrderProducts();
                $prod = Product::findById($product['id']);
                $order_product->code = $product['code'];
                $order_product->name = $product['name'];
                $order_product->price = $product['price'];
                $order_product->quantity = $product['quantity'];
                $order_product->total_sum = $product['price'] * $product['quantity'];
                $order_product->order_id = $order->id;
                $order_product->save();
                $prod->quantity = $prod->quantity - $product['quantity'];
                $prod->save();
            }
            echo 1;
        } else {
            echo 0;
        }
    }
}