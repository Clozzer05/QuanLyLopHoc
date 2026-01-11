<?php include __DIR__.'/../layouts/header.php'; ?>

    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
        <h3>CHI TIẾT LỚP: <?= htmlspecialchars($lop->ten_lop ?? 'N/A') ?></h3>

        <div>
            <a href="index.php?controller=giaovien&action=index"
               style="background: #6c757d; color: #fff; text-decoration: none; padding: 8px 15px; border-radius: 4px; font-weight: bold; margin-right: 5px;">
                Quay lại
            </a>
        </div>
    </div>

<?php if (isset($_SESSION['success'])): ?>
    <div style="color: green; background: #d4edda; padding: 10px; margin-bottom: 10px; border: 1px solid #c3e6cb;">
        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

    <div class="card">
        <form action="index.php?controller=giaovien&action=capNhatDiem" method="POST">
            <input type="hidden" name="id_lop" value="<?= $lop->id ?>">

            <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse;">
                <thead>
                <tr style="background-color: #f2f2f2;">
                    <th>Họ tên sinh viên</th>
                    <th style="width: 150px; text-align: center;">Điểm giữa kỳ</th>
                    <th style="width: 150px; text-align: center;">Điểm cuối kỳ</th>
                </tr>
                </thead>
                <tbody>
                <?php if (!empty($sinhVien)): ?>
                    <?php foreach ($sinhVien as $sv): ?>
                        <tr>
                            <td><?= htmlspecialchars($sv->ho_ten) ?></td>

                            <td align="center">
                                <input type="number"
                                       step="0.1" min="0" max="10"
                                       name="diem[<?= $sv->id ?>][giua_ky]"
                                       value="<?= $sv->diem_giua_ky ?>"
                                       style="width: 60px; text-align: center; padding: 5px;">
                            </td>

                            <td align="center">
                                <input type="number"
                                       step="0.1" min="0" max="10"
                                       name="diem[<?= $sv->id ?>][cuoi_ky]"
                                       value="<?= $sv->diem_cuoi_ky ?>"
                                       style="width: 60px; text-align: center; padding: 5px;">
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" align="center" style="padding: 20px; color: #666;">
                            Chưa có sinh viên nào đăng ký lớp này.
                        </td>
                    </tr>
                <?php endif; ?>
                </tbody>
            </table>

            <?php if (!empty($sinhVien)): ?>
                <div style="margin-top: 15px; text-align: right;">
                    <button type="submit"
                            style="background: #007bff; color: #fff; border: none; padding: 10px 25px; border-radius: 4px; cursor: pointer; font-size: 16px;">
                        💾 Lưu bảng điểm
                    </button>
                </div>
            <?php endif; ?>
        </form>
    </div>

<?php include __DIR__.'/../layouts/footer.php'; ?>