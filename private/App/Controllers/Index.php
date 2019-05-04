<?php

namespace App\Controllers;


use App\Controller;


class Index
    extends Controller
{
    public function actionDefault()
    {
        $this->view->display(__DIR__ . '/../../../views/manager/index.php');
    }

}