<?php
require_once __DIR__ . '/../core/BaseDAO.php';

class ThongBaoDAO extends BaseDAO {
    protected $table = 'thong_bao';

    public function getByLop($idLop = null) {
        if ($idLop === null) {
            $sql = "SELECT * FROM thong_bao WHERE id_lop IS NULL";
            return $this->conn->query($sql)->fetchAll();
        }

        $sql = "SELECT * FROM thong_bao WHERE id_lop = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idLop]);
        return $stmt->fetchAll();
    }

    public function insert($data) {
        $sql = "INSERT INTO thong_bao(tieu_de, noi_dung, nguoi_gui, id_lop)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['tieu_de'],
            $data['noi_dung'],
            $data['nguoi_gui'],
            $data['id_lop']
        ]);
    }

    public function getForSinhVien($idSV) {
    $sql = "
        SELECT tb.*, nd.ho_ten
        FROM thong_bao tb
        JOIN nguoi_dung nd ON tb.nguoi_gui = nd.id
        WHERE tb.id_lop IS NULL
           OR tb.id_lop IN (
                SELECT id_lop FROM dang_ky WHERE id_sinh_vien = ?
           )
        ORDER BY tb.ngay_tao DESC
    ";
    return $this->query($sql, [$idSV]);
    }
}
