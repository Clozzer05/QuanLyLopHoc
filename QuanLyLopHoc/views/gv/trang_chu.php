<?php include __DIR__.'/../layouts/header.php'; ?>

<style>
    .gv-container {
        padding: 20px 0;
    }
    .class-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 20px;
        margin-top: 20px;
    }
    .class-card {
        background: #fff;
        border-radius: 8px;
        padding: 20px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        border: 1px solid #eee;
    }
    .class-title {
        margin: 0 0 10px 0;
        color: #007bff;
        font-size: 1.3em;
    }
    .info-row {
        margin-bottom: 15px;
        font-size: 0.95em;
        color: #555;
    }
    .action-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 8px;
    }
    .btn-gv {
        display: block;
        padding: 10px;
        text-align: center;
        text-decoration: none;
        border-radius: 4px;
        font-weight: bold;
        font-size: 0.85em;
        border: none;
        color: #fff;
    }
    .btn-info { background-color: #007bff; }
    .btn-assign { background-color: #28a745; }
    .btn-checkin { background-color: #ffc107; color: #000 !important; }
    .btn-docs { background-color: #6c757d; }
    .btn-alert { 
        background-color: #dc3545; 
        grid-column: span 2; 
    }
</style>

<div class="gv-container">
    <h3 style="margin: 0; text-transform: uppercase;">Lớp đang giảng dạy</h3>

    <div class="class-grid">
        <?php if (!empty($lopHoc)): ?>
            <?php foreach ($lopHoc as $lop): ?>
                <div class="class-card">
                    <h4 class="class-title"><?= htmlspecialchars($lop->ten_lop) ?></h4>

                    <div class="info-row">
                        <strong>Học kỳ:</strong> <?= htmlspecialchars($lop->hoc_ky ?? 'HK1-2024') ?>
                    </div>

                    <div class="action-grid">
                        <a href="index.php?controller=giaovien&action=chitietlop&id=<?= $lop->id ?>" 
                           class="btn-gv btn-info">Điểm</a>

                        <a href="index.php?controller=giaovien&action=baitap&id_lop=<?= $lop->id ?>" 
                           class="btn-gv btn-assign">Bài tập</a>

                        <a href="index.php?controller=giaovien&action=diemdanh&id_lop=<?= $lop->id ?>" 
                           class="btn-gv btn-checkin">Điểm danh</a>

                        <a href="index.php?controller=giaovien&action=tailieu&id_lop=<?= $lop->id ?>" 
                           class="btn-gv btn-docs">Tài liệu</a>

                        <a href="index.php?controller=giaovien&action=thongbao&id_lop=<?= $lop->id ?>" 
                           class="btn-gv btn-alert">Thông báo</a>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p style="grid-column: 1/-1; text-align: center; padding: 50px; color: #666;">
                Hiện tại bạn chưa được phân công giảng dạy lớp nào.
            </p>
        <?php endif; ?>
    </div>
</div>

<?php include __DIR__.'/../layouts/footer.php'; ?>