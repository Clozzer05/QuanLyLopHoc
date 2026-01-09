<?php include __DIR__.'/../layouts/header.php'; ?>

    <p><a href="index.php?controller=admin&action=index">⬅️ Quay lại Trang chủ</a></p>

    <h3>QUẢN LÝ TÀI LIỆU HỆ THỐNG</h3>

    <table border="1" cellpadding="5" style="width: 100%; border-collapse: collapse;">
        <tr>
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Link / File</th>
            <th>Thuộc lớp</th>
            <th>Hành động</th>
        </tr>

        <?php foreach ($taiLieu as $tl): ?>
            <tr style="<?= (isset($editingTaiLieu) && $editingTaiLieu->id == $tl->id) ? 'background-color: #ffffcc;' : '' ?>">
                <td><?= $tl->id ?></td>
                <td><?= htmlspecialchars($tl->tieu_de) ?></td>
                <td>
                    <a href="<?= htmlspecialchars($tl->duong_dan_file) ?>" target="_blank">🔗 Mở link</a>
                </td>
                <td>ID Lớp: <?= $tl->id_lop ?></td>
                <td>
                    <a href="index.php?controller=admin&action=tailieu&edit_id=<?= $tl->id ?>">✏️ Sửa</a> |
                    <a href="index.php?controller=admin&action=deleteTaiLieu&id=<?= $tl->id ?>" onclick="return confirm('Xóa tài liệu này?')">❌ Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <hr>

<?php if (isset($editingTaiLieu)): ?>
    <h4 style="color: blue;">✏️ Đang sửa tài liệu: <?= htmlspecialchars($editingTaiLieu->tieu_de) ?></h4>
    <form method="post" action="index.php?controller=admin&action=updateTaiLieu&id=<?= $editingTaiLieu->id ?>">

        <div style="margin-bottom: 10px;">
            <label>Tiêu đề tài liệu:</label><br>
            <input name="tieu_de" value="<?= htmlspecialchars($editingTaiLieu->tieu_de) ?>" required style="width: 300px;">
        </div>

        <div style="margin-bottom: 10px;">
            <label>Link tài liệu (URL):</label><br>
            <input name="duong_dan_file" value="<?= htmlspecialchars($editingTaiLieu->duong_dan_file) ?>" required style="width: 300px;">
        </div>

        <div style="margin-bottom: 10px;">
            <label>Thuộc lớp:</label><br>
            <select name="id_lop" required style="width: 300px; height: 30px;">
                <?php foreach ($lopHoc as $lop): ?>
                    <option value="<?= $lop->id ?>" <?= $lop->id == $editingTaiLieu->id_lop ? 'selected' : '' ?>>
                        <?= $lop->ten_lop ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit">Lưu Cập Nhật</button>
        <a href="index.php?controller=admin&action=tailieu">Hủy bỏ</a>
    </form>

<?php else: ?>
    <h4>➕ Thêm tài liệu mới</h4>
    <form method="post" action="index.php?controller=admin&action=addTaiLieu">

        <div style="margin-bottom: 10px;">
            <label>Tiêu đề tài liệu:</label><br>
            <input name="tieu_de" placeholder="Ví dụ: Bài giảng Chương 1" required style="width: 300px;">
        </div>

        <div style="margin-bottom: 10px;">
            <label>Link tài liệu (URL):</label><br>
            <input name="duong_dan_file" placeholder="https://drive.google.com/..." required style="width: 300px;">
        </div>

        <div style="margin-bottom: 10px;">
            <label>Chọn lớp học:</label><br>
            <select name="id_lop" required style="width: 300px; height: 30px;">
                <option value="">-- Chọn lớp --</option>
                <?php foreach ($lopHoc as $lop): ?>
                    <option value="<?= $lop->id ?>"><?= $lop->ten_lop ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit">Thêm Mới</button>
    </form>
<?php endif; ?>

<?php include __DIR__.'/../layouts/footer.php'; ?>