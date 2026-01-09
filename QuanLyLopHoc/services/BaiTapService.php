<?php
require_once __DIR__ . '/../dao/BaiTapDAO.php';
class BaiTapService {
    private $dao;
    public function __construct() {
        $this->dao = new BaiTapDAO();
    }
    public function getBaiTapCuaLop($idLop) {
        return $this->dao->getByLop($idLop);
    }
    public function getById($id) {
        return $this->dao->findById($id);
    }
    public function taoBaiTap($data) {
        return $this->dao->insert([
            'id_lop'      => $data['id_lop'],
            'tieu_de'     => $data['tieu_de'],
            'mo_ta'       => $data['mo_ta'],
            'han_nop'     => $data['han_nop'],
            'file_de_bai' => $data['file_de_bai'] ?? ''
        ]);
    }
    public function update($id, $data) {
        if (empty($data['file_de_bai'])) {
            $baiTapCu = $this->dao->findById($id);
            $fileChot = $baiTapCu->file_de_bai;
        } else {
            $fileChot = $data['file_de_bai'];
        }
        return $this->dao->update($id, [
            'tieu_de'     => $data['tieu_de'],
            'mo_ta'       => $data['mo_ta'],
            'han_nop'     => $data['han_nop'],
            'file_de_bai' => $fileChot
        ]);
    }
    public function delete($id) {
        return $this->dao->delete($id);
    }
}