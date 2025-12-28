<?php include __DIR__.'/../layouts/header.php'; ?>

<p>
    <a href="index.php?controller=admin&action=index" style="text-decoration: none; font-weight: bold;">
        ⬅️ Quay lại Trang chủ
    </a>
</p>

<h3>QUẢN LÝ MÔN HỌC</h3>

<table border="1" cellpadding="5" style="width: 100%; border-collapse: collapse;">
<tr>
    <th>ID</th>
    <th>Tên môn</th>
    <th>Số tín chỉ</th>
    <th>Hành động</th>
</tr>

<?php foreach ($monHoc as $m): ?>
<tr style="<?= (isset($editingMonHoc) && $editingMonHoc['id'] == $m['id']) ? 'background-color: #ffffcc;' : '' ?>">
    <td><?= $m['id'] ?></td>
    <td><?= $m['ten_mon'] ?></td>
    <td><?= $m['so_tin_chi'] ?></td>
    <td>
        <a href="index.php?controller=admin&action=monhoc&edit_id=<?= $m['id'] ?>">
           ✏️ Sửa
        </a>
        
        | 

        <a href="index.php?controller=admin&action=deleteMonHoc&id=<?= $m['id'] ?>"
           onclick="return confirm('Xóa môn học này?')">
           ❌ Xóa
        </a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<hr>

<?php if (isset($editingMonHoc)): ?>
    <h4 style="color: blue;">✏️ Đang sửa môn: <?= htmlspecialchars($editingMonHoc['ten_mon']) ?></h4>
    
    <form method="post" action="index.php?controller=admin&action=updateMonHoc&id=<?= $editingMonHoc['id'] ?>">
        <input name="ten_mon" value="<?= htmlspecialchars($editingMonHoc['ten_mon']) ?>" required>
        <input name="so_tin_chi" type="number" value="<?= htmlspecialchars($editingMonHoc['so_tin_chi']) ?>" required>
        
        <button type="submit">Lưu Cập Nhật</button>
        <a href="index.php?controller=admin&action=monhoc">Hủy bỏ</a>
    </form>

<?php else: ?>
    <h4>➕ Thêm môn học mới</h4>
    
    <form method="post" action="index.php?controller=admin&action=addMonHoc">
        <input name="ten_mon" placeholder="Tên môn" required>
        <input name="so_tin_chi" placeholder="Số tín chỉ" required>
        <button type="submit">Thêm Mới</button>
    </form>
<?php endif; ?>

<?php include __DIR__.'/../layouts/footer.php'; ?>