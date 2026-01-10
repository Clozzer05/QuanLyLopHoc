<?php
require_once __DIR__ . '/../core/BaseDAO.php';
require_once __DIR__ . '/../models/BaiNopModel.php';

class BaiNopDAO extends BaseDAO {
    protected $table = 'bai_nop';
    protected $modelClass = 'BaiNopModel';

    public function getByBaiTap($idBaiTap) {
        $sql = "SELECT * FROM bai_nop WHERE id_bai_tap = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idBaiTap]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->modelClass);
    }

    
}