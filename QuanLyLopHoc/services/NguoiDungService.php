<?php
require_once __DIR__ . '/../dao/NguoiDungDAO.php';

class NguoiDungService {
    private $dao;

    public function __construct() {
        $this->dao = new NguoiDungDAO();
    }

    public function login($tenDangNhap, $matKhau) {
        return $this->dao->login($tenDangNhap, $matKhau);
    }

    public function getAll() {
        return $this->dao->findAll();
    }

    public function getGiaoVien() {
        return $this->dao->getGiaoVien();
    }

    public function getById($id) {
        return $this->dao->findById($id);
    }

    public function create($data) {
        return $this->dao->insert([
            'ten_dang_nhap' => $data['ten_dang_nhap'],
            'mat_khau'      => $data['mat_khau'],
            'ho_ten'        => $data['ho_ten'],
            'vai_tro'       => $data['vai_tro']
        ]);
    }

    public function update($id, $data) {
        if (empty($data['mat_khau'])) {
            $userCu = $this->dao->findById($id);
            $matKhauChot = $userCu->mat_khau;
        } else {
            $matKhauChot = $data['mat_khau'];
        }

        $cleanData = [
            'ten_dang_nhap' => $data['ten_dang_nhap'],
            'mat_khau'      => $matKhauChot,
            'ho_ten'        => $data['ho_ten'],
            'vai_tro'       => $data['vai_tro']
        ];

        return $this->dao->update($id, $cleanData);
    }

    public function delete($id) {
        return $this->dao->delete($id);
    }

            public function countHocSinh() {
            return $this->dao->countByRole('sv');
        }

        public function countGiaoVien() {
            return $this->dao->countByRole('gv');
        }
}