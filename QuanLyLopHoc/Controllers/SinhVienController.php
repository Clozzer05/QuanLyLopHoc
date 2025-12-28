<?php
require_once __DIR__ . '/../models/DangKyModel.php';
require_once __DIR__ . '/../models/BaiTapModel.php';
require_once __DIR__ . '/../models/BaiNopModel.php';
require_once __DIR__ . '/../core/Controller.php';

class SinhVienController extends Controller {

    public function index() {
        $idSV = $_SESSION['user']['id'];
        $lopHoc = DangKyModel::getLopBySinhVien($idSV);
        $this->view('sinhvien/trang_chu', compact('lopHoc'));
    }

    public function baitap($idLop) {
        $baiTap = BaiTapModel::getByLop($idLop);
        $this->view('sinhvien/bai_tap', compact('baiTap'));
    }

    public function nopbai() {
        BaiNopModel::nopBai($_POST);
        $this->redirect('/sinhvien');
    }
    
    public function thongBao() {
    $tbDAO = new ThongBaoDAO();
    $thongBao = $tbDAO->getForSinhVien($_SESSION['user']['id']);

    $this->view('sv/thong_bao', [
        'thongBao' => $thongBao
    ]);

}
