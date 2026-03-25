<?php
class Controller {
    protected function requireLogin($allowedRoles = []) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['user'])) {
            $this->redirect('auth&action=index');
        }

        if (!empty($allowedRoles)) {
            $userRole = $_SESSION['user']->vai_tro ?? null;
            if (!$userRole || !in_array($userRole, $allowedRoles, true)) {
                $this->redirect('auth&action=index');
            }
        }
    }

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