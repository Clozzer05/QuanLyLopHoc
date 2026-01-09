<?php
require_once __DIR__ . '/../services/MonHocService.php';
require_once __DIR__ . '/../services/LopHocService.php';
require_once __DIR__ . '/../services/NguoiDungService.php';
require_once __DIR__ . '/../services/TaiLieuService.php';
require_once __DIR__ . '/../services/ThongBaoService.php';
require_once __DIR__ . '/../core/Controller.php';

class AdminController extends Controller {
    public function index() {
        $this->view('admin/trang_chu');
    }
    public function monhoc() {
        $service = new MonHocService();
        $monHoc = $service->getAll();
        $editingMonHoc = isset($_GET['edit_id']) ? $service->getById($_GET['edit_id']) : null;
        $this->view('admin/mon_hoc', compact('monHoc', 'editingMonHoc'));
    }
    public function addMonHoc() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $service = new MonHocService();
            $service->create($_POST);
        }
        $this->redirect('admin&action=monhoc');
    }
    public function updateMonHoc() {
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
            $service = new MonHocService();
            $service->update($id, $_POST);
        }
        $this->redirect('admin&action=monhoc');
    }
    public function deleteMonHoc() {
        if (isset($_GET['id'])) {
            $service = new MonHocService();
            $service->delete($_GET['id']);
        }
        $this->redirect('admin&action=monhoc');
    }

    public function lophoc() {
        $lopService = new LopHocService();
        $monService = new MonHocService();
        $userService = new NguoiDungService();
        $lopHoc = $lopService->getAll();
        $monHoc = $monService->getAll();
        if (method_exists($userService, 'getGiaoVien')) {
            $giaoVien = $userService->getGiaoVien();
        } else {
            $giaoVien = $userService->getAll();
        }
        $editingLopHoc = isset($_GET['edit_id']) ? $lopService->getById($_GET['edit_id']) : null;
        $this->view('admin/lop_hoc', compact('lopHoc', 'monHoc', 'giaoVien', 'editingLopHoc'));
    }
    public function addLopHoc() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $service = new LopHocService();
            $service->create($_POST);
        }
        $this->redirect('admin&action=lophoc');
    }
    public function updateLopHoc() {
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
            $service = new LopHocService();
            $service->update($id, $_POST);
        }
        $this->redirect('admin&action=lophoc');
    }
    public function deleteLopHoc() {
        if (isset($_GET['id'])) {
            $service = new LopHocService();
            $service->delete($_GET['id']);
        }
        $this->redirect('admin&action=lophoc');
    }
    public function nguoidung() {
        $service = new NguoiDungService();
        $nguoiDung = $service->getAll();

        $editingNguoiDung = isset($_GET['edit_id']) ? $service->getById($_GET['edit_id']) : null;

        $this->view('admin/nguoi_dung', compact('nguoiDung', 'editingNguoiDung'));
    }
    public function addNguoiDung() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $service = new NguoiDungService();
            $service->create($_POST);
        }
        $this->redirect('admin&action=nguoidung');
    }
    public function updateNguoiDung() {
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
            $service = new NguoiDungService();
            $service->update($id, $_POST);
        }
        $this->redirect('admin&action=nguoidung');
    }
    public function deleteNguoiDung() {
        if (isset($_GET['id'])) {
            $service = new NguoiDungService();
            $service->delete($_GET['id']);
        }
        $this->redirect('admin&action=nguoidung');
    }

    public function tailieu() {
        $tlService = new TaiLieuService();
        $lopService = new LopHocService();
        $taiLieu = $tlService->getAll();
        $lopHoc = $lopService->getAll();
        $editingTaiLieu = isset($_GET['edit_id']) ? $tlService->getById($_GET['edit_id']) : null;
        $this->view('admin/tai_lieu', compact('taiLieu', 'lopHoc', 'editingTaiLieu'));
    }

    public function addTaiLieu() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $service = new TaiLieuService();
            // SỬA: Dùng ->id thay vì ['id']
            $userId = $_SESSION['user']->id ?? 0;
            $service->create($_POST, $userId);
        }
        $this->redirect('admin&action=tailieu');
    }
    public function updateTaiLieu() {
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
            $service = new TaiLieuService();
            $service->update($id, $_POST);
        }
        $this->redirect('admin&action=tailieu');
    }
    public function deleteTaiLieu() {
        if (isset($_GET['id'])) {
            $service = new TaiLieuService();
            $service->delete($_GET['id']);
        }
        $this->redirect('admin&action=tailieu');
    }

    public function thongbao() {
        $service = new ThongBaoService();
        $thongBao = $service->getAll();
        $editingThongBao = isset($_GET['edit_id']) ? $service->getById($_GET['edit_id']) : null;
        $this->view('admin/thong_bao', compact('thongBao', 'editingThongBao'));
    }

    public function addThongBao() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $service = new ThongBaoService();
            $service->create($_POST);
        }
        $this->redirect('admin&action=thongbao');
    }
    public function updateThongBao() {
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
            $service = new ThongBaoService();
            $service->update($id, $_POST);
        }
        $this->redirect('admin&action=thongbao');
    }
    public function deleteThongBao() {
        if (isset($_GET['id'])) {
            $service = new ThongBaoService();
            $service->delete($_GET['id']);
        }
        $this->redirect('admin&action=thongbao');
    }
}