<?php

namespace App;

abstract class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function action($action)
    {
        if (false === $this->access()) {
            return false;
        } else {
            $actMethodName = 'action' . $action;
            return $this->$actMethodName;
        }
    }

    private function access()
    {
        return true;
    }
}