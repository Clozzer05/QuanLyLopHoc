<?php
require_once __DIR__ . '/../dao/BaiNopDAO.php';

class BaiNopService {
    private $dao;

    public function __construct() {
        $this->dao = new BaiNopDAO();
    }

    public function getBaiNopCuaBaiTap($idBaiTap) {
        return $this->dao->getByBaiTap($idBaiTap);
    }

    public function nopBai($idBaiTap, $idSinhVien, $fileBaiLam) {
        return $this->dao->insert([
            'id_bai_tap'   => $idBaiTap,
            'id_sinh_vien' => $idSinhVien,
            'file_bai_lam' => $fileBaiLam,
            'ngay_nop'     => date('Y-m-d H:i:s')
        ]);
    }

    public function chamDiem($idBaiNop, $diem, $nhanXet) {
        return $this->dao->update($idBaiNop, [
            'diem'     => $diem,
            'nhan_xet' => $nhanXet
        ]);
    }
}   