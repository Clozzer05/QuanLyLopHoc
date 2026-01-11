<?php
require_once __DIR__ . '/../core/BaseDAO.php';
require_once __DIR__ . '/../models/BaiNopModel.php';

class BaiNopDAO extends BaseDAO {
    protected $table = 'bai_nop';
    protected $modelClass = 'BaiNopModel';

    public function getByBaiTap($idBaiTap) {
        $sql = "SELECT bn.*, nd.ho_ten 
                FROM bai_nop bn
                JOIN nguoi_dung nd ON bn.id_sinh_vien = nd.id
                WHERE bn.id_bai_tap = ?
                ORDER BY bn.ngay_nop DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idBaiTap]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}