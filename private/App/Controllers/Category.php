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

    /**
     * @throws \App\DbException
     */
    public function actionSave()
    {
        $category = new \App\Model\Category();
        if (!empty($_POST)) {
            $category->title = strip_tags($_POST['title']);
            $category->description = strip_tags($_POST['description']);
            $category->date_added = date('Y-m-d H:i:s');
            $category->save();
        }
    }

    /**
     * @throws \App\DbException
     */
    public function actionEdit()
    {
        $this->view->category = $this->getCategory();
        if ($_GET['ajax'] === 'true') {
            echo json_encode($this->view->category);
        } else {
            $this->view->display(__DIR__ . '/../../../views/categories.php');
        }
    }

    /**
     * @throws \App\DbException
     */
    public function actionDelete()
    {
        $category = $this->getCategory();
        if (null !== $category->id) {
            $category->delete();
        }
    }

}