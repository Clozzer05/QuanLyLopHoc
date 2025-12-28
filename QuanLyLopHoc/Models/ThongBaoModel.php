<?php
require_once __DIR__ . '/../dao/ThongBaoDAO.php';

class ThongBaoModel {

    public static function getByLop($idLop = null) {
        $dao = new ThongBaoDAO();
        return $dao->getByLop($idLop);
    }

    public static function create($data) {
        $dao = new ThongBaoDAO();
        return $dao->insert($data);
    }
}
