<?php
require_once __DIR__ . '/../core/BaseDAO.php';

class BaiNopDAO extends BaseDAO {
    protected $table = 'bai_nop';

    public function getByBaiTap($idBaiTap) {
        $sql = "SELECT * FROM bai_nop WHERE id_bai_tap = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idBaiTap]);
        return $stmt->fetchAll();
    }

    public function insert($data) {
        $sql = "INSERT INTO bai_nop(id_bai_tap, id_sinh_vien, file_bai_lam)
                VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['id_bai_tap'],
            $data['id_sinh_vien'],
            $data['file_bai_lam']
        ]);
    }
}
