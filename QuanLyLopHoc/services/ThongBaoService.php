<?php
require_once __DIR__ . '/../dao/ThongBaoDAO.php';
class ThongBaoService {
    private $dao;
    public function __construct() {
        $this->dao = new ThongBaoDAO();
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