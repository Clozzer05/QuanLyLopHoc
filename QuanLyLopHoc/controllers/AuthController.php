<?php
require_once __DIR__ . '/../models/NguoiDungModel.php';
require_once __DIR__ . '/../services/NguoiDungService.php';
require_once __DIR__ . '/../core/Controller.php';

class AuthController extends Controller {
    public function index() {
        $this->view('auth/dang_nhap');
    }

    public function login() {
        $service = new NguoiDungService();
        $user = $service->login(
            $_POST['ten_dang_nhap'],
            $_POST['mat_khau']
        );

        if ($user) {
            $_SESSION['user'] = $user;
            switch ($user->vai_tro) {
                case 'admin':
                    $this->redirect('admin&action=index');
                    break;
                case 'gv':
                    $this->redirect('gv&action=index');
                    break;
                default:
                    $this->redirect('sv&action=index');
            }
        } else {
            $this->view('auth/dang_nhap', [
                'error' => 'Sai tài khoản hoặc mật khẩu'
            ]);
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        $this->redirect('auth');
    }
}
//chu thich demo