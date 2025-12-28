<?php
require_once __DIR__ . '/../dao/BaiTapDAO.php';

class BaiTapModel {

    public static function getByLop($idLop) {
        $dao = new BaiTapDAO();
        return $dao->getByLop($idLop);
    }

    public static function create($data) {
        $dao = new BaiTapDAO();
        return $dao->insert($data);
    }
}
