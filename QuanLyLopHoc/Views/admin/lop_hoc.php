<?php include __DIR__.'/../layouts/header.php'; ?>

<p><a href="index.php?controller=admin&action=index">⬅️ Quay lại Trang chủ</a></p>

<h3>QUẢN LÝ LỚP HỌC</h3>

<table border="1" cellpadding="5" style="width: 100%; border-collapse: collapse;">
<tr>
    <th>ID</th>
    <th>Tên lớp</th>
    <th>Môn học</th>
    <th>Giáo viên</th>
    <th>Hành động</th>
</tr>
<?php foreach ($lopHoc as $lop): ?>
<tr style="<?= (isset($editingLopHoc) && $editingLopHoc['id'] == $lop['id']) ? 'background-color: #ffffcc;' : '' ?>">
    <td><?= $lop['id'] ?></td>
    <td><?= $lop['ten_lop'] ?></td>
    <td><?= $lop['ten_mon'] ?? '...' ?></td>
    <td><?= $lop['ho_ten'] ?? '...' ?></td>
    <td>
        <a href="index.php?controller=admin&action=lophoc&edit_id=<?= $lop['id'] ?>">✏️ Sửa</a> | 
        <a href="index.php?controller=admin&action=deleteLopHoc&id=<?= $lop['id'] ?>" onclick="return confirm('Xóa lớp này?')">❌ Xóa</a>
    </td>
</tr>
<?php endforeach; ?>
</table>

<hr>

<?php if (isset($editingLopHoc)): ?>
    <h4 style="color: blue;">✏️ Đang sửa lớp: <?= htmlspecialchars($editingLopHoc['ten_lop']) ?></h4>
    <form method="post" action="index.php?controller=admin&action=updateLopHoc&id=<?= $editingLopHoc['id'] ?>">
        <div style="margin-bottom: 10px;">
            <label>Tên lớp:</label><br>
            <input name="ten_lop" value="<?= htmlspecialchars($editingLopHoc['ten_lop']) ?>" required>
        </div>
        <div style="margin-bottom: 10px;">
            <label>Môn học:</label><br>
            <select name="id_mon_hoc">
                <?php foreach ($monHoc as $m): ?>
                    <option value="<?= $m['id'] ?>" <?= $m['id'] == $editingLopHoc['id_mon_hoc'] ? 'selected' : '' ?>>
                        <?= $m['ten_mon'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div style="margin-bottom: 10px;">
            <label>Giáo viên:</label><br>
            <select name="id_giao_vien">
                <?php foreach ($giaoVien as $gv): ?>
                    <option value="<?= $gv['id'] ?>" <?= $gv['id'] == $editingLopHoc['id_giao_vien'] ? 'selected' : '' ?>>
                        <?= $gv['ho_ten'] ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit">Lưu Cập Nhật</button>
        <a href="index.php?controller=admin&action=lophoc">Hủy bỏ</a>
    </form>

<?php else: ?>
    <h4>➕ Thêm lớp học mới</h4>
    <form method="post" action="index.php?controller=admin&action=addLopHoc">
        <input name="ten_lop" placeholder="Tên lớp" required>
        <select name="id_mon_hoc">
            <option value="">-- Chọn môn học --</option>
            <?php foreach ($monHoc as $m): ?>
                <option value="<?= $m['id'] ?>"><?= $m['ten_mon'] ?></option>
            <?php endforeach; ?>
        </select>
        <select name="id_giao_vien">
            <option value="">-- Chọn giáo viên --</option>
            <?php foreach ($giaoVien as $gv): ?>
                <option value="<?= $gv['id'] ?>"><?= $gv['ho_ten'] ?></option>
            <?php endforeach; ?>
        </select>
        <button type="submit">Thêm Mới</button>
    </form>
<?php endif; ?>

<?php include __DIR__.'/../layouts/footer.php'; ?>