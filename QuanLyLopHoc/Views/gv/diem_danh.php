<?php include __DIR__.'/../layouts/header.php'; ?>

    <h3>ĐIỂM DANH - <?= $lop['ten_lop'] ?></h3>

    <div class="card" style="max-width: 800px; margin: 0 auto;">
        <form method="post" action="/giaovien/luuDiemDanh">
            <div style="margin-bottom: 20px;">
                <label><strong>Ngày điểm danh:</strong></label>
                <input type="date" name="ngay_diem_danh" value="<?= date('Y-m-d') ?>" required style="max-width: 200px;">
            </div>

            <table>
                <thead>
                <tr>
                    <th>Sinh viên</th>
                    <th>Trạng thái</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($sinhVien as $sv): ?>
                    <tr>
                        <td><?= $sv['ho_ten'] ?></td>
                        <td>
                            <select name="trang_thai[<?= $sv['id'] ?>]" style="margin: 0;">
                                <option value="co_mat">Có mặt</option>
                                <option value="vang_co_phep">Vắng có phép</option>
                                <option value="vang_khong_phep">Vắng không phép</option>
                            </select>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <div style="text-align: right; margin-top: 20px;">
                <button class="btn btn-primary">Lưu điểm danh</button>
            </div>
        </form>
    </div>

<?php include __DIR__.'/../layouts/footer.php'; ?>