<?php

namespace App\Controllers;


use App\Controller;
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

}