<?php
require_once __DIR__ . '/../services/LopHocService.php';
require_once __DIR__ . '/../services/BaiTapService.php';
require_once __DIR__ . '/../services/ThongBaoService.php';
require_once __DIR__ . '/../services/DiemDanhService.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../services/TaiLieuService.php';
require_once __DIR__ . '/../services/DangKyService.php';
require_once __DIR__ . '/../services/BaiNopService.php';

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

            // Xử lý upload file đề bài
            if (isset($_FILES['file_de_bai']) && $_FILES['file_de_bai']['error'] == 0) {
                $targetDir = __DIR__ . "/../../public/uploads/bai_tap/";
                if (!file_exists($targetDir)) {
                    mkdir($targetDir, 0777, true);
                }

                $fileName = time() . '_' . basename($_FILES['file_de_bai']['name']);
                $targetFilePath = $targetDir . $fileName;

                if (move_uploaded_file($_FILES['file_de_bai']['tmp_name'], $targetFilePath)) {
                    $fileDeBai = $fileName;
                }
            }
            // Hoặc sử dụng tài liệu đã có
            elseif (!empty($_POST['tai_lieu_lam_de_bai'])) {
                // Copy file từ thư mục tài liệu sang thư mục bài tập
                $sourceFile = __DIR__ . "/../../public/uploads/tai_lieu/" . $_POST['tai_lieu_lam_de_bai'];
                if (file_exists($sourceFile)) {
                    $targetDir = __DIR__ . "/../../public/uploads/bai_tap/";
                    if (!file_exists($targetDir)) {
                        mkdir($targetDir, 0777, true);
                    }
                    $newFileName = time() . '_' . basename($_POST['tai_lieu_lam_de_bai']);
                    $targetFile = $targetDir . $newFileName;
                    if (copy($sourceFile, $targetFile)) {
                        $fileDeBai = $newFileName;
                    }
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
        }
        
        header("Location: index.php?controller=giaovien&action=baitap&id_lop=" . $idLop);
        exit();
    }

    public function deleteBaiTap() {
        if (isset($_GET['id'])) {
            $service = new BaiTapService();
            
            // Lấy thông tin bài tập trước khi xóa
            $baiTap = $service->getById($_GET['id']);
            
            // Xóa file đề bài nếu có
            if ($baiTap && !empty($baiTap->file_de_bai)) {
                $filePath = __DIR__ . '/../../public/uploads/bai_tap/' . $baiTap->file_de_bai;
                if (file_exists($filePath)) {
                    unlink($filePath);
                }
            }
            
            // Xóa bài tập
            $service->delete($_GET['id']);
        }
        
        $idLop = $_GET['id_lop'] ?? 0;
        header("Location: index.php?controller=giaovien&action=baitap&id_lop=" . $idLop);
        exit();
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
    
    public function diemdanh() {
        $idLop = $_GET['id_lop'] ?? 0;
        
        $lopHocService = new LopHocService();
        $dangKyService = new DangKyService();
        
        $lop = $lopHocService->getById($idLop);
        $sinhVien = $dangKyService->getSinhVienTheoLop($idLop); 

        $this->view('gv/diem_danh', [
            'idLop' => $idLop,
            'lop' => $lop,
            'sinhVien' => $sinhVien
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

            $diemDanhService = new DiemDanhService();
            $count = 0;

            foreach ($dsSinhVien as $sv) {
                if (isset($sv['id']) && isset($sv['trang_thai'])) {
                    $data = [
                        'id_lop' => $idLop,
                        'id_sinh_vien' => $sv['id'],
                        'ngay_diem_danh' => $ngay,
                        'trang_thai' => $sv['trang_thai'],
                        'ghi_chu' => ''
                    ];
                    if ($diemDanhService->taoDiemDanh($data)) {
                        $count++;
                    }
                }
            }
            
            $_SESSION['success'] = "Đã lưu điểm danh cho $count sinh viên vào ngày " . date('d/m/Y', strtotime($ngay));
            header("Location: index.php?controller=giaovien&action=diemdanh&id_lop=" . $idLop);
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
            
            // Kiểm tra file upload
            if (!isset($_FILES['file_tai_lieu']) || $_FILES['file_tai_lieu']['error'] != 0) {
                $_SESSION['error'] = "Vui lòng chọn file để upload!";
                header("Location: index.php?controller=giaovien&action=tailieu&id_lop=" . $idLop);
                exit();
            }
            
            $file = $_FILES['file_tai_lieu'];

            $targetDir = __DIR__ . "/../../public/uploads/tai_lieu/";
            if (!file_exists($targetDir)) {
                mkdir($targetDir, 0777, true);
            }

            // Lấy extension và tạo tên file unique
            $fileExtension = pathinfo($file["name"], PATHINFO_EXTENSION);
            $fileName = time() . '_' . uniqid() . '.' . $fileExtension;
            $targetFilePath = $targetDir . $fileName;

            if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
                $taiLieuService = new TaiLieuService();
                
                $userId = $_SESSION['user']->id;
                
                $data = [
                    'tieu_de' => $tenHienThi,
                    'duong_dan_file' => $fileName,
                    'nguoi_upload' => $userId,
                    'id_lop' => $idLop
                ];
                
                $taiLieuService->create($data, $userId);
                $_SESSION['success'] = "Tải lên tài liệu thành công!";
            } else {
                $_SESSION['error'] = "Lỗi khi upload file!";
            }

            header("Location: index.php?controller=giaovien&action=tailieu&id_lop=" . $idLop);
            exit();
        }
    }
}