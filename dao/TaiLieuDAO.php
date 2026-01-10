<?php
require_once __DIR__ . '/../core/BaseDAO.php';

class TaiLieuDAO extends BaseDAO {
    protected $table = 'tai_lieu';

    public function getByLop($idLop) {
        $sql = "SELECT * FROM tai_lieu WHERE id_lop = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idLop]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}