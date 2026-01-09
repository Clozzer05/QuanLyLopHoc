<?php include __DIR__.'/../layouts/header.php'; ?>

    <h3>THÔNG BÁO LỚP HỌC</h3>

    <div class="row">
        <div class="col-half" style="flex: 2;">
            <?php foreach ($thongBao as $tb): ?>
                <div class="card" style="border-left: 5px solid var(--primary-color);">
                    <div style="display: flex; justify-content: space-between;">
                        <h4 style="margin: 0; color: var(--primary-color);"><?= $tb['tieu_de'] ?></h4>
                        <small style="color: #888;"><?= $tb['ngay_tao'] ?></small>
                    </div>
                    <p><?= nl2br($tb['noi_dung']) ?></p>
                    <div style="text-align: right;">
                        <a href="/giaovien/deleteThongBao/<?= $tb['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Xóa thông báo này?')">Xóa</a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <div class="col-half" style="flex: 1;">
            <div class="card">
                <h4>➕ Gửi thông báo mới</h4>
                <form method="post" action="/giaovien/addThongBao">
                    <input type="hidden" name="id_lop" value="<?= $idLop ?>">
                    <input name="tieu_de" placeholder="Tiêu đề" required>
                    <textarea name="noi_dung" placeholder="Nội dung" rows="5" required></textarea>
                    <button class="btn btn-primary" style="width: 100%;">Gửi thông báo</button>
                </form>
            </div>
        </div>
    </div>

<?php include __DIR__.'/../layouts/footer.php'; ?>