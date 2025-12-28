<?php
require_once __DIR__ . '/../core/BaseDAO.php';

class DangKyDAO extends BaseDAO {
    protected $table = 'dang_ky';

    public function insert($idSV, $idLop) {
        $sql = "INSERT INTO dang_ky(id_sinh_vien, id_lop) VALUES (?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$idSV, $idLop]);
    }

    public function getLopBySinhVien($idSV) {
        $sql = "
            SELECT lh.*
            FROM dang_ky dk
            JOIN lop_hoc lh ON dk.id_lop = lh.id
            WHERE dk.id_sinh_vien = ?
        ";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idSV]);
        return $stmt->fetchAll();
    }
}
