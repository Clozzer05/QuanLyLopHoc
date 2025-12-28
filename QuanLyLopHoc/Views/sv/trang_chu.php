<?php include __DIR__.'/../layouts/header.php'; ?>

<h3>LỚP CỦA TÔI</h3>

<ul>
<?php foreach ($lopDaDangKy as $lop): ?>
    <li>
        <b><?= $lop['ten_lop'] ?></b> (<?= $lop['hoc_ky'] ?>)
        <a href="/sinhvien/chitietlop/<?= $lop['id'] ?>">📄 Chi tiết</a>
        <a href="/sinhvien/baitap/<?= $lop['id'] ?>">📚 Bài tập</a>
        <a href="/sinhvien/tailieu/<?= $lop['id'] ?>">📂 Tài liệu</a>
    </li>
<?php endforeach; ?>
</ul>

<hr>

<a href="/sinhvien/dangky">➕ Đăng ký lớp mới</a>

<?php include __DIR__.'/../layouts/footer.php'; ?>
