<?php
require_once __DIR__ . '/../core/BaseDAO.php';
require_once __DIR__ . '/../models/DiemDanhModel.php';

class DiemDanhDAO extends BaseDAO {
    protected $table = 'diem_danh';
    protected $modelClass = 'DiemDanhModel';

    /**
     * Lấy danh sách điểm danh theo lớp
     */
    public function getByLop($idLop, $ngay = null) {
        if ($ngay) {
            $sql = "SELECT dd.*, nd.ho_ten, nd.ten_dang_nhap as ma_sinh_vien
                    FROM diem_danh dd
                    JOIN nguoi_dung nd ON dd.id_sinh_vien = nd.id
                    WHERE dd.id_lop = ? AND dd.ngay_diem_danh = ?
                    ORDER BY nd.ho_ten ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$idLop, $ngay]);
        } else {
            $sql = "SELECT dd.*, nd.ho_ten, nd.ten_dang_nhap as ma_sinh_vien
                    FROM diem_danh dd
                    JOIN nguoi_dung nd ON dd.id_sinh_vien = nd.id
                    WHERE dd.id_lop = ?
                    ORDER BY dd.ngay_diem_danh DESC, nd.ho_ten ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$idLop]);
        }
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Lấy lịch sử điểm danh theo lớp và ngày cụ thể (có tìm kiếm)
     */
    public function getLichSuDiemDanh($idLop, $ngay, $searchTerm = '') {
        if (!empty($searchTerm)) {
            // Tìm kiếm theo tên hoặc mã sinh viên
            $sql = "SELECT dd.*, nd.ho_ten, nd.ten_dang_nhap as ma_sinh_vien
                    FROM diem_danh dd
                    JOIN nguoi_dung nd ON dd.id_sinh_vien = nd.id
                    WHERE dd.id_lop = ? AND dd.ngay_diem_danh = ?
                    AND (nd.ho_ten LIKE ? OR nd.ten_dang_nhap = ?)
                    ORDER BY nd.ho_ten ASC";
            $stmt = $this->conn->prepare($sql);
            $searchLike = '%' . $searchTerm . '%';
            $stmt->execute([$idLop, $ngay, $searchLike, $searchTerm]);
        } else {
            $sql = "SELECT dd.*, nd.ho_ten, nd.ten_dang_nhap as ma_sinh_vien
                    FROM diem_danh dd
                    JOIN nguoi_dung nd ON dd.id_sinh_vien = nd.id
                    WHERE dd.id_lop = ? AND dd.ngay_diem_danh = ?
                    ORDER BY nd.ho_ten ASC";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([$idLop, $ngay]);
        }
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Lấy danh sách các ngày đã điểm danh trong lớp
     */
    public function getDanhSachNgayDiemDanh($idLop) {
        $sql = "SELECT DISTINCT ngay_diem_danh 
                FROM diem_danh 
                WHERE id_lop = ? 
                ORDER BY ngay_diem_danh DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idLop]);
        return $stmt->fetchAll(PDO::FETCH_COLUMN);
    }

    /**
     * Kiểm tra xem đã điểm danh cho sinh viên trong ngày chưa
     */
    public function kiemTraDaDiemDanh($idLop, $idSinhVien, $ngay) {
        $sql = "SELECT COUNT(*) as count 
                FROM diem_danh 
                WHERE id_lop = ? AND id_sinh_vien = ? AND ngay_diem_danh = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idLop, $idSinhVien, $ngay]);
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        return $result->count > 0;
    }

    /**
     * Xóa điểm danh theo lớp và ngày (để tránh trùng lặp khi điểm danh lại)
     */
    public function xoaDiemDanhTheoNgay($idLop, $ngay) {
        $sql = "DELETE FROM diem_danh WHERE id_lop = ? AND ngay_diem_danh = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$idLop, $ngay]);
    }

    /**
     * Lấy thống kê điểm danh của sinh viên
     */
    public function getThongKeSinhVien($idLop, $idSinhVien) {
        $sql = "SELECT 
                    COUNT(*) as tong_buoi,
                    SUM(CASE WHEN trang_thai = 'co_mat' THEN 1 ELSE 0 END) as co_mat,
                    SUM(CASE WHEN trang_thai = 'vang_co_phep' THEN 1 ELSE 0 END) as vang_co_phep,
                    SUM(CASE WHEN trang_thai = 'vang_khong_phep' THEN 1 ELSE 0 END) as vang_khong_phep
                FROM diem_danh 
                WHERE id_lop = ? AND id_sinh_vien = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idLop, $idSinhVien]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }

    /**
     * Lấy thống kê điểm danh của cả lớp theo ngày
     */
    public function getThongKeTheoNgay($idLop, $ngay) {
        $sql = "SELECT 
                    COUNT(*) as tong_sv,
                    SUM(CASE WHEN trang_thai = 'co_mat' THEN 1 ELSE 0 END) as co_mat,
                    SUM(CASE WHEN trang_thai = 'vang_co_phep' THEN 1 ELSE 0 END) as vang_co_phep,
                    SUM(CASE WHEN trang_thai = 'vang_khong_phep' THEN 1 ELSE 0 END) as vang_khong_phep
                FROM diem_danh 
                WHERE id_lop = ? AND ngay_diem_danh = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idLop, $ngay]);
        return $stmt->fetch(PDO::FETCH_OBJ);
    }
}