<?php
require_once __DIR__ . '/../dao/MonHocDAO.php';
class MonHocService {
    private $dao;
    public function __construct() {
        $this->dao = new MonHocDAO();
    }
    public function getAll() {
        return $this->dao->findAll();
    }
    public function getById($id) {
        return $this->dao->findById($id);
    }
    public function create($data) {
        if (isset($data['so_tin_chi']) && $data['so_tin_chi'] < 1) {
            $data['so_tin_chi'] = 1;
        }
        return $this->dao->insert([
            'ten_mon' => $data['ten_mon'],
            'so_tin_chi' => $data['so_tin_chi']
        ]);
    }
    public function update($id, $data) {
        $cleanData = [
            'ten_mon' => $data['ten_mon'],
            'so_tin_chi' => $data['so_tin_chi']
        ];
        return $this->dao->update($id, $cleanData);
    }
    public function delete($id) {
        return $this->dao->delete($id);
    }
}