<?php
require_once __DIR__ . '/../dao/DangKyDAO.php';
class DangKyModel {
    public static function dangKy($idSV, $idLop) {
        $dao = new DangKyDAO();
        return $dao->insert($idSV, $idLop);
    }
    public static function getLopBySinhVien($idSV) {
        $dao = new DangKyDAO();
        return $dao->getLopBySinhVien($idSV);
    }
}
