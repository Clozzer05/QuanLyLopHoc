<?php include __DIR__.'/../layouts/header.php'; ?>

<h3>BÀI TẬP - <?= htmlspecialchars($lop->ten_lop ?? 'Lớp học') ?></h3>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <h4>Danh sách bài đã giao</h4>
        <a href="index.php?controller=giaovien&action=index" 
           style="background: #000; color: #fff; padding: 5px 15px; text-decoration: none; border-radius: 4px; font-size: 0.9em; font-weight: bold;">
           Quay lại
        </a>
    </div>

    <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>Tiêu đề</th>
                <th style="width: 150px; text-align: center;">Hạn nộp</th>
                <th style="width: 150px; text-align: center;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($baiTap)): ?>
                <?php foreach ($baiTap as $bt): ?>
                <tr>
                    <td>
                        <b><?= htmlspecialchars($bt->tieu_de) ?></b>
                        <br><small><?= htmlspecialchars($bt->mo_ta) ?></small>
                    </td>
                    <td align="center"><?= date('d/m/Y H:i', strtotime($bt->han_nop)) ?></td>
                    <td align="center">
                        <a href="index.php?controller=giaovien&action=viewNopBai&id=<?= $bt->id ?>" class="btn btn-sm btn-primary" style="text-decoration: none;">
                            Xem bài nộp
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3" align="center">Chưa có bài tập nào được giao.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__.'/../layouts/footer.php'; ?>