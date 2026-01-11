<?php
require_once __DIR__ . '/../core/BaseDAO.php';
require_once __DIR__ . '/../models/NguoiDungModel.php';

class NguoiDungDAO extends BaseDAO {
    protected $table = 'nguoi_dung';
    protected $modelClass = 'NguoiDungModel';

    public function login($tenDangNhap, $matKhau) {
        $sql = "SELECT * FROM nguoi_dung WHERE ten_dang_nhap = ? AND mat_khau = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$tenDangNhap, $matKhau]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, $this->modelClass);
        return $stmt->fetch();
    }

    public function getGiaoVien() {
        $sql = "SELECT * FROM nguoi_dung WHERE vai_tro = 'gv'";
        $stmt = $this->conn->query($sql);
        return $stmt->fetchAll(PDO::FETCH_CLASS, $this->modelClass);
    }

            public function countByRole($role) {
            $sql = "SELECT COUNT(*) as total FROM nguoi_dung WHERE vai_tro = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$role]);
            $row = $stmt->fetch();
            return $row ? (int)$row['total'] : 0;
        }
}