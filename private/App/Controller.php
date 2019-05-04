<?php

namespace App;

abstract class Controller
{
    protected $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function action($action, $role)
    {
        if (false === $this->access($role)) {
            return false;
        } else {
            $actMethodName = 'action' . $action;
            return $this->$actMethodName();
        }
    }

    private function access($role)
    {
        if (empty($_SESSION['user'])) return true;
        if ('admin' === $role && $_SESSION['user']['role'] === 'Administrator') return true;
        if ('manager' === $role && $_SESSION['user']['role'] === 'Administrator') return true;
        if ('manager' === $role && $_SESSION['user']['role'] === 'Manager') return true;

        return false;
    }
}