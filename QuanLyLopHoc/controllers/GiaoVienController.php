<?php
require_once __DIR__ . '/../services/LopHocService.php';
require_once __DIR__ . '/../services/BaiTapService.php';
require_once __DIR__ . '/../services/ThongBaoService.php';
require_once __DIR__ . '/../services/DiemDanhService.php';
require_once __DIR__ . '/../core/Controller.php';

class GiaoVienController extends Controller {

    public function index() {
        $idGV = $_SESSION['user']->id;
        $service = new LopHocService();
        $lopHoc = $service->getByGiaoVien($idGV);
        $this->view('gv/trang_chu', compact('lopHoc'));
    }

    public function baitap() {
        $idLop = $_GET['id_lop'] ?? 0;
        $service = new BaiTapService();
        $baiTap = $service->getBaiTapCuaLop($idLop);
        $this->view('gv/bai_tap', compact('baiTap', 'idLop'));
    }

    public function addBaiTap() {
        $service = new BaiTapService();
        $service->taoBaiTap($_POST);
        $this->redirect('gv&action=baitap&id_lop=' . $_POST['id_lop']);
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

        $this->redirect('gv&action=thongbao&id_lop=' . $_POST['id_lop']);
    }

    public function diemdanh() {
        $service = new DiemDanhService();
        $service->taoDiemDanh($_POST);
        $this->redirect('gv');
    }

    public function thongBao() {
        $idLop = $_GET['id_lop'] ?? 0;
        $service = new ThongBaoService();
        $thongBao = $service->getByLop($idLop);

        $this->view('gv/thong_bao', [
            'thongBao' => $thongBao,
            'idLop' => $idLop
        ]);
    }
}