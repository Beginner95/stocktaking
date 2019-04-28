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

    public function getManufacturer()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $manufacturer = \App\Model\Manufacturer::findById($id);
        } else {
            $manufacturer = new \App\Model\Manufacturer();
        }
        return $manufacturer;
    }
}