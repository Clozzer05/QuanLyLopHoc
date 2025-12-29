<?php
require_once __DIR__ . '/../core/BaseDAO.php';
require_once __DIR__ . '/../models/LopHocModel.php';
class LopHocDAO extends BaseDAO {
    protected $table = 'lop_hoc';
    public function findAll() {
        $sql = "SELECT lh.*, mh.ten_mon, nd.ho_ten 
                FROM lop_hoc lh
                LEFT JOIN mon_hoc mh ON lh.id_mon_hoc = mh.id
                LEFT JOIN nguoi_dung nd ON lh.id_giao_vien = nd.id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'LopHocModel');
    }
    public function findById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = ?");
        $stmt->execute([$id]);
        $stmt->setFetchMode(PDO::FETCH_CLASS, 'LopHocModel');
        return $stmt->fetch();
    }
}