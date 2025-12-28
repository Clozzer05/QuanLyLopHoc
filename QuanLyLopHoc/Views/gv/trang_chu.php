<?php include __DIR__.'/../layouts/header.php'; ?>

<h3>LỚP ĐANG GIẢNG DẠY</h3>

<ul>
<?php foreach ($lopHoc as $lop): ?>
    <li>
        <b><?= $lop['ten_lop'] ?></b> (<?= $lop['hoc_ky'] ?>)
        <a href="/giaovien/chitietlop/<?= $lop['id'] ?>">📄 Chi tiết</a>
        <a href="/giaovien/baitap/<?= $lop['id'] ?>">📚 Bài tập</a>
        <a href="/giaovien/diemdanh/<?= $lop['id'] ?>">📝 Điểm danh</a>
        <a href="/giaovien/tailieu/<?= $lop['id'] ?>">📂 Tài liệu</a>
    </li>
<?php endforeach; ?>
</ul>

<?php include __DIR__.'/../layouts/footer.php'; ?>
