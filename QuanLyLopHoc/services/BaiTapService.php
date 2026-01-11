<?php
require_once __DIR__ . '/../dao/BaiTapDAO.php';
class BaiTapService {
    private $dao;
    public function __construct() {
        $this->dao = new BaiTapDAO();
    }
    public function getByLop($idLop) {
        return $this->dao->getByLop($idLop);
    }
    public function getById($id) {
        return $this->dao->getById($id);
    }
    public function getDanhSachNopBai($idBT) {
        return $this->dao->getDanhSachNopBai($idBT);
    }
    public function getBaiTapCuaLop($idLop) {
        return $this->getByLop($idLop);
    }
    public function taoBaiTap($data) {
        return $this->dao->insert($data);
    }
    public function xoaBaiTap($id) {
        return $this->dao->delete($id);
    }
    public function delete($id) {
        return $this->dao->delete($id);
    }
    public function update($id, $data) {
        return $this->dao->update($id, $data);
    }
}