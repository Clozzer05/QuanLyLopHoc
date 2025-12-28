<?php
require_once __DIR__ . '/../core/BaseDAO.php';

class DiemDanhDAO extends BaseDAO {
    protected $table = 'diem_danh';

    public function getByLop($idLop) {
        $sql = "SELECT * FROM diem_danh WHERE id_lop = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idLop]);
        return $stmt->fetchAll();
    }

    public function insert($data) {
        $sql = "INSERT INTO diem_danh(id_lop, id_sinh_vien, ngay_diem_danh, trang_thai, ghi_chu)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['id_lop'],
            $data['id_sinh_vien'],
            $data['ngay_diem_danh'],
            $data['trang_thai'],
            $data['ghi_chu']
        ]);
    }
}
