<?php
require_once __DIR__ . '/../dao/TaiLieuDAO.php';
class TaiLieuService {
    private $dao;
    public function __construct() {
        $this->dao = new TaiLieuDAO();
    }
    public function getAll() {
        return $this->dao->findAll();
    }
    public function getById($id) {
        return $this->dao->findById($id);
    }
    public function create($data, $userId) {
        return $this->dao->insert([
            'tieu_de'        => $data['tieu_de'],
            'duong_dan_file' => $data['duong_dan_file'],
            'id_lop'         => $data['id_lop'],
            'nguoi_upload'   => $userId
        ]);
    }
    public function update($id, $data) {
        return $this->dao->update($id, [
            'tieu_de'        => $data['tieu_de'],
            'duong_dan_file' => $data['duong_dan_file'],
            'id_lop'         => $data['id_lop']
        ]);
    }
    public function delete($id) {
        return $this->dao->delete($id);
    }
}