<?php include __DIR__.'/../layouts/header.php'; ?>

<h3>THÔNG BÁO LỚP HỌC</h3>

<table border="1" cellpadding="5">
<tr>
    <th>Tiêu đề</th>
    <th>Nội dung</th>
    <th>Ngày tạo</th>
    <th>Hành động</th>
</tr>

<?php foreach ($thongBao as $tb): ?>
<tr>
    <td><?= $tb['tieu_de'] ?></td>
    <td><?= $tb['noi_dung'] ?></td>
    <td><?= $tb['ngay_tao'] ?></td>
    <td>
        <a href="/giaovien/deleteThongBao/<?= $tb['id'] ?>">❌ Xóa</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<hr>

<h4>➕ GỬI THÔNG BÁO MỚI</h4>

<form method="post" action="/giaovien/addThongBao">
    <input type="hidden" name="id_lop" value="<?= $idLop ?>">
    <p>
        <input name="tieu_de" placeholder="Tiêu đề" required>
    </p>
    <p>
        <textarea name="noi_dung" placeholder="Nội dung" required></textarea>
    </p>
    <button>Gửi thông báo</button>
</form>

<?php include __DIR__.'/../layouts/footer.php'; ?>
