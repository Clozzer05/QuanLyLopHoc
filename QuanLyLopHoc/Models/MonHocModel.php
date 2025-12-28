<?php
require_once __DIR__ . '/../dao/MonHocDAO.php';

class MonHocModel {

    public static function getAll() {
        $dao = new MonHocDAO();
        return $dao->findAll();
    }

    public static function findById($id) {
        $dao = new MonHocDAO();
        return $dao->findById($id);
    }
}
