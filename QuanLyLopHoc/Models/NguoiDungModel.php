<?php
require_once __DIR__ . '/../dao/NguoiDungDAO.php';

class NguoiDungModel {

    public static function login($username, $password) {
        $dao = new NguoiDungDAO();
        return $dao->login($username, $password);
    }

    public static function findById($id) {
        $dao = new NguoiDungDAO();
        return $dao->findById($id);
    }

    public static function getGiaoVien() {
        $dao = new NguoiDungDAO();
        return $dao->getGiaoVien();
    }
}
