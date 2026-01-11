<?php
require_once __DIR__ . '/../dao/DangKyDAO.php';
class DangKyService {
    private $dao;
    public function __construct() {
        $this->dao = new DangKyDAO();
    }
    public function getLopDaDangKy($idSV) {
        return $this->dao->getLopBySinhVien($idSV);
    }
    public function getThongTinLop($idLop) {
        return $this->dao->getThongTinLop($idLop);
    }
    public function getKetQuaHocTap($idSV, $idLop) {
        return $this->dao->getKetQua($idSV, $idLop);
    }
    public function getLopMo($idSV) {
        return $this->dao->getLopChuaDangKy($idSV);
    }
    public function dangKyMoi($idSV, $idLop) {
        return $this->dao->insert([
            'id_sinh_vien' => $idSV,
            'id_lop' => $idLop,
            'ngay_dang_ky' => date('Y-m-d H:i:s')
        ]);
    }
    public function getSinhVienTheoLop($idLop) {
        return $this->dao->getSinhVienByLop($idLop);
    }
}