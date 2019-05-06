<?php

namespace App\Controllers;

use App\Controller;
class Order
	extends Controller
{
	public function actionDefault()
	{
		$this->view->orders = \App\Model\Order::findAll();
		$this->view->display(__DIR__ . '/../../../views/manager/order.php');
	}
}