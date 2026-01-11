<?php include __DIR__.'/../layouts/header.php'; ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h3>CHI TIẾT LỚP: <?= htmlspecialchars($lop->ten_lop ?? 'N/A') ?></h3>
    
    <a href="index.php?controller=giaovien&action=index" 
       style="background: #000; color: #fff; text-decoration: none; padding: 8px 20px; border-radius: 4px; font-weight: bold; font-size: 0.9em;">
       Quay lại
    </a>
</div>

<div class="card">
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
                            <span style="font-weight: bold; color: #28a745;">
                                <?= $sv->diem_giua_ky ?? '---' ?>
                            </span>
                        </td>
                        <td align="center">
                            <span style="font-weight: bold; color: #007bff;">
                                <?= $sv->diem_cuoi_ky ?? '---' ?>
                            </span>
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
</div>

<?php include __DIR__.'/../layouts/footer.php'; ?>