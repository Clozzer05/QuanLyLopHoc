<?php include __DIR__.'/../layouts/header.php'; ?>

<?php if (isset($_SESSION['success'])): ?>
    <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #c3e6cb; font-weight: bold;">
        ✓ <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #f5c6cb; font-weight: bold;">
        ✗ <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h3>ĐIỂM DANH: <?= htmlspecialchars($lop->ten_lop ?? 'Lớp học') ?></h3>
    <div style="display: flex; gap: 10px;">
        <a href="index.php?controller=giaovien&action=xemLichSuDiemDanh&id_lop=<?= $idLop ?>" 
           style="background: #28a745; color: #fff; text-decoration: none; padding: 8px 20px; border-radius: 4px; font-weight: bold; font-size: 0.9em;">
          Xem lịch sử
        </a>
        <a href="index.php?controller=giaovien&action=index" 
           style="background: #000; color: #fff; text-decoration: none; padding: 8px 20px; border-radius: 4px; font-weight: bold; font-size: 0.9em;">
           Quay lại
        </a>
    </div>
</div>

<div class="card">
    <form action="index.php?controller=giaovien&action=saveDiemDanh" method="POST">
        <input type="hidden" name="id_lop" value="<?= $idLop ?>">
        
        <div style="margin-bottom: 15px;">
            <label style="font-weight: bold;">Ngày điểm danh:</label>
            <input type="date" name="ngay_diem_danh" value="<?= date('Y-m-d') ?>" required 
                   style="padding: 8px; border-radius: 4px; border: 1px solid #ccc; margin-left: 10px;">
        </div>

        <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f8f9fa;">
                    <th align="left">Họ tên sinh viên</th>
                    <th style="width: 120px; text-align: center;">Có mặt</th>
                    <th style="width: 120px; text-align: center;">Vắng mặt</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sinhVien)): ?>
                    <?php foreach ($sinhVien as $sv): ?>
                    <tr>
                        <td><?= htmlspecialchars($sv->ho_ten) ?></td>
                        <td align="center">
                            <input type="radio" name="sv[<?= $sv->id ?>][trang_thai]" value="co_mat" checked>
                        </td>
                        <td align="center">
                            <input type="radio" name="sv[<?= $sv->id ?>][trang_thai]" value="vang_khong_phep">
                        </td>
                        <input type="hidden" name="sv[<?= $sv->id ?>][id]" value="<?= $sv->id ?>">
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="3" align="center" style="padding: 20px; color: #666;">Chưa có sinh viên trong lớp này.</td></tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if (!empty($sinhVien)): ?>
        <div style="margin-top: 20px; text-align: right;">
            <button type="submit" class="btn btn-primary" style="padding: 12px 40px; font-weight: bold; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 1em;">
             Lưu điểm danh
            </button>
        </div>
        <?php endif; ?>
    </form>
</div>

<?php include __DIR__.'/../layouts/footer.php'; ?>