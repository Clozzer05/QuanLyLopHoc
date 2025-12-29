<?php
require_once __DIR__ . '/../models/NguoiDungModel.php';
require_once __DIR__ . '/../core/Controller.php';
class AuthController extends Controller {
    public function index() {
        $this->view('auth/dang_nhap');
    }
    public function login() {
        $user = NguoiDungModel::login(
            $_POST['ten_dang_nhap'],
            $_POST['mat_khau']
        );
        if ($user) {
            $_SESSION['user'] = $user;
            switch ($user['vai_tro']) {
                case 'admin':
                    $this->redirect('admin&action=index');
                    break;
                case 'gv':
                    $this->redirect('giaovien&action=index');
                    break;
                default:
                    $this->redirect('sinhvien&action=index');
            }
        }
    $this->view('auth/dang_nhap', [
        'error' => 'Sai tài khoản hoặc mật khẩu'
    ]);
}

    public function logout() {
        session_destroy();
        $this->redirect('/auth');
    }
}
