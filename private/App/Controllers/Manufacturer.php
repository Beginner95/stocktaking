<?php


namespace App\Controllers;


use App\Controller;

class Manufacturer
    extends Controller
{
    /**
     * @throws \App\DbException
     */
    public function actionDefault()
    {
        $manufacturers = \App\Model\Manufacturer::findAll();
        $this->view->manufacturers = $manufacturers;
        $this->view->display(__DIR__ . '/../../../views/manufacturers.php');
    }
}