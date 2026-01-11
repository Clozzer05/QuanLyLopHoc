<?php
require_once __DIR__ . '/../models/NguoiDungModel.php';
require_once __DIR__ . '/../services/DangKyService.php';
require_once __DIR__ . '/../services/BaiTapService.php';
require_once __DIR__ . '/../services/BaiNopService.php';
require_once __DIR__ . '/../services/ThongBaoService.php';
require_once __DIR__ . '/../services/TaiLieuService.php';
require_once __DIR__ . '/../core/Controller.php';

class SinhVienController extends Controller {

    public function index() {
        $idSV = $_SESSION['user']->id;

        $service = new DangKyService();
        $lopHoc = $service->getLopDaDangKy($idSV);

        $this->view('sv/trang_chu', compact('lopHoc'));
    }

    public function baitap() {
        $idLop = $_GET['id_lop'] ?? 0;
        $service = new BaiTapService();
        $baiTap = $service->getBaiTapCuaLop($idLop);

        $this->view('sv/bai_tap', compact('baiTap', 'idLop'));
    }

    public function nopbai() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_FILES['file'])) {
            $idBaiTap = $_POST['id_bai_tap'];
            $idSV = $_SESSION['user']->id;
            $uploadDir = __DIR__ . '/../../public/uploads/bai_nop/';

            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            $fileName = time() . '_' . basename($_FILES['file']['name']);
            $targetFilePath = $uploadDir . $fileName;

            if (move_uploaded_file($_FILES['file']['tmp_name'], $targetFilePath)) {
                $service = new BaiNopService();
                $service->nopBai($idBaiTap, $idSV, $fileName);
                header('Location: index.php?controller=sinhvien&action=index');
                exit();
            } else {
                die("Lỗi upload file.");
            }
        }
    }

    public function chiTietLop() {
        $idLop = $_GET['id'] ?? 0;
        $idSV = $_SESSION['user']->id;

        $dangKyService = new DangKyService();
        $taiLieuService = new TaiLieuService();
        $thongBaoService = new ThongBaoService();
        $baiTapService = new BaiTapService();
        $baiNopService = new BaiNopService();

        $lop = $dangKyService->getThongTinLop($idLop);
        $ketQua = $dangKyService->getKetQuaHocTap($idSV, $idLop);
        $taiLieu = $taiLieuService->getByLop($idLop);
        $thongBao = $thongBaoService->getForSinhVienByLop($idLop);
        $dsBaiTap = $baiTapService->getByLop($idLop);

        if (!empty($dsBaiTap)) {
            foreach ($dsBaiTap as $bt) {
                $bt->bai_nop = $baiNopService->getBaiNopCuaSinhVien($idSV, $bt->id);
            }
        }
        $this->view('sv/chi_tiet_lop', compact('lop', 'ketQua', 'taiLieu', 'thongBao', 'dsBaiTap'));
    }
    
public function dangky() {
    $idSV = $_SESSION['user']->id;
    $service = new DangKyService();
    $lopMo = $service->getLopMo($idSV);
    $this->view('sv/dang_ky', compact('lopMo'));
}

public function thucHienDangKy() {
    $idLop = $_GET['id_lop'] ?? 0;
    $idSV = $_SESSION['user']->id;
    if ($idLop > 0) {
        $service = new DangKyService();
        $service->dangKyMoi($idSV, $idLop);
        header('Location: index.php?controller=sinhvien&action=index');
        exit();
    }
    die("Lỗi đăng ký");
}

    public function thongBao() {
        $service = new ThongBaoService();
        $thongBao = $service->getForSinhVien($_SESSION['user']->id);

        $this->view('sv/thong_bao', [
            'thongBao' => $thongBao
        ]);
    }
}