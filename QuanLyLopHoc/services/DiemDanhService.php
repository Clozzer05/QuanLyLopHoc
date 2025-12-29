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
    public function taoDiemDanh($data) {
        return $this->dao->insert([
            'id_lop'         => $data['id_lop'],
            'id_sinh_vien'   => $data['id_sinh_vien'],
            'ngay_diem_danh' => $data['ngay_diem_danh'],
            'trang_thai'     => $data['trang_thai'],
            'ghi_chu'        => $data['ghi_chu'] ?? ''
        ]);
    }
    public function updateDiemDanh($id, $trangThai, $ghiChu) {
        return $this->dao->update($id, [
            'trang_thai' => $trangThai,
            'ghi_chu'    => $ghiChu
        ]);
    }
}