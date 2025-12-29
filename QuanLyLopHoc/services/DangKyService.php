<?php
require_once __DIR__ . '/../dao/DangKyDAO.php';
class DangKyService {
    private $dao;
    public function __construct() {
        $this->dao = new DangKyDAO();
    }
    public function dangKyLop($idSinhVien, $idLop) {
        return $this->dao->insert([
            'id_sinh_vien' => $idSinhVien,
            'id_lop'       => $idLop,
            'ngay_dang_ky' => date('Y-m-d')
        ]);
    }
    public function getLopDaDangKy($idSinhVien) {
        return $this->dao->getLopBySinhVien($idSinhVien);
    }
    public function huyDangKy($id) {
        return $this->dao->delete($id);
    }
}