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

}