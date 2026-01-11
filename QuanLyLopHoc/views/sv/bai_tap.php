<?php include __DIR__.'/../layouts/header.php'; ?>

<div class="container">
    <div class="page-header">
        <h2 style="margin: 0; color: #1a202c;">DANH SÁCH BÀI TẬP</h2>
        <p style="color: #718096; margin-top: 5px;">Vui lòng kiểm tra hạn nộp và đính kèm file bài làm chính xác.</p>
    </div>

    <table class="assignment-table">
        <thead>
            <tr>
                <th width="20%">Tiêu đề</th>
                <th width="25%">Mô tả</th>
                <th width="15%">Hạn nộp</th>
                <th width="10%">Đề bài</th>
                <th width="30%">Nộp bài</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($baiTap)): ?>
                <?php foreach ($baiTap as $bt): ?>
                <tr>
                    <td>
                        <b style="color: #2d3748;"><?= htmlspecialchars($bt->tieu_de) ?></b>
                        <br>
                        <?php if (strtotime($bt->han_nop) >= time()): ?>
                            <span class="status-badge status-open">ĐANG MỞ</span>
                        <?php else: ?>
                            <span class="status-badge status-closed">HẾT HẠN</span>
                        <?php endif; ?>
                    </td>
                    <td style="font-size: 0.9em; color: #4a5568;">
                        <?= nl2br(htmlspecialchars($bt->mo_ta)) ?>
                    </td>
                    <td style="font-size: 0.9em; font-weight: 500;">
                        <?= date('d/m/Y H:i', strtotime($bt->han_nop)) ?>
                    </td>
                    <td>
                        <?php if ($bt->file_de_bai): ?>
                            <a href="public/uploads/bai_tap/<?= $bt->file_de_bai ?>" target="_blank" class="file-link">Tải đề bài</a>
                        <?php else: ?>
                            <span style="color: #a0aec0;">Không có</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if (strtotime($bt->han_nop) >= time()): ?>
                            <form action="index.php?controller=sinhvien&action=nopbai" method="POST" enctype="multipart/form-data" class="upload-group">
                                <input type="hidden" name="id_bai_tap" value="<?= $bt->id ?>">
                                <input type="file" name="file" required style="font-size: 0.85em;">
                                <button type="submit" class="btn btn-sm btn-primary" style="width: 100px; border-radius: 4px;">Nộp bài</button>
                            </form>
                        <?php else: ?>
                            <p style="color: #e53e3e; font-size: 0.9em; margin: 0;">Hệ thống đã khóa nộp bài</p>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" align="center" style="padding: 40px; color: #718096;">
                        Hiện tại không có bài tập nào cho lớp này.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <div style="margin-top: 25px;">
        <a href="index.php?controller=sinhvien&action=index" class="btn btn-secondary" style="padding: 10px 20px; border-radius: 6px;">Quay lại trang chủ</a>
    </div>
</div>

<?php include __DIR__.'/../layouts/footer.php'; ?>