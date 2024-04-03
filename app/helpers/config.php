<?php

define('ROOT', dirname(__FILE__, 3));
define('DIR_VIEWS', ROOT . '/app/views/');
define('EXT_VIEWS', '.html');

$scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
$baseUri = (string) parse_url('http://a' . ($_SERVER['REQUEST_URI'] ?? ''), PHP_URL_PATH);
if (stripos($baseUri, $_SERVER['SCRIPT_NAME']) === 0) {
    $basePath = $_SERVER['SCRIPT_NAME'];
} elseif ($scriptDir !== '/' && stripos($baseUri, $scriptDir) === 0) {
    $basePath = $scriptDir;
} else {
    $basePath = '/';
}
$basePath = rtrim($basePath, '/') . '/';

define('BASE_PATH', $basePath);
