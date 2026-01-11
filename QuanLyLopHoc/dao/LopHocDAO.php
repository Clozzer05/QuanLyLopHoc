<?php
require_once __DIR__ . '/../core/BaseDAO.php';
require_once __DIR__ . '/../models/LopHocModel.php';

class LopHocDAO extends BaseDAO {
    protected $table = 'lop_hoc';
    protected $modelClass = 'LopHocModel';
    public function findAll() {
        $sql = "SELECT lh.*, mh.ten_mon, nd.ho_ten as ten_giao_vien 
                FROM lop_hoc lh
                LEFT JOIN mon_hoc mh ON lh.id_mon_hoc = mh.id
                LEFT JOIN nguoi_dung nd ON lh.id_giao_vien = nd.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->modelClass);
    }
    public function getByGiaoVien($idGV) {
        $sql = "SELECT lh.*, mh.ten_mon 
            FROM lop_hoc lh
            LEFT JOIN mon_hoc mh ON lh.id_mon_hoc = mh.id
            WHERE lh.id_giao_vien = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idGV]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->modelClass);
    }

            public function countAll() {
            $sql = "SELECT COUNT(*) as total FROM lop_hoc";
            $stmt = $this->conn->query($sql);
            $row = $stmt->fetch();
            return $row ? (int)$row['total'] : 0;
        }
        
}