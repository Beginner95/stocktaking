<?php

namespace App\Controllers;

use App\Controller;
use App\Model\OrderProducts;
use App\Model\Product;

class Order
	extends Controller
{
    /**
     * @throws \App\DbException
     */
	public function actionDefault()
	{
		$this->view->orders = \App\Model\Order::findAll();
		$this->view->display(__DIR__ . '/../../../views/manager/order.php');
	}

    /**
     * @return \App\Model\Order|bool
     * @throws \App\DbException
     */
	public function getOrder()
    {
        if (!empty($_GET['id'])) {
            $order = \App\Model\Order::findById($_GET['id']);
        } else {
            $order = new \App\Model\Order();
        }
        return $order;
    }

    /**
     * @throws \App\DbException
     */
	public function actionDelete()
    {
        $order = $this->getOrder();
        if (null !== $order->id) {
            $order->delete();
            OrderProducts::deleteOrderProducts($order->id);
        }

    }

    /**
     * @throws \App\DbException
     */
    public function actionReturn()
    {
        $order = $this->getOrder();
        if (null !== $order->id) {
            $products = OrderProducts::getOrderProducts($order->id);
            foreach ($products as $product) {
                $prod = Product::findById($product->product_id);
                $prod->quantity = $prod->quantity + $product->quantity;
                $prod->save();
            }
            $this->actionDelete();
        }
    }

    /**
     * @throws \App\DbException
     */
    public function actionProducts()
    {
        if (!empty($_GET['order_id'])) {
            $products = OrderProducts::getOrderProducts($_GET['order_id']);
            echo json_encode($products);
        }
    }
}