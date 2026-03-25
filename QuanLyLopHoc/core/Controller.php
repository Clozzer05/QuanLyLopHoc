<?php
class Controller {
    protected function view($path, $data = []) {
        ob_start(); 
        extract($data);
        require __DIR__ . '/../views/' . $path . '.php';
        ob_end_flush();
    }
    protected function redirect($url) {
        if (ob_get_length()) ob_clean();       
        header("Location: index.php?controller=" . $url);
        exit();
    }
}