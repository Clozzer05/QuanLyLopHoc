<?php
// Import tất cả Model và DAO cần thiết
require_once __DIR__ . '/../models/MonHocModel.php';
require_once __DIR__ . '/../models/LopHocModel.php';
require_once __DIR__ . '/../models/NguoiDungModel.php';
require_once __DIR__ . '/../dao/MonHocDAO.php';
require_once __DIR__ . '/../dao/LopHocDAO.php';
require_once __DIR__ . '/../dao/NguoiDungDAO.php';
require_once __DIR__ . '/../dao/TaiLieuDAO.php';
require_once __DIR__ . '/../core/Controller.php';

class AdminController extends Controller {

    public function index() {
        $this->view('admin/trang_chu');
    }

    // ========================================================
    // 1. QUẢN LÝ MÔN HỌC (Full: Xem, Thêm, Sửa, Xóa)
    // ========================================================
    public function monhoc() {
        $monHoc = MonHocModel::getAll();
        
        // Logic cho chức năng Sửa: Lấy thông tin môn đang chọn
        $editingMonHoc = null;
        if (isset($_GET['edit_id'])) {
            $dao = new MonHocDAO();
            $editingMonHoc = $dao->findById($_GET['edit_id']);
        }

        $this->view('admin/mon_hoc', [
            'monHoc' => $monHoc,
            'editingMonHoc' => $editingMonHoc
        ]);
    }

    public function addMonHoc() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dao = new MonHocDAO();
            $dao->insert($_POST);
        }
        $this->redirect('admin&action=monhoc');
    }

    public function updateMonHoc() {
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
            $dao = new MonHocDAO();
            $dao->update($id, [
                'ten_mon' => $_POST['ten_mon'],
                'so_tin_chi' => $_POST['so_tin_chi']
            ]);
        }
        $this->redirect('admin&action=monhoc');
    }

    public function deleteMonHoc() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $dao = new MonHocDAO();
            $dao->delete($id);
        }
        $this->redirect('admin&action=monhoc');
    }

    // ========================================================
    // 2. QUẢN LÝ LỚP HỌC (Full: Xem, Thêm, Sửa, Xóa)
    // ========================================================
    public function lophoc() {
        $lopHoc = LopHocModel::getAll();
        $monHoc = MonHocModel::getAll();
        $giaoVien = NguoiDungModel::getGiaoVien();

        // Logic cho chức năng Sửa
        $editingLopHoc = null;
        if (isset($_GET['edit_id'])) {
            $dao = new LopHocDAO();
            $editingLopHoc = $dao->findById($_GET['edit_id']);
        }

        $this->view('admin/lop_hoc', [
            'lopHoc' => $lopHoc,
            'monHoc' => $monHoc,
            'giaoVien' => $giaoVien,
            'editingLopHoc' => $editingLopHoc
        ]);
    }

    public function addLopHoc() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dao = new LopHocDAO();
            $dao->insert($_POST);
        }
        $this->redirect('admin&action=lophoc');
    }

    public function updateLopHoc() {
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
            $dao = new LopHocDAO();
            $dao->update($id, [
                'ten_lop' => $_POST['ten_lop'],
                'id_mon_hoc' => $_POST['id_mon_hoc'],
                'id_giao_vien' => $_POST['id_giao_vien']
            ]);
        }
        $this->redirect('admin&action=lophoc');
    }

    public function deleteLopHoc() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $dao = new LopHocDAO();
            $dao->delete($id);
        }
        $this->redirect('admin&action=lophoc');
    }

    // ========================================================
    // 3. QUẢN LÝ NGƯỜI DÙNG (Full: Xem, Thêm, Sửa, Xóa)
    // ========================================================
    public function nguoidung() {
        $dao = new NguoiDungDAO();
        $nguoiDung = $dao->findAll();

        // Logic cho chức năng Sửa
        $editingNguoiDung = null;
        if (isset($_GET['edit_id'])) {
            $editingNguoiDung = $dao->findById($_GET['edit_id']);
        }

        $this->view('admin/nguoi_dung', [
            'nguoiDung' => $nguoiDung,
            'editingNguoiDung' => $editingNguoiDung
        ]);
    }

    public function addNguoiDung() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $dao = new NguoiDungDAO();
            $dao->insert($_POST);
        }
        $this->redirect('admin&action=nguoidung');
    }

    public function updateNguoiDung() {
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
            $dao = new NguoiDungDAO();
            
            // Nếu không nhập mật khẩu mới thì giữ nguyên mật khẩu cũ
            $oldUser = $dao->findById($id);
            $newPass = !empty($_POST['mat_khau']) ? $_POST['mat_khau'] : $oldUser['mat_khau'];

            $dao->update($id, [
                'ten_dang_nhap' => $_POST['ten_dang_nhap'],
                'mat_khau' => $newPass,
                'ho_ten' => $_POST['ho_ten'],
                'vai_tro' => $_POST['vai_tro']
            ]);
        }
        $this->redirect('admin&action=nguoidung');
    }

    public function deleteNguoiDung() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $dao = new NguoiDungDAO();
            $dao->delete($id);
        }
        $this->redirect('admin&action=nguoidung');
    }

    // ========================================================
    // 4. QUẢN LÝ TÀI LIỆU (Full: Xem, Thêm, Sửa, Xóa)
    // ========================================================
    public function tailieu() {
        $dao = new TaiLieuDAO();
        $taiLieu = $dao->findAll();
        $lopHoc = LopHocModel::getAll(); // Lấy danh sách lớp để chọn khi upload

        // Logic cho chức năng Sửa
        $editingTaiLieu = null;
        if (isset($_GET['edit_id'])) {
            $editingTaiLieu = $dao->findById($_GET['edit_id']);
        }

        $this->view('admin/tai_lieu', [
            'taiLieu' => $taiLieu,
            'lopHoc' => $lopHoc,
            'editingTaiLieu' => $editingTaiLieu
        ]);
    }

    public function addTaiLieu() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             $dao = new TaiLieuDAO();
             $dao->insert([
                'tieu_de' => $_POST['tieu_de'],
                'duong_dan_file' => $_POST['duong_dan_file'],
                'nguoi_upload' => $_SESSION['user']['id'], // Lấy ID của Admin đang đăng nhập
                'id_lop' => $_POST['id_lop']
             ]);
        }
        $this->redirect('admin&action=tailieu');
    }

    public function updateTaiLieu() {
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
            $dao = new TaiLieuDAO();
            $dao->update($id, [
                'tieu_de' => $_POST['tieu_de'],
                'duong_dan_file' => $_POST['duong_dan_file'],
                'id_lop' => $_POST['id_lop']
            ]);
        }
        $this->redirect('admin&action=tailieu');
    }

    public function deleteTaiLieu() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $dao = new TaiLieuDAO();
            $dao->delete($id);
        }
        $this->redirect('admin&action=tailieu');
    }
}