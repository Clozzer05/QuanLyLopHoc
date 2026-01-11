<?php
require_once __DIR__ . '/../dao/DiemDanhDAO.php';

class DiemDanhService {
    private $dao;

    public function __construct() {
        $this->dao = new DiemDanhDAO();
    }

    public function getLichSuDiemDanh($idLop) {
        return $this->dao->getByLop($idLop);
    }

    public function getByLop($idLop, $ngay = null) {
        return $this->dao->getByLop($idLop);
    }

    public function taoDiemDanh($data) {
        if (!isset($data['id_lop']) || !isset($data['id_sinh_vien'])) {
            return false;
        }

        // Chuẩn hóa dữ liệu
        $insertData = [
            'id_lop'         => $data['id_lop'],
            'id_sinh_vien'   => $data['id_sinh_vien'],
            'ngay_diem_danh' => $data['ngay_diem_danh'] ?? date('Y-m-d'),
            'trang_thai'     => $data['trang_thai'] ?? 'co_mat',
            'ghi_chu'        => $data['ghi_chu'] ?? ''
        ];

        return $this->dao->insert($insertData);
    }

    public function updateDiemDanh($id, $trangThai, $ghiChu) {
        return $this->dao->update($id, [
            'trang_thai' => $trangThai,
            'ghi_chu'    => $ghiChu
        ]);
    }

    public function delete($id) {
        return $this->dao->delete($id);
    }

    public function getThongKeDiemDanh($idLop, $idSinhVien) {
        // Có thể implement sau nếu cần
        return null;
    }
}