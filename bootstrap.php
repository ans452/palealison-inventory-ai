<?php

spl_autoload_register(function($className) {
    $file = str_replace('\\', '/', $className) . '.php';
    if (file_exists($file)) {
        require_once $file;
    }
});
