<?php
require_once __DIR__ . '/../core/BaseDAO.php';
require_once __DIR__ . '/../models/TaiLieuModel.php';

class TaiLieuDAO extends BaseDAO {
    protected $table = 'tai_lieu';
    protected $modelClass = 'TaiLieuModel';

    public function getByLop($idLop) {
        $sql = "SELECT * FROM tai_lieu WHERE id_lop = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idLop]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->modelClass);
    }
}