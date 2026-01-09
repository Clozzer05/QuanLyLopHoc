<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once __DIR__ . '/models/NguoiDungModel.php';

session_start();

$controllerCode = $_GET['controller'] ?? 'auth';
$action         = $_GET['action'] ?? 'index';

$routing = [
    'gv'    => 'GiaoVienController',
    'sv'    => 'SinhVienController',
    'admin' => 'AdminController',
    'auth'  => 'AuthController'
];

if (array_key_exists($controllerCode, $routing)) {
    $controllerName = $routing[$controllerCode];
} else {
    $controllerName = ucfirst($controllerCode) . 'Controller';
}
$controllerFile = __DIR__ . '/controllers/' . $controllerName . '.php';
if (file_exists($controllerFile)) {
    require_once $controllerFile;

    if (class_exists($controllerName)) {
        $object = new $controllerName();

        if (method_exists($object, $action)) {
            $object->$action();
        } else {
            die("Lỗi: Action '$action' không tồn tại trong controller '$controllerName'.");
        }
    } else {
        die("Lỗi: Class '$controllerName' không tồn tại trong file '$controllerFile'.");
    }
} else {
    die("Lỗi 404: Không tìm thấy file Controller: <b>$controllerName</b><br>Tại đường dẫn: $controllerFile");
}