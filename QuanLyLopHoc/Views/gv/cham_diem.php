<?php include __DIR__.'/../layouts/header.php'; ?>

<h3>CHẤM ĐIỂM</h3>

<table border="1">
<tr>
    <th>Sinh viên</th>
    <th>Bài làm</th>
    <th>Điểm</th>
    <th>Nhận xét</th>
</tr>

<?php foreach ($baiNop as $bn): ?>
<tr>
    <form method="post" action="/giaovien/saveDiem">
        <td><?= $bn['ho_ten'] ?></td>
        <td><a href="<?= $bn['file_bai_lam'] ?>">📥 Tải</a></td>
        <td>
            <input type="hidden" name="id" value="<?= $bn['id'] ?>">
            <input name="diem" value="<?= $bn['diem'] ?>">
        </td>
        <td>
            <input name="nhan_xet" value="<?= $bn['nhan_xet'] ?>">
        </td>
        <td>
            <button>Lưu</button>
        </td>
    </form>
</tr>
<?php endforeach; ?>
</table>

<?php include __DIR__.'/../layouts/footer.php'; ?>
