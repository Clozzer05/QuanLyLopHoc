<?php
require_once __DIR__ . '/../core/BaseDAO.php';

class BaiTapDAO extends BaseDAO {
    protected $table = 'bai_tap';

    public function getByLop($idLop) {
        $sql = "SELECT * FROM bai_tap WHERE id_lop = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idLop]);
        return $stmt->fetchAll();
    }

    public function insert($data) {
        $sql = "INSERT INTO bai_tap(id_lop, tieu_de, mo_ta, han_nop, file_de_bai)
                VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['id_lop'],
            $data['tieu_de'],
            $data['mo_ta'],
            $data['han_nop'],
            $data['file_de_bai']
        ]);
    }
}
