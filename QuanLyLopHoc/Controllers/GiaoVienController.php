<?php
require_once __DIR__ . '/../models/LopHocModel.php';
require_once __DIR__ . '/../models/BaiTapModel.php';
require_once __DIR__ . '/../models/ThongBaoModel.php';
require_once __DIR__ . '/../models/DiemDanhModel.php';
require_once __DIR__ . '/../core/Controller.php';

class GiaoVienController extends Controller {

    public function index() {
        $idGV = $_SESSION['user']['id'];
        $lopHoc = LopHocModel::getByGiaoVien($idGV);
        $this->view('giaovien/lop_hoc', compact('lopHoc'));
    }

    public function baitap($idLop) {
        $baiTap = BaiTapModel::getByLop($idLop);
        $this->view('giaovien/bai_tap', compact('baiTap'));
    }

    public function addBaiTap() {
        BaiTapModel::create($_POST);
        $this->redirect('/giaovien');
    }

    public function thongbao() {
        ThongBaoModel::create($_POST);
        $this->redirect('/giaovien');
    }

    public function diemdanh() {
        DiemDanhModel::diemDanh($_POST);
        $this->redirect('/giaovien');
    }
    
    public function thongBao($idLop) {
    $tbDAO = new ThongBaoDAO();

    $thongBao = $tbDAO->getByLop($idLop);

    $this->view('gv/thong_bao', [
        'thongBao' => $thongBao,
        'idLop' => $idLop
    ]);
    }

public function addThongBao() {
    (new ThongBaoDAO())->insert([
        'tieu_de' => $_POST['tieu_de'],
        'noi_dung' => $_POST['noi_dung'],
        'nguoi_gui' => $_SESSION['user']['id'],
        'id_lop' => $_POST['id_lop']
    ]);

    header('Location: /giaovien/thongbao/' . $_POST['id_lop']);
    }
}
