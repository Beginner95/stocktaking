<?php

namespace App\Controllers;


use App\Controller;

class Auth
    extends Controller
{
    public function actionDefault()
    {
        $this->view->display(__DIR__ . '/../../../views/auth.php');
    }

    /**
     * @throws \App\DbException
     */
    public function actionLogin()
    {
        if (!empty($_POST['login']) && !empty($_POST['password'])) {
            $login = trim($_POST['login']);
            $password = $_POST['password'];

            $user = \App\Model\User::login($login);
            if (null === $user) {
                echo 0;
            } elseif ($password !== $user['password']) {
                echo 1;
            } else {
                $_SESSION['user']['id'] = $user['id'];
                $_SESSION['user']['login'] = $user['login'];
                $_SESSION['user']['first_name'] = $user['first_name'];
                $_SESSION['user']['second_name'] = $user['second_name'];
                $_SESSION['user']['last_name'] = $user['last_name'];
                $_SESSION['user']['role'] = $user['role'];
                if ($user['role'] !== 'Administrator') {
                    echo '/index';
                } else {
                    echo '/admin/index';
                }
            }
        }

        return false;
    }

    public function actionLogout()
    {
        session_start();
        $_SESSION['user'] = [];
        header('Location: /auth');
    }

    public function actionDenied()
    {
        $this->view->display(__DIR__ . '/../../../views/denied.php');
    }
}