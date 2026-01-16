<?php include __DIR__.'/../layouts/header.php'; ?>

<?php if (isset($_SESSION['success'])): ?>
    <div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #c3e6cb;">
        ✓ <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div style="background: #f8d7da; color: #721c24; padding: 12px; border-radius: 4px; margin-bottom: 15px; border: 1px solid #f5c6cb;">
        ✗ <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h3 style="color: #007bff;">TÀI LIỆU - <?= htmlspecialchars($lop->ten_lop ?? 'Lớp học') ?></h3>
    <a href="index.php?controller=giaovien&action=index" 
       style="background: #000; color: #fff; text-decoration: none; padding: 8px 20px; border-radius: 4px; font-weight: bold; font-size: 0.9em;">
       Quay lại
    </a>
</div>

<div class="card" style="margin-bottom: 20px; padding: 20px;">
    <h4 style="margin-top: 0;">Thêm tài liệu mới</h4>
    <form action="index.php?controller=giaovien&action=addTaiLieu" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_lop" value="<?= $idLop ?>">
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Tên hiển thị tài liệu:</label>
            <input type="text" name="ten_tai_lieu" placeholder="Nhập tên tài liệu" required 
                   style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Chọn file tài liệu:</label>
            <input type="file" name="file_tai_lieu" required 
                   accept=".pdf,.doc,.docx,.ppt,.pptx,.xls,.xlsx,.zip,.rar"
                   style="padding: 8px; border: 1px solid #ddd; border-radius: 4px; width: 100%; box-sizing: border-box;">
            <small style="color: #666;">Định dạng cho phép: PDF, Word, PowerPoint, Excel, ZIP, RAR</small>
        </div>
        
        <button type="submit" style="background: #28a745; color: #fff; border: none; padding: 10px 25px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 1em;">
             Tải lên tài liệu
        </button>
    </form>
</div>

<div class="card">
    <h4 style="margin-top: 0;">Danh sách tài liệu</h4>
    <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f8f9fa;">
                <th align="left">Tên tài liệu</th>
                <th style="width: 200px; text-align: center;">Ngày upload</th>
                <th style="width: 200px; text-align: center;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($taiLieu)): ?>
                <?php foreach ($taiLieu as $tl): ?>
                <tr>
                    <td>
                        <?= htmlspecialchars($tl->tieu_de ?? 'Tài liệu') ?>
                    </td>
                    <td align="center">
                        <?= isset($tl->ngay_upload) ? date('d/m/Y H:i', strtotime($tl->ngay_upload)) : 'N/A' ?>
                    </td>
                    <td align="center">
                        <?php 
                            $file = $tl->duong_dan_file ?? $tl->file_path ?? $tl->duong_dan ?? '';
                            $idTl = $tl->id ?? $tl->id_tai_lieu;
                        ?>
                        <?php if ($file): ?>
                            <a href="public/uploads/tai_lieu/<?= rawurlencode($file) ?>" target="_blank" 
                               style="color: #007bff; text-decoration: none; font-weight: bold; margin-right: 15px;">
                                 Xem  |
                            </a>
                        <?php endif; ?>

                        <a href="index.php?controller=giaovien&action=deleteTaiLieu&id=<?= $idTl ?>&id_lop=<?= $idLop ?>" 
                           onclick="return confirm('Bạn có chắc chắn muốn xóa tài liệu này?')"
                           style="color: #dc3545; text-decoration: none; font-weight: bold;">
                            Xóa
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="3" align="center" style="padding: 30px; color: #666;">Chưa có tài liệu nào trong lớp này.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php include __DIR__.'/../layouts/footer.php'; ?>