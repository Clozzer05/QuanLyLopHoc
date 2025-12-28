<?php
require_once __DIR__ . '/../core/BaseDAO.php';

class LopHocDAO extends BaseDAO {
    protected $table = 'lop_hoc';

    public function getByGiaoVien($idGV) {
        $sql = "SELECT * FROM lop_hoc WHERE id_giao_vien = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idGV]);
        return $stmt->fetchAll();
    }
}
