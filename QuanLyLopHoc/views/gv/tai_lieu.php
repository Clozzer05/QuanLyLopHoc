<?php include __DIR__.'/../layouts/header.php'; ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h3 style="color: #007bff;">TÀI LIỆU - <?= htmlspecialchars($lop->ten_lop ?? 'Lớp học') ?></h3>
    <a href="index.php?controller=giaovien&action=index" 
       style="background: #000; color: #fff; text-decoration: none; padding: 8px 20px; border-radius: 4px; font-weight: bold; font-size: 0.9em;">
       Quay lại
    </a>
</div>

<div class="card" style="margin-bottom: 20px; padding: 20px;">
    <h4 style="margin-top: 0;">Thêm tài liệu mới</h4>
    <form action="index.php?controller=giaovien&action=addTaiLieu" method="POST" enctype="multipart/form-data" style="display: flex; gap: 10px;">
        <input type="hidden" name="id_lop" value="<?= $idLop ?>">
        <input type="text" name="ten_tai_lieu" placeholder="Tên hiển thị tài liệu" required style="flex: 1; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        <input type="file" name="file_tai_lieu" required>
        <button type="submit" style="background: #28a745; color: #fff; border: none; padding: 8px 20px; border-radius: 4px; cursor: pointer; font-weight: bold;">Tải lên</button>
    </form>
</div>

<div class="card">
    <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f8f9fa;">
                <th align="left">Tên tài liệu</th>
                <th style="width: 150px; text-align: center;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($taiLieu)): ?>
                <?php foreach ($taiLieu as $tl): ?>
                <tr>
                    <td>
                        <?php 
                            $ten = $tl->tieu_de ?? $tl->ten_tai_lieu ?? $tl->ten_file ?? 'Tài liệu';
                            echo htmlspecialchars((string)$ten); 
                        ?>
                    </td>
                    <td align="center">
                        <?php 
                            $file = $tl->file_path ?? $tl->duong_dan ?? $tl->url ?? '';
                        ?>
                        <?php if ($file): ?>
                            <a href="public/uploads/tai_lieu/<?= $file ?>" target="_blank" style="color: #007bff; text-decoration: underline; font-weight: bold;">Tải xuống</a>
                        <?php else: ?>
                            <span style="color: #999;">Trống</span>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="2" align="center" style="padding: 30px; color: #666;">Chưa có tài liệu nào trong lớp này.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__.'/../layouts/footer.php'; ?>