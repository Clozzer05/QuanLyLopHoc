<?php include __DIR__.'/../layouts/header.php'; ?>

<h3>BÀI TẬP - <?= $lop['ten_lop'] ?></h3>

<table border="1">
<tr>
    <th>Tiêu đề</th>
    <th>Hạn nộp</th>
    <th>Trạng thái</th>
    <th>Hành động</th>
</tr>

<?php foreach ($baiTap as $bt): ?>
<tr>
    <td><?= $bt['tieu_de'] ?></td>
    <td><?= $bt['han_nop'] ?></td>
    <td><?= $bt['da_nop'] ? 'Đã nộp' : 'Chưa nộp' ?></td>
    <td>
        <?php if (!$bt['da_nop']): ?>
        <form method="post" action="/sinhvien/nopbai" enctype="multipart/form-data">
            <input type="hidden" name="id_bai_tap" value="<?= $bt['id'] ?>">
            <input type="file" name="file">
            <button>Nộp bài</button>
        </form>
        <?php else: ?>
            ✔
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
</table>

<?php include __DIR__.'/../layouts/footer.php'; ?>
