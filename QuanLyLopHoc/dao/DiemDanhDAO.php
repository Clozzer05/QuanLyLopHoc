<?php
require_once __DIR__ . '/../core/BaseDAO.php';
require_once __DIR__ . '/../models/DiemDanhModel.php';

class DiemDanhDAO extends BaseDAO {
    protected $table = 'diem_danh';
    protected $modelClass = 'DiemDanhModel';

    public function getByLop($idLop) {
        $sql = "SELECT * FROM diem_danh WHERE id_lop = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idLop]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->modelClass);
    }
}