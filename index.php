<?php
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'calendar';
$action = isset($_GET['action']) ? $_GET['action'] : 'show';

require_once "controllers/{$controller}Controller.php";
$controllerClass = ucfirst($controller) . 'Controller';
$controllerInstance = new $controllerClass();
$controllerInstance->$action();
