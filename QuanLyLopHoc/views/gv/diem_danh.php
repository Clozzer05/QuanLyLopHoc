<?php include __DIR__.'/../layouts/header.php'; ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h3>ĐIỂM DANH: <?= htmlspecialchars($lop->ten_lop ?? 'Lớp học') ?></h3>
    <a href="index.php?controller=giaovien&action=index" 
       style="background: #000; color: #fff; text-decoration: none; padding: 8px 20px; border-radius: 4px; font-weight: bold; font-size: 0.9em;">
       Quay lại
    </a>
</div>

<div class="card">
    <form action="index.php?controller=giaovien&action=saveDiemDanh" method="POST">
        <input type="hidden" name="id_lop" value="<?= $idLop ?>">
        
        <div style="margin-bottom: 15px;">
            <label>Ngày điểm danh:</label>
            <input type="date" name="ngay_diem_danh" value="<?= date('Y-m-d') ?>" required 
                   style="padding: 5px; border-radius: 4px; border: 1px solid #ccc;">
        </div>

        <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f8f9fa;">
                    <th align="left">Họ tên sinh viên</th>
                    <th style="width: 150px; text-align: center;">Vắng mặt</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sinhVien)): ?>
                    <?php foreach ($sinhVien as $sv): ?>
                    <tr>
                        <td><?= htmlspecialchars($sv->ho_ten) ?></td>
                        <td align="center">
                            <input type="hidden" name="sv[<?= $sv->id ?>][id]" value="<?= $sv->id ?>">
                            <input type="checkbox" name="sv[<?= $sv->id ?>][vang]" value="1">
                        </td>
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="2" align="center" style="padding: 20px; color: #666;">Chưa có sinh viên trong lớp này.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <div style="margin-top: 20px; text-align: right;">
            <button type="submit" class="btn btn-primary" style="padding: 10px 30px; font-weight: bold;">Lưu điểm danh</button>
        </div>
    </form>
</div>

<?php include __DIR__.'/../layouts/footer.php'; ?>