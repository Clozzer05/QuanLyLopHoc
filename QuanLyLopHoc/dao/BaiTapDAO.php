<?php
require_once __DIR__ . '/../core/BaseDAO.php';
class BaiTapDAO extends BaseDAO {
    protected $table = 'bai_tap';
    public function getByLop($idLop) {
        $sql = "SELECT * FROM bai_tap WHERE id_lop = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idLop]);
        return $stmt->fetchAll();
    }
}