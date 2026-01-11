<?php
require_once __DIR__ . '/../core/BaseDAO.php';
require_once __DIR__ . '/../models/DiemDanhModel.php';

class DiemDanhDAO extends BaseDAO {
    protected $table = 'diem_danh';
    protected $modelClass = 'DiemDanhModel';

    public function getByLop($idLop) {
        $sql = "SELECT dd.*, nd.ho_ten 
                FROM diem_danh dd
                JOIN nguoi_dung nd ON dd.id_sinh_vien = nd.id
                WHERE dd.id_lop = ?
                ORDER BY dd.ngay_diem_danh DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idLop]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function getLichSuDiemDanh($idLop, $ngay) {
        $sql = "SELECT dd.*, nd.ho_ten 
                FROM diem_danh dd
                JOIN nguoi_dung nd ON dd.id_sinh_vien = nd.id
                WHERE dd.id_lop = ? AND dd.ngay_diem_danh = ?
            ORDER BY nd.ho_ten ASC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idLop, $ngay]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
}
}