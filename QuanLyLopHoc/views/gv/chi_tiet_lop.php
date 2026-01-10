<?php include __DIR__.'/../layouts/header.php'; ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h3>CHI TIẾT LỚP: <?= htmlspecialchars($lop->ten_lop) ?></h3>
    <a href="index.php?controller=giaovien" class="btn" style="background: #000; color: #fff; text-decoration: none; padding: 5px 15px; border-radius: 4px;">Quay lại</a>
</div>

<div class="card">
    <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>Họ tên</th>
                <th style="width: 150px; text-align: center;">Giữa kỳ</th>
                <th style="width: 150px; text-align: center;">Cuối kỳ</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($sinhVien)): ?>
                <?php foreach ($sinhVien as $sv): ?>
                    <tr>
                        <td><?= htmlspecialchars($sv->ho_ten) ?></td>
                        <td align="center"><?= $sv->diem_giua_ky ?? '---' ?></td>
                        <td align="center"><?= $sv->diem_cuoi_ky ?? '---' ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" align="center">Chưa có sinh viên nào đăng ký lớp này.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__.'/../layouts/footer.php'; ?>