<?php
require_once __DIR__ . '/../core/BaseDAO.php';
require_once __DIR__ . '/../models/ThongBaoModel.php';
class ThongBaoDAO extends BaseDAO {
    protected $table = 'thong_bao';
    protected $modelClass = 'ThongBaoModel';
    public function getByLop($idLop = null) {
        if ($idLop === null) {
            $sql = "SELECT tb.*, nd.ho_ten 
                    FROM thong_bao tb 
                    JOIN nguoi_dung nd ON tb.nguoi_gui = nd.id 
                    WHERE tb.id_lop IS NULL";
            $stmt = $this->conn->query($sql);
        } else {
            $sql = "SELECT tb.*, nd.ho_ten 
                    FROM thong_bao tb 
                    JOIN nguoi_dung nd ON tb.nguoi_gui = nd.id 
                    WHERE tb.id_lop = ? 
                    ORDER BY tb.ngay_tao DESC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$idLop]);
        }
        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->modelClass);
    }
    public function getForSinhVien($idSV) {
        $sql = "SELECT tb.*, nd.ho_ten
                FROM thong_bao tb
                JOIN nguoi_dung nd ON tb.nguoi_gui = nd.id
                WHERE tb.id_lop IS NULL
                   OR tb.id_lop IN (SELECT id_lop FROM dang_ky WHERE id_sinh_vien = ?)
                ORDER BY tb.ngay_tao DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idSV]);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->modelClass);
    }
}