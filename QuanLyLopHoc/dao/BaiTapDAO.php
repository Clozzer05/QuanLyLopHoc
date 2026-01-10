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
        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->modelClass);
    }

    public function getById($id) {
        $sql = "SELECT * FROM bai_tap WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getDanhSachNopBai($idBT) {
        $sql = "SELECT bn.*, nd.ho_ten 
                FROM bai_nop bn
                JOIN nguoi_dung nd ON bn.id_sinh_vien = nd.id
                WHERE bn.id_bai_tap = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idBT]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}