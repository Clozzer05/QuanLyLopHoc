<?php
require_once __DIR__ . '/../core/BaseDAO.php';

class TaiLieuDAO extends BaseDAO {
    protected $table = 'tai_lieu';

    public function findAll() {
        $sql = "SELECT tl.*, nd.ho_ten as nguoi_upload_ten, lh.ten_lop 
                FROM tai_lieu tl
                LEFT JOIN nguoi_dung nd ON tl.nguoi_upload = nd.id
                LEFT JOIN lop_hoc lh ON tl.id_lop = lh.id
                ORDER BY tl.ngay_upload DESC";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function findById($id) {
        $sql = "SELECT * FROM tai_lieu WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    public function getByLop($idLop) {
        $sql = "SELECT * FROM tai_lieu WHERE id_lop = ? OR id_lop IS NULL ORDER BY ngay_upload DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idLop]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}