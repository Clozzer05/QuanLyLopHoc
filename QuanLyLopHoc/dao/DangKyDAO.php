<?php
require_once __DIR__ . '/../core/BaseDAO.php';
require_once __DIR__ . '/../models/DangKyModel.php';
require_once __DIR__ . '/../models/LopHocModel.php';

class DangKyDAO extends BaseDAO {
    protected $table = 'dang_ky';
    protected $modelClass = 'DangKyModel';
    public function getLopBySinhVien($idSV) {
        $sql = "SELECT lh.*, mh.ten_mon, nd.ho_ten as ten_giao_vien
                FROM dang_ky dk
                JOIN lop_hoc lh ON dk.id_lop = lh.id
                LEFT JOIN mon_hoc mh ON lh.id_mon_hoc = mh.id
                LEFT JOIN nguoi_dung nd ON lh.id_giao_vien = nd.id
                WHERE dk.id_sinh_vien = ?";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idSV]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'LopHocModel');
    }
}