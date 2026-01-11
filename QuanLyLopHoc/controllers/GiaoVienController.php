<?php
require_once __DIR__ . '/../services/LopHocService.php';
require_once __DIR__ . '/../services/BaiTapService.php';
require_once __DIR__ . '/../services/ThongBaoService.php';
require_once __DIR__ . '/../services/DiemDanhService.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../services/TaiLieuService.php';
require_once __DIR__ . '/../services/DangKyService.php';

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

        $baiTap = $baiTapService->getByLop($idLop);
        $lop = $lopHocService->getById($idLop);

        $this->view('gv/bai_tap', [
            'baiTap' => $baiTap,
            'lop' => $lop,
            'idLop' => $idLop
        ]);
    }

    public function addBaiTap() {
        $service = new BaiTapService();
        $service->taoBaiTap($_POST);
        header("Location: index.php?controller=giaovien&action=baitap&id_lop=" . $_POST['id_lop']);
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

            $diemDanhService = new DiemDanhService();

            foreach ($dsSinhVien as $sv) {
                if (isset($sv['id'])) {
                    $data = [
                        'id_lop' => $idLop,
                        'id_sinh_vien' => $sv['id'],
                        'ngay_diem_danh' => $ngay,
                        'trang_thai' => isset($sv['vang']) ? 'Vắng' : 'Hiện diện'
                    ];
                    $diemDanhService->taoDiemDanh($data);
                }
            }
            header("Location: index.php?controller=giaovien&action=index");
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
        $service = new ThongBaoService();
        $thongBao = $service->getByLop($idLop);

        $this->view('gv/thong_bao', [
            'thongBao' => $thongBao,
            'idLop' => $idLop
        ]);
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
        $file = $_FILES['file_tai_lieu'];

        $targetDir = "public/uploads/tai_lieu/";
        if (!file_exists($targetDir)) {
            mkdir($targetDir, 0777, true);
        }

        $fileName = time() . '_' . basename($file["name"]);
        $targetFilePath = $targetDir . $fileName;

        if (move_uploaded_file($file["tmp_name"], $targetFilePath)) {
            $taiLieuService = new TaiLieuService();
            
            $data = [
                'id_lop'    => $idLop,
                'tieu_de'   => $tenHienThi,
                'file_path' => $fileName
            ];
            
            $taiLieuService->taoTaiLieu($data);
        }

        header("Location: index.php?controller=giaovien&action=tailieu&id_lop=" . $idLop);
    }
    }
}