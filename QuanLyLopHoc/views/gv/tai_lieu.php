<?php include __DIR__.'/../layouts/header.php'; ?>

    <h3>TÀI LIỆU - <?= $lop['ten_lop'] ?></h3>

    <div class="row">
        <div class="card" style="flex: 2;">
            <h4>Danh sách tài liệu</h4>
            <?php if(empty($taiLieu)): ?>
                <p style="color: #777; font-style: italic;">Chưa có tài liệu nào.</p>
            <?php else: ?>
                <ul style="list-style: none; padding: 0;">
                    <?php foreach ($taiLieu as $tl): ?>
                        <li style="border-bottom: 1px solid #eee; padding: 10px 0; display: flex; justify-content: space-between;">
                            <span>📄 <?= $tl['tieu_de'] ?></span>
                            <a href="<?= $tl['duong_dan_file'] ?>" class="btn btn-sm btn-secondary">📥 Tải về</a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>

        <div class="card" style="flex: 1; height: fit-content;">
            <h4>➕ Upload tài liệu</h4>
            <form method="post" action="/giaovien/uploadTaiLieu" enctype="multipart/form-data">
                <input type="hidden" name="id_lop" value="<?= $lop['id'] ?>">

                <label>Tiêu đề:</label>
                <input name="tieu_de" placeholder="Nhập tiêu đề" required>

                <label>File:</label>
                <input type="file" name="file" required style="border: none; padding-left: 0;">

                <button class="btn btn-success" style="width: 100%;">Upload</button>
            </form>
        </div>
    </div>

<?php include __DIR__.'/../layouts/footer.php'; ?>