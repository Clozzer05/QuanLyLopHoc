<?php
require_once __DIR__ . '/../dao/ThongBaoDAO.php';
class ThongBaoService {
    private $dao;
    public function __construct() {
        $this->dao = new ThongBaoDAO();
    }
    public function getForSinhVien($idSV) {
        return $this->dao->getForSinhVien($idSV);
    }
    public function getForSinhVienByLop($idLop) {
        return $this->dao->getByLop($idLop);
    }
    public function getByLop($idLop) {
        return $this->dao->getByLop($idLop);
    }
    public function getAll() {
        return $this->dao->findAll();
    }
    public function getById($id) {
        return $this->dao->findById($id);
    }
    public function create($data) {
        return $this->dao->insert([
            'tieu_de'  => $data['tieu_de'],
            'noi_dung' => $data['noi_dung'],
            'nguoi_gui'=> $data['nguoi_gui'],
            'id_lop'   => $data['id_lop']
        ]);
    }
    public function update($id, $data) {
        return $this->dao->update($id, [
            'tieu_de'  => $data['tieu_de'],
            'noi_dung' => $data['noi_dung']
        ]);
    }
    public function delete($id) {
        return $this->dao->delete($id);
    }
}