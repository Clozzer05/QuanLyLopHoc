<?php include __DIR__.'/../layouts/header.php'; ?>

<h3>ĐIỂM DANH - <?= $lop['ten_lop'] ?></h3>

<form method="post" action="/giaovien/luuDiemDanh">
<input type="date" name="ngay_diem_danh" required>

<?php foreach ($sinhVien as $sv): ?>
<p>
    <?= $sv['ho_ten'] ?>
    <select name="trang_thai[<?= $sv['id'] ?>]">
        <option value="co_mat">Có mặt</option>
        <option value="vang_co_phep">Vắng có phép</option>
        <option value="vang_khong_phep">Vắng không phép</option>
    </select>
</p>
<?php endforeach; ?>

<button>Lưu điểm danh</button>
</form>

<?php include __DIR__.'/../layouts/footer.php'; ?>
