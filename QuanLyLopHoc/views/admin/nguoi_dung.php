<?php include __DIR__.'/../layouts/header.php'; ?>

    <p><a href="index.php?controller=admin&action=index">⬅️ Quay lại Trang chủ</a></p>

    <h3>QUẢN LÝ NGƯỜI DÙNG</h3>

    <table border="1" cellpadding="5" style="width: 100%; border-collapse: collapse;">
        <tr>
            <th>ID</th>
            <th>Tên đăng nhập</th>
            <th>Họ tên</th>
            <th>Vai trò</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($nguoiDung as $nd): ?>
            <tr style="<?= (isset($editingNguoiDung) && $editingNguoiDung->id == $nd->id) ? 'background-color: #ffffcc;' : '' ?>">
                <td><?= $nd->id ?></td>
                <td><?= htmlspecialchars($nd->ten_dang_nhap) ?></td>
                <td><?= htmlspecialchars($nd->ho_ten) ?></td>
                <td>
                    <?php
                    if ($nd->vai_tro == 'admin') echo 'Admin';
                    elseif ($nd->vai_tro == 'gv') echo 'Giáo viên';
                    else echo 'Sinh viên';
                    ?>
                </td>
                <td>
                    <a href="index.php?controller=admin&action=nguoidung&edit_id=<?= $nd->id ?>">✏️ Sửa</a> |
                    <a href="index.php?controller=admin&action=deleteNguoiDung&id=<?= $nd->id ?>" onclick="return confirm('Xóa người này?')">❌ Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <hr>

<?php if (isset($editingNguoiDung)): ?>
    <h4 style="color: blue;">✏️ Đang sửa: <?= htmlspecialchars($editingNguoiDung->ho_ten) ?></h4>
    <form method="post" action="index.php?controller=admin&action=updateNguoiDung&id=<?= $editingNguoiDung->id ?>">

        <label>Tên đăng nhập:</label><br>
        <input name="ten_dang_nhap" value="<?= htmlspecialchars($editingNguoiDung->ten_dang_nhap) ?>" required><br><br>

        <label>Mật khẩu:</label><br>
        <input name="mat_khau" type="password" placeholder="Nhập mật khẩu mới (Để trống nếu giữ nguyên)"><br><br>

        <label>Họ tên:</label><br>
        <input name="ho_ten" value="<?= htmlspecialchars($editingNguoiDung->ho_ten) ?>" required><br><br>

        <label>Vai trò:</label><br>
        <select name="vai_tro">
            <option value="sv" <?= $editingNguoiDung->vai_tro == 'sv' ? 'selected' : '' ?>>Sinh viên</option>
            <option value="gv" <?= $editingNguoiDung->vai_tro == 'gv' ? 'selected' : '' ?>>Giáo viên</option>
            <option value="admin" <?= $editingNguoiDung->vai_tro == 'admin' ? 'selected' : '' ?>>Admin</option>
        </select><br><br>

        <button type="submit">Lưu Cập Nhật</button>
        <a href="index.php?controller=admin&action=nguoidung">Hủy bỏ</a>
    </form>

<?php else: ?>
    <h4>➕ Thêm người dùng mới</h4>
    <form method="post" action="index.php?controller=admin&action=addNguoiDung">
        <input name="ten_dang_nhap" placeholder="Tên đăng nhập" required>
        <input name="mat_khau" type="password" placeholder="Mật khẩu" required>
        <input name="ho_ten" placeholder="Họ tên" required>
        <select name="vai_tro">
            <option value="sv">Sinh viên</option>
            <option value="gv">Giáo viên</option>
            <option value="admin">Admin</option>
        </select>
        <button type="submit">Thêm Mới</button>
    </form>
<?php endif; ?>

<?php include __DIR__.'/../layouts/footer.php'; ?>