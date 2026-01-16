<?php
require_once __DIR__ . '/../services/LopHocService.php';
require_once __DIR__ . '/../services/BaiTapService.php';
require_once __DIR__ . '/../services/ThongBaoService.php';
require_once __DIR__ . '/../services/DiemDanhService.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../services/TaiLieuService.php';
require_once __DIR__ . '/../services/DangKyService.php';
require_once __DIR__ . '/../services/BaiNopService.php';
require_once __DIR__ . '/../dao/DiemDanhDAO.php';
require_once __DIR__ . '/../dao/DangKyDAO.php';

class GiaoVienController extends Controller {

    public function index() {
        $idGV = $_SESSION['user']->id;
        $service = new LopHocService();
        $lopHoc = $service->getByGiaoVien($idGV);
        $this->view('gv/trang_chu', compact('lopHoc'));
    }

    public function baitap() {
        $idLop = $_GET['id_lop'] ?? 0;
        $baiTapService = new BaiTapService();
        $lopHocService = new LopHocService();
        $taiLieuService = new TaiLieuService();

        $baiTap = $baiTapService->getByLop($idLop);
        $lop = $lopHocService->getById($idLop);
        $taiLieu = $taiLieuService->getByLop($idLop);

        $this->view('gv/bai_tap', [
            'baiTap' => $baiTap,
            'lop' => $lop,
            'idLop' => $idLop,
            'taiLieu' => $taiLieu
        ]);
    }

    public function addBaiTap() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idLop = $_POST['id_lop'];
            $fileDeBai = '';

            if (isset($_FILES['file_de_bai']) && $_FILES['file_de_bai']['error'] == 0) {
                $projectRoot = $_SERVER['DOCUMENT_ROOT'] . '/QuanLyLopHoc/'; 
                $targetDir = $projectRoot . "public/uploads/bai_tap/";

                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                $originalName = basename($_FILES['file_de_bai']['name']);
                $cleanName = time() . '_' . preg_replace('/[^A-Za-z0-9._-]/', '', $originalName);
                $targetFilePath = $targetDir . $cleanName;

                if (move_uploaded_file($_FILES['file_de_bai']['tmp_name'], $targetFilePath)) {
                    $fileDeBai = $cleanName;
                }
            }

            $data = [
                'id_lop' => $idLop,
                'tieu_de' => $_POST['tieu_de'],
                'mo_ta' => $_POST['mo_ta'] ?? '',
                'han_nop' => $_POST['han_nop'],
                'file_de_bai' => $fileDeBai
            ];

            $service = new BaiTapService();
            $service->taoBaiTap($data);
            
