<?php
session_start();
require_once __DIR__ . '/../private/autoload.php';

$view = new App\View();

$parts = explode('/', $_SERVER['REQUEST_URI']);
$ctrlRequest = !empty($parts[2]) ? $parts[2] : 'Index';

if (empty($_SESSION['user'])) {
    header('Location: /auth');
}

$ctrlClassName = '\App\Controllers\Admin\\' . $ctrlRequest;
$actRequest = !empty($parts[3]) ? $parts[3] : 'Default';
$ctrl = new $ctrlClassName;

try {
    $access = $ctrl->action($actRequest, 'admin');
    if (false === $access) {
        header('Location: /auth/denied');
    }
} catch (\App\DbException $e) {
    $view->error = $e->getMessage();
    $view->display(__DIR__ . '/../views/error.php');
} catch (\App\NotFoundException $e) {
    $view->error = $e->getMessage();
}