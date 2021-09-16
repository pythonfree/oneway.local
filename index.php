<?php

require_once __DIR__ . '/functions.php';
require_once __DIR__ . '/autoload.php';

$method = !empty($_GET['method']) ? $_GET['method'] : 'index';
$controller = new PageC();
$controller->request($method);

