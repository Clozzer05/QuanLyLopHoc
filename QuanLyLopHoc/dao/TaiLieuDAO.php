<?php
require_once __DIR__ . '/../core/BaseDAO.php';

class TaiLieuDAO extends BaseDAO {
    protected $table = 'tai_lieu';

    public function getByLop($idLop) {
        $sql = "SELECT * FROM tai_lieu WHERE id_lop = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idLop]);
        return $stmt->fetchAll();
    }

    public function insert($data) {
        $sql = "INSERT INTO tai_lieu(tieu_de, duong_dan_file, nguoi_upload, id_lop)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['tieu_de'],
            $data['duong_dan_file'],
            $data['nguoi_upload'],
            $data['id_lop']
        ]);
    }
}
