<?php
require_once __DIR__ . '/../core/BaseDAO.php';

class NguoiDungDAO extends BaseDAO {
    protected $table = 'nguoi_dung';

    public function login($tenDangNhap, $matKhau) {
        $sql = "SELECT * FROM nguoi_dung 
                WHERE ten_dang_nhap = ? AND mat_khau = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$tenDangNhap, $matKhau]);
        return $stmt->fetch();
    }

    public function getGiaoVien() {
        $sql = "SELECT * FROM nguoi_dung WHERE vai_tro = 'gv'";
        return $this->conn->query($sql)->fetchAll();
    }
}
