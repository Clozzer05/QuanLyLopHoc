<?php include __DIR__.'/../layouts/header.php'; ?>

    <h3>LỚP ĐANG GIẢNG DẠY</h3>

    <div class="row">
        <?php foreach ($lopHoc as $lop): ?>
            <div class="card col-half" style="flex: 0 0 calc(33.33% - 20px);">
                <h4 style="margin-top: 0; color: var(--primary-color);"><?= $lop->ten_lop ?></h4>

                <p><strong>Học kỳ:</strong> <?= $lop->hoc_ky ?? 'N/A' ?></p>

                <hr style="border: 0; border-top: 1px solid #eee;">

                <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 5px;">
                    <a href="index.php?controller=gv&action=chitietlop&id=<?= $lop->id ?>"
                       class="btn btn-primary btn-sm">📄 Chi tiết</a>

                    <a href="index.php?controller=gv&action=baitap&id_lop=<?= $lop->id ?>"
                       class="btn btn-success btn-sm">📚 Bài tập</a>

                    <a href="index.php?controller=gv&action=diemdanh&id_lop=<?= $lop->id ?>"
                       class="btn btn-primary btn-sm" style="background: #e0a800;">📝 Điểm danh</a>

                    <a href="index.php?controller=gv&action=tailieu&id_lop=<?= $lop->id ?>"
                       class="btn btn-secondary btn-sm">📂 Tài liệu</a>

                    <a href="index.php?controller=gv&action=thongbao&id_lop=<?= $lop->id ?>"
                       class="btn btn-danger btn-sm" style="grid-column: span 2;">🔔 Thông báo</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

<?php include __DIR__.'/../layouts/footer.php'; ?>