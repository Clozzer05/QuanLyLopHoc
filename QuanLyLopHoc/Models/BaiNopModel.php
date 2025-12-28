<?php
require_once __DIR__ . '/../dao/BaiNopDAO.php';

class BaiNopModel {

    public static function nopBai($data) {
        $dao = new BaiNopDAO();
        return $dao->insert($data);
    }

    public static function getByBaiTap($idBaiTap) {
        $dao = new BaiNopDAO();
        return $dao->getByBaiTap($idBaiTap);
    }
}
