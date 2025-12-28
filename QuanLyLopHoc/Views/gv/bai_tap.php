<?php include __DIR__.'/../layouts/header.php'; ?>

<h3>BÀI TẬP - <?= $lop['ten_lop'] ?></h3>

<table border="1">
<tr>
    <th>Tiêu đề</th>
    <th>Hạn nộp</th>
    <th>Hành động</th>
</tr>

<?php foreach ($baiTap as $bt): ?>
<tr>
    <td><?= $bt['tieu_de'] ?></td>
    <td><?= $bt['han_nop'] ?></td>
    <td>
        <a href="/giaovien/chamdiem/<?= $bt['id'] ?>">📝 Chấm điểm</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<h4>➕ Giao bài tập</h4>
<form method="post" action="/giaovien/addBaiTap">
    <input type="hidden" name="id_lop" value="<?= $lop['id'] ?>">
    <input name="tieu_de" placeholder="Tiêu đề">
    <input type="datetime-local" name="han_nop">
    <button>Giao bài</button>
</form>

<?php include __DIR__.'/../layouts/footer.php'; ?>
