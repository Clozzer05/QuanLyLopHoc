<?php include __DIR__.'/../layouts/header.php'; ?>

<h3>BÀI TẬP - <?= htmlspecialchars($lop->ten_lop ?? 'Lớp học') ?></h3>

<div class="card" style="margin-bottom: 20px; padding: 20px;">
    <h4 style="margin-top: 0;">Thêm bài tập mới</h4>
    <form action="index.php?controller=giaovien&action=addBaiTap" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_lop" value="<?= $idLop ?>">
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Tiêu đề bài tập:</label>
            <input type="text" name="tieu_de" placeholder="Nhập tiêu đề bài tập" required 
                   style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Mô tả:</label>
            <textarea name="mo_ta" placeholder="Mô tả chi tiết bài tập" rows="4" 
                      style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;"></textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Hạn nộp:</label>
            <input type="datetime-local" name="han_nop" required 
                   style="padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">File đề bài (tùy chọn):</label>
            <input type="file" name="file_de_bai" 
                   accept=".pdf,.doc,.docx,.zip,.rar"
                   style="padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
            <small style="color: #666; display: block; margin-top: 5px;">Hoặc chọn từ tài liệu đã có:</small>
            <select name="tai_lieu_lam_de_bai" style="padding: 8px; border: 1px solid #ddd; border-radius: 4px; margin-top: 5px; width: 100%;">
                <option value="">-- Không chọn --</option>
                <?php if (!empty($taiLieu)): ?>
                    <?php foreach ($taiLieu as $tl): ?>
                        <option value="<?= $tl->duong_dan_file ?? $tl->file_path ?>">
                            <?= htmlspecialchars($tl->tieu_de ?? 'Tài liệu') ?>
                        </option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        
        <button type="submit" style="background: #28a745; color: #fff; border: none; padding: 10px 25px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 1em;">
            ➕ Thêm bài tập
        </button>
    </form>
</div>

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
                        <?php if (!empty($bt->file_de_bai)): ?>
                            <br><a href="public/uploads/bai_tap/<?= $bt->file_de_bai ?>" target="_blank" style="color: #007bff; font-size: 0.9em;">📎 File đề bài</a>
                        <?php endif; ?>
                    </td>
                    <td align="center"><?= date('d/m/Y H:i', strtotime($bt->han_nop)) ?></td>
                    <td align="center">
                        <a href="index.php?controller=giaovien&action=viewNopBai&id=<?= $bt->id ?>" class="btn btn-sm btn-primary" style="text-decoration: none; display: inline-block; margin-bottom: 5px;">
                            📋 Xem bài nộp
                        </a>
                        <br>
                        <a href="index.php?controller=giaovien&action=deleteBaiTap&id=<?= $bt->id ?>&id_lop=<?= $idLop ?>" 
                           class="btn btn-sm btn-danger" 
                           style="text-decoration: none; display: inline-block;"
                           onclick="return confirm('Bạn có chắc muốn xóa bài tập này?')">
                            🗑️ Xóa
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