<?php include __DIR__.'/../layouts/header.php'; ?>

<h3>THÔNG BÁO</h3>

<table border="1" cellpadding="5">
<tr>
    <th>Tiêu đề</th>
    <th>Nội dung</th>
    <th>Người gửi</th>
    <th>Ngày tạo</th>
</tr>

<?php foreach ($thongBao as $tb): ?>
<tr>
    <td><?= $tb['tieu_de'] ?></td>
    <td><?= $tb['noi_dung'] ?></td>
    <td><?= $tb['ho_ten'] ?></td>
    <td><?= $tb['ngay_tao'] ?></td>
</tr>
<?php endforeach; ?>
</table>

<?php include __DIR__.'/../layouts/footer.php'; ?>
