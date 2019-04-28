<?php

namespace App\Controllers;

use App\Controller;

class Category
    extends Controller
{
    /**
     * @throws \App\DbException
     */
    public function actionDefault()
    {
        $categories = \App\Model\Category::findAll();
        $this->view->categories = $categories;
        $this->view->display(__DIR__ . '/../../../views/categories.php');
    }

    /**
     * @throws \App\DbException
     */
    public function getCategory()
    {
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];
            $category = \App\Model\Category::findById($id);
        } else {
            $category = new \App\Model\Category();
        }
        return $category;
    }

}