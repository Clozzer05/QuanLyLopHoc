<?php include __DIR__.'/../layouts/header.php'; ?>

<h3>TÀI LIỆU - <?= $lop['ten_lop'] ?></h3>

<ul>
<?php foreach ($taiLieu as $tl): ?>
    <li>
        <?= $tl['tieu_de'] ?>
        <a href="<?= $tl['duong_dan_file'] ?>">📥 Tải</a>
    </li>
<?php endforeach; ?>
</ul>

<h4>➕ Upload tài liệu</h4>
<form method="post" action="/giaovien/uploadTaiLieu" enctype="multipart/form-data">
    <input type="hidden" name="id_lop" value="<?= $lop['id'] ?>">
    <input name="tieu_de" placeholder="Tiêu đề">
    <input type="file" name="file">
    <button>Upload</button>
</form>

<?php include __DIR__.'/../layouts/footer.php'; ?>
