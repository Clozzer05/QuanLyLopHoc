<?php
require_once __DIR__ . '/../services/MonHocService.php';
require_once __DIR__ . '/../services/LopHocService.php';
require_once __DIR__ . '/../services/NguoiDungService.php';
require_once __DIR__ . '/../services/TaiLieuService.php';
require_once __DIR__ . '/../services/ThongBaoService.php';
require_once __DIR__ . '/../core/Controller.php';

class AdminController extends Controller {
    public function index() {
        $nguoiDungService = new NguoiDungService();
        $lopHocService = new LopHocService();

        $soHocSinh = $nguoiDungService->countHocSinh();
        $soGiaoVien = $nguoiDungService->countGiaoVien();
        $soLopHoc = $lopHocService->countLopHoc();

        $this->view('admin/trang_chu', compact('soHocSinh', 'soGiaoVien', 'soLopHoc'));
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
            if ($service->isDuplicateTenMon($_POST['ten_mon'])) {
                $this->redirect('admin&action=monhoc&error=duplicate');
                return;
            }
            $service->create($_POST);
            $this->redirect('admin&action=monhoc');
        } else {
            $this->redirect('admin&action=monhoc');
        }
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
            if ($service->isDuplicateTenLop($_POST['ten_lop'])) {
                $this->redirect('admin&action=lophoc&error=duplicate');
                return;
            }
            $service->create($_POST);
            $this->redirect('admin&action=lophoc');
        } else {
            $this->redirect('admin&action=lophoc');
        }
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
            if ($service->isDuplicateTenDangNhap($_POST['ten_dang_nhap'])) {
                $this->redirect('admin&action=nguoidung&error=duplicate');
                return;
            }
            $service->create($_POST);
            $this->redirect('admin&action=nguoidung');
        } else {
            $this->redirect('admin&action=nguoidung');
        }
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
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $service = new TaiLieuService();
            $idLop = !empty($_POST['id_lop']) ? $_POST['id_lop'] : null;
            $tieuDe = $_POST['tieu_de'];
            $userId = $_SESSION['user']->id ?? 0;
            $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/QuanLyLopHoc/public/uploads/tai_lieu/';
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }
            $duongDanFileDb = '';

            if (isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] == 0) {
                $file = $_FILES['file_upload'];
                $fileExtension = pathinfo($file["name"], PATHINFO_EXTENSION);
                $cleanFileName = time() . '_' . preg_replace('/[^A-Za-z0-9]/', '', pathinfo($file["name"], PATHINFO_FILENAME)) . '.' . $fileExtension;
                $targetFilePath = $targetDir . $cleanFileName;

                if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                    $duongDanFileDb = $cleanFileName;
                } else {
                    echo "Lỗi: Không thể lưu file.";
                    exit;
                }
            }

            $data = [
                'tieu_de' => $tieuDe,
                'duong_dan_file' => $duongDanFileDb,
                'id_lop' => $idLop,
                'nguoi_upload' => $userId
            ];
            $service->create($data, $userId);
            $this->redirect('admin&action=tailieu');
        }
    }

    public function updateTaiLieu() {
        $id = $_GET['id'] ?? null;
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && $id) {
            $service = new TaiLieuService();
            $userId = $_SESSION['user']->id ?? 0;
            $duongDanFileDb = $_POST['old_file'] ?? '';

            if (isset($_FILES['file_upload']) && $_FILES['file_upload']['error'] == 0) {
                $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/QuanLyLopHoc/public/uploads/tai_lieu/';
                if (!file_exists($targetDir)) mkdir($targetDir, 0777, true);

                $file = $_FILES['file_upload'];
                $fileExtension = pathinfo($file["name"], PATHINFO_EXTENSION);
                $cleanFileName = time() . '_' . preg_replace('/[^A-Za-z0-9]/', '', pathinfo($file["name"], PATHINFO_FILENAME)) . '.' . $fileExtension;
                $targetFilePath = $targetDir . $cleanFileName;

                if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                    $duongDanFileDb = $cleanFileName;
                }
            }

            $idLop = !empty($_POST['id_lop']) ? $_POST['id_lop'] : null;

            $data = [
                'tieu_de' => $_POST['tieu_de'],
                'duong_dan_file' => $duongDanFileDb,
                'id_lop' => $idLop
            ];

            $service->update($id, $data);
            $this->redirect('admin&action=tailieu');
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
        $lopService = new LopHocService();
        $thongBao = $service->getAll();
        $editingThongBao = isset($_GET['edit_id']) ? $service->getById($_GET['edit_id']) : null;
        $lopHoc = $lopService->getAll();
        $this->view('admin/thong_bao', compact('thongBao', 'editingThongBao', 'lopHoc'));
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