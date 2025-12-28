<?php
require_once __DIR__ . '/../dao/DiemDanhDAO.php';

class DiemDanhModel {

    public static function getByLop($idLop) {
        $dao = new DiemDanhDAO();
        return $dao->getByLop($idLop);
    }

    public static function diemDanh($data) {
        $dao = new DiemDanhDAO();
        return $dao->insert($data);
    }
}
