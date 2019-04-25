<?php

spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class . '.php');
    if (file_exists($file)) {
        require_once $file;
    } else {
        throw new Exception('Не удалось найти файл ' . $file);
    }
});