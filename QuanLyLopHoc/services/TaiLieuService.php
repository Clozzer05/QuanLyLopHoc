<?php
require_once __DIR__ . '/../dao/TaiLieuDAO.php';

class TaiLieuService {
    private $dao;

    public function __construct() {
        $this->dao = new TaiLieuDAO();
    }

    public function getByLop($idLop) {
        return $this->dao->getByLop($idLop);
    }

    public function taoTaiLieu($data) {
        return $this->dao->insert($data);
    }
    public function getAll() {
        return $this->dao->findAll();
    }

}