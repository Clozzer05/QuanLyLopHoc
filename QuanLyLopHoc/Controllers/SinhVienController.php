<?php
require_once __DIR__ . '/../models/NguoiDungModel.php';
require_once __DIR__ . '/../services/DangKyService.php';
require_once __DIR__ . '/../services/BaiTapService.php';
require_once __DIR__ . '/../services/BaiNopService.php';
require_once __DIR__ . '/../services/ThongBaoService.php';
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
        $service = new BaiNopService();
        $fileLink = $_POST['link_bai_nop'] ?? '';

        $service->nopBai($_POST['id_bai_tap'], $_SESSION['user']->id, $fileLink);

        $this->redirect('sv');
    }

    public function thongBao() {
        $service = new ThongBaoService();
        $thongBao = $service->getForSinhVien($_SESSION['user']->id);

        $this->view('sv/thong_bao', [
            'thongBao' => $thongBao
        ]);
    }
}