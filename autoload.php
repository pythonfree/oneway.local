<?php

require_once __DIR__ . '/config/config.php';
include __DIR__ . '/lib/Twig/Autoloader.php';

Twig_Autoloader::register();

spl_autoload_register('autoloadClass');

function autoloadClass($className)
{
    $dirs = ['c', 'm'];
    $found = false;
    foreach ($dirs as $dir) {
        $fileName = __DIR__ . '/' . $dir . '/' . $className . '.class.php';

        if (is_file($fileName)) {
            require_once $fileName;
            $found = true;
        }
    }
    if (!$found) {
        throw new Exception('Загрузка не удалась ' . $className);
    }
    return true;
}