<?php
use vendor\core\Router;
session_start();
require '../../common/config/constants.php';
require '../../common/autoload.php';
$query = rtrim($_SERVER['QUERY_STRING'], '/');
$config = include BACKEND . DS . 'config'. DS .'main.php';
$router = new Router($config);
$router->run($query);
