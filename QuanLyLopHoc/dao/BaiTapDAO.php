<?php
require_once __DIR__ . '/../core/BaseDAO.php';
require_once __DIR__ . '/../models/BaiTapModel.php';

class BaiTapDAO extends BaseDAO {
    protected $table = 'bai_tap';
    protected $modelClass = 'BaiTapModel';

    public function getByLop($idLop) {
        $sql = "SELECT * FROM bai_tap WHERE id_lop = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idLop]);
        // Dùng luôn $this->modelClass cho tiện
        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->modelClass);
    }
}