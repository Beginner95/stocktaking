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

    /**
     * @return \App\Model\Manufacturer|bool
     * @throws \App\DbException
     */
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

    /**
     * @throws \App\DbException
     */
    public function actionSave()
    {
        $manufacturer = $this->getManufacturer();
        if (!empty($_POST)) {
            $manufacturer->title = strip_tags($_POST['title']);
            $manufacturer->description = strip_tags($_POST['description']);
            $manufacturer->date_added = date('Y-m-d H:i:s');
            $manufacturer->save();
        }
    }
}