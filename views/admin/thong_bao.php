<?php include __DIR__ . '/../layouts/header.php'; ?>

<p>
    <a href="index.php?controller=admin&action=index">⬅️ Quay lại Trang chủ</a>
</p>

<h3>📢 QUẢN LÝ THÔNG BÁO</h3>

<table border="1" cellpadding="5" style="width:100%; border-collapse: collapse;">
    <tr>
        <th>ID</th>
        <th>Tiêu đề</th>
        <th>Nội dung</th>
        <th>Người gửi</th>
        <th>Lớp</th>
        <th>Hành động</th>
    </tr>

    <?php if (!empty($thongBao)): ?>
        <?php foreach ($thongBao as $tb): ?>
            <tr style="<?= (isset($editingThongBao) && $editingThongBao && $editingThongBao->id == $tb->id) ? 'background-color:#ffffcc;' : '' ?>">
                <td><?= $tb->id ?></td>
                <td><?= htmlspecialchars($tb->tieu_de) ?></td>
                <td><?= nl2br(htmlspecialchars($tb->noi_dung)) ?></td>
                <td><?= htmlspecialchars($tb->nguoi_gui) ?></td>
                <td><?= $tb->id_lop ?? 'Toàn hệ thống' ?></td>
                <td>
                    <a href="index.php?controller=admin&action=thongbao&edit_id=<?= $tb->id ?>">✏️ Sửa</a> |
                    <a href="index.php?controller=admin&action=deleteThongBao&id=<?= $tb->id ?>"
                       onclick="return confirm('Xóa thông báo này?')">❌ Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    <?php else: ?>
        <tr>
            <td colspan="6">Chưa có thông báo nào</td>
        </tr>
    <?php endif; ?>
</table>

<hr>

<?php if (isset($editingThongBao) && $editingThongBao): ?>
    <!-- FORM SỬA -->
    <h4 style="color: blue;">✏️ Sửa thông báo</h4>

    <form method="post"
          action="index.php?controller=admin&action=updateThongBao&id=<?= $editingThongBao->id ?>">

        <div style="margin-bottom:10px;">
            <label>Tiêu đề:</label><br>
            <input type="text" name="tieu_de"
                   value="<?= htmlspecialchars($editingThongBao->tieu_de) ?>"
                   required style="width:400px;">
        </div>

        <div style="margin-bottom:10px;">
            <label>Nội dung:</label><br>
            <textarea name="noi_dung" rows="5" required style="width:400px;"><?= htmlspecialchars($editingThongBao->noi_dung) ?></textarea>
        </div>

        <button type="submit">💾 Lưu cập nhật</button>
        <a href="index.php?controller=admin&action=thongbao">Hủy</a>
    </form>

<?php else: ?>
    <!-- FORM THÊM -->
    <h4>➕ Thêm thông báo mới</h4>

    <form method="post" action="index.php?controller=admin&action=addThongBao">

        <div style="margin-bottom:10px;">
            <label>Tiêu đề:</label><br>
            <input type="text" name="tieu_de" required style="width:400px;">
        </div>

        <div style="margin-bottom:10px;">
            <label>Nội dung:</label><br>
            <textarea name="noi_dung" rows="5" required style="width:400px;"></textarea>
        </div>

        <div style="margin-bottom:10px;">
            <label>Người gửi:</label><br>
            <input type="text" name="nguoi_gui" value="Admin" required style="width:400px;">
        </div>

        <div style="margin-bottom:10px;">
            <label>ID lớp (để trống = toàn hệ thống):</label><br>
            <input type="number" name="id_lop" style="width:200px;">
        </div>

        <button type="submit">➕ Thêm thông báo</button>
    </form>
<?php endif; ?>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
