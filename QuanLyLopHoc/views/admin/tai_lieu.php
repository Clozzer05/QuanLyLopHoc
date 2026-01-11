<?php include __DIR__.'/../layouts/header.php'; ?>

<p><a href="index.php?controller=admin&action=index">⬅️ Quay lại Trang chủ</a></p>

<h3>QUẢN LÝ TÀI LIỆU HỆ THỐNG</h3>
<div style="display: flex; justify-content: flex-end; align-items: center; margin-bottom: 10px;">
    <button onclick="document.getElementById('modal-them-tailieu').style.display='block'" style="color: #1976d2; font-weight: bold;">➕ Thêm tài liệu mới</button>
</div>

<?php if (!empty($tailieus)): ?>
    <table border="1" cellpadding="5" style="width: 100%; border-collapse: collapse;">
        <tr>
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Link / File</th>
            <th>Thuộc lớp</th>
            <th>Hành động</th>
        </tr>

        <?php foreach ($tailieus as $tl): ?>
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
<?php else: ?>
    <p>⚠️ Chưa có tài liệu nào.</p>
<?php endif; ?>

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
                        <?= htmlspecialchars($lop->ten_lop) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit">Lưu Cập Nhật</button>
        <a href="index.php?controller=admin&action=tailieu">Hủy bỏ</a>
    </form>



<?php endif; ?>

<div id="modal-them-tailieu" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3); z-index:999;">
  <div style="background:#fff; padding:24px; border-radius:8px; max-width:420px; margin:60px auto; position:relative;">
    <span style="position:absolute; top:8px; right:12px; cursor:pointer; font-size:20px;" onclick="document.getElementById('modal-them-tailieu').style.display='none'">&times;</span>
    <h4 style="color:#1976d2;">➕ Thêm tài liệu mới</h4>
    <form method="post" action="index.php?controller=admin&action=addTaiLieu">
        <div style="margin-bottom: 10px;">
            <label>Tiêu đề tài liệu:</label><br>
            <input name="tieu_de" placeholder="Ví dụ: Bài giảng Chương 1" required style="width:100%;">
        </div>
        <div style="margin-bottom: 10px;">
            <label>Link tài liệu (URL):</label><br>
            <input name="duong_dan_file" placeholder="https://drive.google.com/..." required style="width:100%;">
        </div>
        <div style="margin-bottom: 10px;">
            <label>Chọn lớp học:</label><br>
            <select name="id_lop" required style="width:100%; height: 30px;">
                <option value="">-- Chọn lớp --</option>
                <?php foreach ($lopHoc as $lop): ?>
                    <option value="<?= $lop->id ?>"><?= htmlspecialchars($lop->ten_lop) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" style="width:100%;">Thêm Mới</button>
    </form>
  </div>
</div>

<?php include __DIR__.'/../layouts/footer.php'; ?>
