<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

/**
 * Controller & action mặc định
 */
$controller = $_GET['controller'] ?? 'auth';
$action     = $_GET['action'] ?? 'index';

/**
 * Chuẩn hóa tên controller
 * auth -> AuthController
 */
$controllerName = ucfirst($controller) . 'Controller';
$controllerFile = __DIR__ . '/controllers/' . $controllerName . '.php';

/**
 * Kiểm tra controller tồn tại
 */
if (!file_exists($controllerFile)) {
    die("Controller không tồn tại: $controllerName");
}

require_once $controllerFile;

/**
 * Tạo object controller
 */
$controllerObject = new $controllerName();

/**
 * Kiểm tra action tồn tại
 */
if (!method_exists($controllerObject, $action)) {
    die("Action không tồn tại: $action");
}

/**
 * Gọi action
 */
$controllerObject->$action();
