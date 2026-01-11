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
    public function create($data, $userId) {
        $data['nguoi_upload'] = $userId;
        return $this->dao->insert($data);
    }
    public function getById($id) {
        return $this->dao->findById($id);
    }
    public function update($id, $data) {
        return $this->dao->update($id, $data);
    }
    public function delete($id) {
        $taiLieu = $this->getById($id);
        if ($taiLieu && !empty($taiLieu->duong_dan_file)) {
            $filePath = __DIR__ . '/../../public/uploads/tai_lieu/' . $taiLieu->duong_dan_file;
            if (file_exists($filePath)) {
                unlink($filePath);
            }
        }
        return $this->dao->delete($id);
    }
}