<?php
require_once __DIR__ . '/../dao/LopHocDAO.php';

class LopHocService {
    private $dao;

    public function __construct() {
        $this->dao = new LopHocDAO();
    }

    public function getAll() {
        return $this->dao->findAll();
    }

    public function getById($id) {
        return $this->dao->findById($id);
    }

    public function getByGiaoVien($idGV) {
        return $this->dao->getByGiaoVien($idGV);
    }

    public function create($data) {
        // Kiểm tra trùng tên lớp học
        $all = $this->dao->findAll();
        foreach ($all as $lop) {
            if (mb_strtolower(trim($lop->ten_lop)) === mb_strtolower(trim($data['ten_lop']))) {
                throw new PDOException('Tên lớp học đã tồn tại', '23000');
            }
        }
        return $this->dao->insert([
            'ten_lop'      => $data['ten_lop'],
            'hoc_ky'       => $data['hoc_ky'] ,
            'id_mon_hoc'   => $data['id_mon_hoc'],
            'id_giao_vien' => $data['id_giao_vien']
        ]);
    }

    public function update($id, $data) {
        $cleanData = [
            'ten_lop'      => $data['ten_lop'],
            'hoc_ky'       => $data['hoc_ky'] ,
            'id_mon_hoc'   => $data['id_mon_hoc'],
            'id_giao_vien' => $data['id_giao_vien']
        ];
        return $this->dao->update($id, $cleanData);
    }

    public function delete($id) {
        return $this->dao->delete($id);
    }

    public function countLopHoc() {
        return $this->dao->countAll();
    }
}