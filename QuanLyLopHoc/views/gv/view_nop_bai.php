<?php include __DIR__.'/../layouts/header.php'; ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h3>DANH SÁCH BÀI NỘP: <?= htmlspecialchars($baiTap->tieu_de ?? 'Bài tập') ?></h3>
    <a href="index.php?controller=giaovien&action=baitap&id_lop=<?= $baiTap->id_lop ?>" 
       style="background: #000; color: #fff; text-decoration: none; padding: 8px 20px; border-radius: 4px; font-weight: bold; font-size: 0.9em;">
       Quay lại
    </a>
</div>

<div class="card">
    <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>Họ tên sinh viên</th>
                <th style="text-align: center;">Thời gian nộp</th>
                <th style="text-align: center;">File bài làm</th>
                <th style="text-align: center;">Trạng thái</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($danhSachNop)): ?>
                <?php foreach ($danhSachNop as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item->ho_ten) ?></td>
                    <td align="center">
                        <?= date('d/m/Y H:i', strtotime($item->ngay_nop)) ?>
                    </td>
                    <td align="center">
                        <?php if (!empty($item->file_bai_lam)): ?>
                            <a href="public/uploads/bai_nop/<?= $item->file_bai_lam ?>" target="_blank" style="color: blue; text-decoration: underline;">
                                Tải bài làm
                            </a>
                        <?php else: ?>
                            <span style="color: #999;">Không có file</span>
                        <?php endif; ?>
                    </td>
                    <td align="center">
                        <?= isset($item->diem) ? "Đã chấm: " . $item->diem : "Chưa chấm" ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" align="center" style="padding: 20px; color: #666;">
                        Chưa có sinh viên nào nộp bài tập này.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__.'/../layouts/footer.php'; ?>