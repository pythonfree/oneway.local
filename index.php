<?php

require_once __DIR__ . '/lib/functions.php';
require_once __DIR__ . '/autoload.php';

$method = $_GET['method'] ?? 'index';

if (isset($_GET['class'])) {
    if ($_GET['class'] === 'page') {
        $controller = new PageC();
    } elseif ($_GET['class'] === 'like') {
        $controller = new LikeC();
    }
} else {
    $controller = new PageC();
}

$controller->request($method);

