<?php
require_once __DIR__ . '/../dao/TaiLieuDAO.php';

class TaiLieuModel {

    public static function getByLop($idLop) {
        $dao = new TaiLieuDAO();
        return $dao->getByLop($idLop);
    }

    public static function upload($data) {
        $dao = new TaiLieuDAO();
        return $dao->insert($data);
    }
}
