<?php include __DIR__.'/../layouts/header.php'; ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h3>THÔNG BÁO LỚP HỌC</h3>
    <a href="index.php?controller=giaovien&action=index" 
       style="background: #000; color: #fff; text-decoration: none; padding: 8px 20px; border-radius: 4px; font-weight: bold; font-size: 0.9em;">
       Quay lại
    </a>
</div>

<div class="row" style="display: flex; gap: 20px;">
    <div class="col-half" style="flex: 2;">
        <?php if (!empty($thongBao)): ?>
            <?php foreach ($thongBao as $tb): ?>
                <div class="card" style="border-left: 5px solid #007bff; margin-bottom: 15px; padding: 15px; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                    <div style="display: flex; justify-content: space-between; align-items: flex-start;">
                        <h4 style="margin: 0; color: #007bff;"><?= htmlspecialchars($tb->tieu_de) ?></h4>
                        <small style="color: #888;">
                            <?= htmlspecialchars($tb->ngay_tao ?? $tb->ngay_dang ?? 'N/A') ?>
                        </small>
                    </div>
                    <p style="margin: 15px 0; line-height: 1.5;"><?= nl2br(htmlspecialchars($tb->noi_dung)) ?></p>
                    <div style="text-align: right;">
                        <a href="index.php?controller=giaovien&action=deleteThongBao&id=<?= $tb->id ?>&id_lop=<?= $idLop ?>" 
                           class="btn btn-danger btn-sm" 
                           style="text-decoration: none; font-size: 0.8em;"
                           onclick="return confirm('Xóa thông báo này?')">Xóa</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <div class="card" style="text-align: center; color: #666;">Chưa có thông báo nào.</div>
        <?php endif; ?>
    </div>

    <div class="col-half" style="flex: 1;">
        <div class="card" style="padding: 20px; background: #fff; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
            <h4 style="margin-top: 0; margin-bottom: 15px;">Gửi thông báo mới</h4>
            <form method="post" action="index.php?controller=giaovien&action=addThongBao">
                <input type="hidden" name="id_lop" value="<?= $idLop ?>">
                
                <div style="margin-bottom: 10px;">
                    <input name="tieu_de" placeholder="Tiêu đề" required 
                           style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
                </div>
                
                <div style="margin-bottom: 10px;">
                    <textarea name="noi_dung" placeholder="Nội dung" rows="5" required 
                              style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;"></textarea>
                </div>
                
                <button type="submit" class="btn btn-primary" style="width: 100%; padding: 10px; font-weight: bold;">Gửi thông báo</button>
            </form>
        </div>
    </div>
</div>

<?php include __DIR__.'/../layouts/footer.php'; ?>