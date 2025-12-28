<?php
require_once __DIR__ . '/../dao/LopHocDAO.php';

class LopHocModel {

    public static function getAll() {
        $dao = new LopHocDAO();
        return $dao->findAll();
    }

    public static function getByGiaoVien($idGV) {
        $dao = new LopHocDAO();
        return $dao->getByGiaoVien($idGV);
    }

    public static function findById($id) {
        $dao = new LopHocDAO();
        return $dao->findById($id);
    }
}
