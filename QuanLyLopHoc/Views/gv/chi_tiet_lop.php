<?php include __DIR__.'/../layouts/header.php'; ?>

<h3>CHI TIẾT LỚP: <?= $lop['ten_lop'] ?></h3>

<table border="1">
<tr>
    <th>Họ tên</th>
    <th>Giữa kỳ</th>
    <th>Cuối kỳ</th>
</tr>

<?php foreach ($sinhVien as $sv): ?>
<tr>
    <td><?= $sv['ho_ten'] ?></td>
    <td><?= $sv['diem_giua_ky'] ?></td>
    <td><?= $sv['diem_cuoi_ky'] ?></td>
</tr>
<?php endforeach; ?>
</table>

<?php include __DIR__.'/../layouts/footer.php'; ?>
