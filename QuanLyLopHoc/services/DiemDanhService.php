<?php
require_once __DIR__ . '/../dao/DiemDanhDAO.php';

class DiemDanhService {
    private $dao;

    public function __construct() {
        $this->dao = new DiemDanhDAO();
    }

    /**
     * Lấy lịch sử điểm danh theo lớp
     */
    public function getLichSuDiemDanh($idLop) {
        return $this->dao->getByLop($idLop);
    }

    /**
     * Lấy danh sách điểm danh theo lớp và ngày (nếu có)
     */
    public function getByLop($idLop, $ngay = null) {
        return $this->dao->getByLop($idLop, $ngay);
    }

    /**
     * Tạo điểm danh mới
     */
    public function taoDiemDanh($data) {
        if (!isset($data['id_lop']) || !isset($data['id_sinh_vien'])) {
            return false;
        }

        $insertData = [
            'id_lop'         => $data['id_lop'],
            'id_sinh_vien'   => $data['id_sinh_vien'],
            'ngay_diem_danh' => $data['ngay_diem_danh'] ?? date('Y-m-d'),
            'trang_thai'     => $data['trang_thai'] ?? 'co_mat',
            'ghi_chu'        => $data['ghi_chu'] ?? ''
        ];

        return $this->dao->insert($insertData);
    }

    /**
     * Cập nhật điểm danh
     */
    public function updateDiemDanh($id, $trangThai, $ghiChu = '') {
        return $this->dao->update($id, [
            'trang_thai' => $trangThai,
            'ghi_chu'    => $ghiChu
        ]);
    }

    /**
     * Xóa điểm danh
     */
    public function delete($id) {
        return $this->dao->delete($id);
    }

    /**
     * Lấy thống kê điểm danh
     */
    public function getThongKeDiemDanh($idLop, $idSinhVien = null) {
        if ($idSinhVien) {
            return $this->dao->getThongKeSinhVien($idLop, $idSinhVien);
        }
        
        $lichSu = $this->dao->getByLop($idLop);
        
        $tongSoBuoi = count($lichSu);
        $coMat = 0;
        $vangCoPhep = 0;
        $vangKhongPhep = 0;
        
        foreach ($lichSu as $item) {
            if ($item->trang_thai == 'co_mat') {
                $coMat++;
            } elseif ($item->trang_thai == 'vang_co_phep') {
                $vangCoPhep++;
            } else {
                $vangKhongPhep++;
            }
        }
        
        return (object)[
            'tong_so_buoi' => $tongSoBuoi,
            'co_mat' => $coMat,
            'vang_co_phep' => $vangCoPhep,
            'vang_khong_phep' => $vangKhongPhep,
            'ti_le_co_mat' => $tongSoBuoi > 0 ? round(($coMat / $tongSoBuoi) * 100, 1) : 0
        ];
    }

    /**
     * Lấy danh sách các ngày đã điểm danh
     */
    public function getDanhSachNgayDiemDanh($idLop) {
        return $this->dao->getDanhSachNgayDiemDanh($idLop);
    }

    /**
     * Kiểm tra đã điểm danh chưa
     */
    public function kiemTraDaDiemDanh($idLop, $idSinhVien, $ngay) {
        return $this->dao->kiemTraDaDiemDanh($idLop, $idSinhVien, $ngay);
    }

    /**
     * Xóa điểm danh theo ngày
     */
    public function xoaDiemDanhTheoNgay($idLop, $ngay) {
        return $this->dao->xoaDiemDanhTheoNgay($idLop, $ngay);
    }
}