<?php include __DIR__.'/../layouts/header.php'; ?>

<h3>CHI TIẾT LỚP: <?= $lop['ten_lop'] ?></h3>

<p><b>Môn:</b> <?= $lop['ten_mon'] ?></p>
<p><b>Giáo viên:</b> <?= $lop['ho_ten'] ?></p>

<h4>📊 KẾT QUẢ HỌC TẬP</h4>
<p>Điểm giữa kỳ: <?= $ketQua['diem_giua_ky'] ?? 'Chưa có' ?></p>
<p>Điểm cuối kỳ: <?= $ketQua['diem_cuoi_ky'] ?? 'Chưa có' ?></p>

<?php include __DIR__.'/../layouts/footer.php'; ?>
