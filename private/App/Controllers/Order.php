<?php

namespace App\Controllers;

use App\Controller;
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
            \App\Model\OrderProducts::deleteOrderProducts($order->id);
        }

    }


}