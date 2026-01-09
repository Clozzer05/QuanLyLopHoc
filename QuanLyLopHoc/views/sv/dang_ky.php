<?php include __DIR__.'/../layouts/header.php'; ?>

<h3>ĐĂNG KÝ LỚP HỌC</h3>

<table border="1">
<tr>
    <th>Tên lớp</th>
    <th>Môn</th>
    <th>Giáo viên</th>
    <th>Hành động</th>
</tr>

<?php foreach ($lopMo as $lop): ?>
<tr>
    <td><?= $lop['ten_lop'] ?></td>
    <td><?= $lop['ten_mon'] ?></td>
    <td><?= $lop['ho_ten'] ?></td>
    <td>
        <a href="/sinhvien/dangky/<?= $lop['id'] ?>">➕ Đăng ký</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<?php include __DIR__.'/../layouts/footer.php'; ?>
