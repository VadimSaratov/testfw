<?php
use vendor\core\Router;
require '../../common/config/constants.php';
require '../../common/autoload.php';

$config = include FRONTEND . '/config/main.php';

$query = rtrim($_SERVER['QUERY_STRING'], '/');
$router = new Router($config);
$router->run($query);
?>