            header("Location: index.php?controller=giaovien&action=baitap&id_lop=" . $idLop);
            exit();
        }
    }

    public function deleteBaiTap() {
        if (isset($_GET['id'])) {
            $service = new BaiTapService();
            $baiTap = $service->getById($_GET['id']);
            
            if ($baiTap && !empty($baiTap->file_de_bai)) {
                $filePath = __DIR__ . '/../../public/uploads/bai_tap/' . $baiTap->file_de_bai;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            $service->delete($_GET['id']);
        }
        $idLop = $_GET['id_lop'] ?? 0;
        header("Location: index.php?controller=giaovien&action=baitap&id_lop=" . $idLop);
        exit();
    }

    public function diemdanh() {
        $idLop = $_GET['id_lop'] ?? 0;
        $searchTerm = $_GET['search'] ?? '';
        
        $lopHocService = new LopHocService();
        $dangKyDAO = new DangKyDAO();
        
        $lop = $lopHocService->getById($idLop);
        $sinhVien = $dangKyDAO->getSinhVienByLop($idLop, $searchTerm);

        $this->view('gv/diem_danh', [
            'idLop' => $idLop,
            'lop' => $lop,
            'sinhVien' => $sinhVien,
            'searchTerm' => $searchTerm
        ]);
    }

    public function xemLichSuDiemDanh() {
        $idLop = $_GET['id_lop'] ?? 0;
        $ngay = $_GET['ngay_xem'] ?? ''; 
        $searchTerm = $_GET['search'] ?? '';
        
        $diemDanhDAO = new DiemDanhDAO();
        $lopHocService = new LopHocService();
        
        $lop = $lopHocService->getById($idLop);
        
        // Lấy danh sách các ngày đã điểm danh
        $danhSachNgay = $diemDanhDAO->getDanhSachNgayDiemDanh($idLop);
        
        // Lấy lịch sử điểm danh theo ngày đã chọn
        $lichSu = [];
        if (!empty($ngay)) {
            $lichSu = $diemDanhDAO->getLichSuDiemDanh($idLop, $ngay, $searchTerm);
        }
        
        $this->view('gv/lich_su_diem_danh', [
            'idLop' => $idLop,
            'lop' => $lop,
            'lichSu' => $lichSu,
            'ngayXem' => $ngay,
            'danhSachNgay' => $danhSachNgay,
            'searchTerm' => $searchTerm
        ]);
    }

    public function saveDiemDanh() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idLop = $_POST['id_lop'];
            $ngay = $_POST['ngay_diem_danh'];
            $dsSinhVien = $_POST['sv'] ?? [];

            if (empty($dsSinhVien)) {
                $_SESSION['error'] = "Không có sinh viên nào để điểm danh!";
                header("Location: index.php?controller=giaovien&action=diemdanh&id_lop=" . $idLop);
                exit();
            }

            $diemDanhDAO = new DiemDanhDAO();
            $diemDanhService = new DiemDanhService();
            
            // Xóa điểm danh cũ của ngày này (nếu có) để tránh trùng lặp
            $diemDanhDAO->xoaDiemDanhTheoNgay($idLop, $ngay);
            
            // Lưu điểm danh mới
            foreach ($dsSinhVien as $sv) {
                if (isset($sv['id']) && isset($sv['trang_thai'])) {
                    $data = [
                        'id_lop' => $idLop,
                        'id_sinh_vien' => $sv['id'],
                        'ngay_diem_danh' => $ngay,
                        'trang_thai' => $sv['trang_thai']
                    ];
                    $diemDanhService->taoDiemDanh($data);
                }
            }
            
            $_SESSION['success'] = "Đã lưu điểm danh thành công!";
            header("Location: index.php?controller=giaovien&action=diemdanh&id_lop=" . $idLop);
            exit();
        }
    }

    public function updateDiemDanh() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idDiemDanh = $_POST['id_diem_danh'];
            $trangThai = $_POST['trang_thai'];
            $ghiChu = $_POST['ghi_chu'] ?? '';
            $idLop = $_POST['id_lop'];
            $ngayXem = $_POST['ngay_xem'];
            $searchTerm = $_POST['search'] ?? '';

            $diemDanhService = new DiemDanhService();
            $result = $diemDanhService->updateDiemDanh($idDiemDanh, $trangThai, $ghiChu);
            
            if ($result) {
                $_SESSION['success'] = "Đã cập nhật điểm danh thành công!";
            } else {
                $_SESSION['error'] = "Không thể cập nhật điểm danh!";
            }
            
            $url = "Location: index.php?controller=giaovien&action=xemLichSuDiemDanh&id_lop=" . $idLop . "&ngay_xem=" . $ngayXem;
            if (!empty($searchTerm)) {
                $url .= "&search=" . urlencode($searchTerm);
            }
            header($url);
            exit();
        }
    }

    public function chitietlop() {
        $idLop = $_GET['id'] ?? 0;
        $lopService = new LopHocService();
        $dangKyService = new DangKyService();
        $lop = $lopService->getById($idLop);
        $sinhVien = $dangKyService->getSinhVienTheoLop($idLop);
        
        $this->view('gv/chi_tiet_lop', [
            'lop' => $lop,
            'sinhVien' => $sinhVien
        ]);
    }

    public function thongbao() {
        $idLop = $_GET['id_lop'] ?? 0;
        $lopService = new LopHocService();
        $service = new ThongBaoService();
        
        $lop = $lopService->getById($idLop);
        $thongBao = $service->getByLop($idLop);

        $this->view('gv/thong_bao', [
            'thongBao' => $thongBao,
            'lop' => $lop,
            'idLop' => $idLop
        ]);
    }

    public function addThongBao() {
        $service = new ThongBaoService();
        $data = [
            'tieu_de' => $_POST['tieu_de'],
            'noi_dung' => $_POST['noi_dung'],
            'nguoi_gui' => $_SESSION['user']->id,
            'id_lop' => $_POST['id_lop']
        ];
        $service->create($data);
        header("Location: index.php?controller=giaovien&action=thongbao&id_lop=" . $_POST['id_lop']);
    }

    public function deleteThongBao() {
        if (isset($_GET['id'])) {
            $service = new ThongBaoService();
            $service->delete($_GET['id']);
        }
        $idLop = $_GET['id_lop'] ?? 0;
        header("Location: index.php?controller=giaovien&action=thongbao&id_lop=" . $idLop);
    }

    public function viewNopBai() {
        $idBT = $_GET['id'] ?? 0;
        $baiTapService = new BaiTapService();
        $baiTap = $baiTapService->getById($idBT);
        $danhSachNop = $baiTapService->getDanhSachNopBai($idBT); 

        $this->view('gv/view_nop_bai', [
            'baiTap' => $baiTap,
            'danhSachNop' => $danhSachNop
        ]);
    }

    public function capNhatDiem() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idLop = $_POST['id_lop'];
            $danhSachDiem = $_POST['diem'] ?? [];
            $service = new DangKyService();
            foreach ($danhSachDiem as $idSV => $diem) {
                $diemGK = $diem['giua_ky'];
                $diemCK = $diem['cuoi_ky'];
                $service->capNhatDiemSo($idLop, $idSV, $diemGK, $diemCK);
            }
            $_SESSION['success'] = "Đã cập nhật điểm thành công!";
            header("Location: index.php?controller=giaovien&action=chitietlop&id=" . $idLop);
            exit();
        }
    }

    public function saveDiem() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idBaiNop = $_POST['id_bai_nop'];
            $diem = $_POST['diem'];
            $nhanXet = $_POST['nhan_xet'] ?? '';
            $idBaiTap = $_POST['id_bai_tap'];

            $service = new BaiNopService();
            $service->chamDiem($idBaiNop, $diem, $nhanXet);
            header("Location: index.php?controller=giaovien&action=viewNopBai&id=" . $idBaiTap);
            exit();
        }
    }

    public function tailieu() {
        $idLop = $_GET['id_lop'] ?? 0;
        $taiLieuService = new TaiLieuService();
        $lopHocService = new LopHocService();
        
        $taiLieu = $taiLieuService->getByLop($idLop);
        $lop = $lopHocService->getById($idLop);

        $this->view('gv/tai_lieu', [
            'taiLieu' => $taiLieu,
            'lop' => $lop,
            'idLop' => $idLop
        ]);
    }

    public function addTaiLieu() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $idLop = $_POST['id_lop'];
            $tenHienThi = $_POST['ten_tai_lieu'];
            
            if (!isset($_FILES['file_tai_lieu']) || $_FILES['file_tai_lieu']['error'] != 0) {
                header("Location: index.php?controller=giaovien&action=tailieu&id_lop=" . $idLop);
                exit();
            }
            
            $file = $_FILES['file_tai_lieu'];
            $targetDir = $_SERVER['DOCUMENT_ROOT'] . '/QuanLyLopHoc/public/uploads/tai_lieu/';
            
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            $fileExtension = pathinfo($file["name"], PATHINFO_EXTENSION);
            $cleanFileName = time() . '_' . preg_replace('/[^A-Za-z0-9]/', '', pathinfo($file["name"], PATHINFO_FILENAME)) . '.' . $fileExtension;
            $targetFilePath = $targetDir . $cleanFileName;

            if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                $taiLieuService = new TaiLieuService();
                $userId = $_SESSION['user']->id;
                
                $data = [
                    'tieu_de' => $tenHienThi,
                    'duong_dan_file' => $cleanFileName,
                    'nguoi_upload' => $userId,
                    'id_lop' => $idLop
                ];
                
                $taiLieuService->create($data, $userId);
            }

            header("Location: index.php?controller=giaovien&action=tailieu&id_lop=" . $idLop);
            exit();
        }
    }

    public function deleteTaiLieu() {
        if (isset($_GET['id'])) {
            $idTaiLieu = $_GET['id'];
            $taiLieuService = new TaiLieuService();
            
            $taiLieu = $taiLieuService->getById($idTaiLieu);
            
            if ($taiLieu) {
                $fileName = $taiLieu->duong_dan_file ?? $taiLieu->file_path ?? '';
                if (!empty($fileName)) {
                    $filePath = $_SERVER['DOCUMENT_ROOT'] . '/QuanLyLopHoc/public/uploads/tai_lieu/' . $fileName;
                    if (file_exists($filePath)) {
                        unlink($filePath);
                    }
                }
                $taiLieuService->delete($idTaiLieu);
                $_SESSION['success'] = "Đã xóa tài liệu thành công!";
            }
        }
        
        $idLop = $_GET['id_lop'] ?? 0;
        header("Location: index.php?controller=giaovien&action=tailieu&id_lop=" . $idLop);
        exit();
    }
}