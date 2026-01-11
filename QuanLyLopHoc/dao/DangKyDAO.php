<?php
require_once __DIR__ . '/../core/BaseDAO.php';
class DangKyDAO extends BaseDAO {
    protected $table = 'dang_ky';
    public function getLopBySinhVien($idSV) {
        $sql = "SELECT l.*, m.ten_mon, n.ho_ten as ten_giao_vien 
                FROM lop_hoc l
                JOIN mon_hoc m ON l.id_mon_hoc = m.id
                JOIN nguoi_dung n ON l.id_giao_vien = n.id
                JOIN dang_ky d ON l.id = d.id_lop
                WHERE d.id_sinh_vien = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idSV]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function getThongTinLop($idLop) {
        $sql = "SELECT l.*, m.ten_mon, n.ho_ten 
                FROM lop_hoc l
                JOIN mon_hoc m ON l.id_mon_hoc = m.id
                JOIN nguoi_dung n ON l.id_giao_vien = n.id
                WHERE l.id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idLop]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function getKetQua($idSV, $idLop) {
        $sql = "SELECT diem_giua_ky, diem_cuoi_ky 
                FROM dang_ky 
                WHERE id_sinh_vien = ? AND id_lop = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idSV, $idLop]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
    public function getLopChuaDangKy($idSV) {
        $sql = "SELECT l.*, m.ten_mon, n.ho_ten 
                FROM lop_hoc l
                JOIN mon_hoc m ON l.id_mon_hoc = m.id
                JOIN nguoi_dung n ON l.id_giao_vien = n.id
                WHERE l.id NOT IN (SELECT id_lop FROM dang_ky WHERE id_sinh_vien = ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idSV]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function getSinhVienByLop($idLop) {
        $sql = "SELECT nd.id, nd.ho_ten, dk.diem_giua_ky, dk.diem_cuoi_ky 
            FROM dang_ky dk
            JOIN nguoi_dung nd ON dk.id_sinh_vien = nd.id
            WHERE dk.id_lop = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idLop]);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
    public function updateDiem($idLop, $idSV, $diemGiuaKy, $diemCuoiKy) {
        $diemGK = ($diemGiuaKy === '') ? null : $diemGiuaKy;
        $diemCK = ($diemCuoiKy === '') ? null : $diemCuoiKy;
        $sql = "UPDATE dang_ky 
            SET diem_giua_ky = ?, diem_cuoi_ky = ? 
            WHERE id_lop = ? AND id_sinh_vien = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$diemGK, $diemCK, $idLop, $idSV]);
    }
}