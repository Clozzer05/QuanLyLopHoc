<?php include __DIR__.'/../layouts/header.php'; ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h3>CHI TIẾT ĐIỂM DANH: <?= htmlspecialchars($lop->ten_lop) ?></h3>
    <a href="index.php?controller=giaovien&action=diemdanh&id_lop=<?= $idLop ?>" class="btn" style="background: #6c757d; color: #fff; text-decoration: none; padding: 8px 15px; border-radius: 4px;">Quay lại điểm danh</a>
</div>

<div class="card" style="margin-bottom: 20px; padding: 20px;">
    <form action="index.php" method="GET" style="display: flex; gap: 10px; align-items: center;">
        <input type="hidden" name="controller" value="giaovien">
        <input type="hidden" name="action" value="xemLichSuDiemDanh">
        <input type="hidden" name="id_lop" value="<?= $idLop ?>">
        <label><b>Ngày cần xem:</b></label>
        <input type="date" name="ngay_xem" value="<?= $ngayXem ?>" style="padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
        <button type="submit" style="background: #007bff; color: white; border: none; padding: 8px 20px; border-radius: 4px; cursor: pointer;">🔍 Tra cứu</button>
    </form>
</div>

<table border="1" style="width: 100%; border-collapse: collapse; background: #fff;">
    <thead>
        <tr style="background: #f8f9fa;">
            <th style="padding: 12px; text-align: left;">Họ tên sinh viên</th>
            <th style="width: 200px; text-align: center;">Trạng thái ghi nhận</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($lichSu)): ?>
            <?php foreach ($lichSu as $item): ?>
                <tr>
                    <td style="padding: 12px; border-bottom: 1px solid #eee;"><?= htmlspecialchars($item->ho_ten) ?></td>
                    <td align="center" style="border-bottom: 1px solid #eee;">
                        <?php if ($item->trang_thai == 'co_mat'): ?>
                            <span style="color: #28a745; font-weight: bold; background: #d4edda; padding: 5px 15px; border-radius: 20px;">✓ CÓ MẶT</span>
                        <?php else: ?>
                            <span style="color: #dc3545; font-weight: bold; background: #f8d7da; padding: 5px 15px; border-radius: 20px;">✗ VẮNG MẶT</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="2" align="center" style="padding: 30px; color: #666;">Chưa có dữ liệu điểm danh cho ngày này.</td></tr>
        <?php endif; ?>
    </tbody>
</table>

<?php include __DIR__.'/../layouts/footer.php'; ?>