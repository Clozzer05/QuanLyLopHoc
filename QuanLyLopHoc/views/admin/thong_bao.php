<?php include __DIR__ . '/../layouts/header.php'; ?>

<p>
    <a href="index.php?controller=admin&action=index">⬅️ Quay lại Trang chủ</a>
</p>

<h3>📢 QUẢN LÝ THÔNG BÁO</h3>
<div style="display: flex; justify-content: flex-end; align-items: center; margin-bottom: 10px;">
    <button onclick="document.getElementById('modal-them-thongbao').style.display='block'" style="color: #1976d2; font-weight: bold;">➕ Thêm thông báo mới</button>
</div>

<table border="1" cellpadding="5" style="width:100%; border-collapse: collapse;">
    <tr>
        <th>ID</th>
        <th>Tiêu đề</th>
        <th>Nội dung</th>
        <th>Người gửi</th>
        <th>Đến</th>
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
                    <a href="index.php?controller=admin&action=thongbao&edit_id=<?= $tb->id ?>">Sửa</a> |
                    <a href="index.php?controller=admin&action=deleteThongBao&id=<?= $tb->id ?>"
                       onclick="return confirm('Xóa thông báo này?')" style="color: red;"> Xóa</a>
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
    <h4 style="color: blue;">Sửa thông báo</h4>

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

        <button type="submit">Lưu cập nhật</button>
        <a href="index.php?controller=admin&action=thongbao">Hủy</a>
    </form>



<?php endif; ?>

<div id="modal-them-thongbao" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3); z-index:999;">
  <div style="background:#fff; padding:24px; border-radius:8px; max-width:420px; margin:60px auto; position:relative;">
    <span style="position:absolute; top:8px; right:12px; cursor:pointer; font-size:20px;" onclick="document.getElementById('modal-them-thongbao').style.display='none'">&times;</span>
    <h4 style="color:#1976d2;">➕ Thêm thông báo mới</h4>
    <form method="post" action="index.php?controller=admin&action=addThongBao">
        <div style="margin-bottom:10px;">
            <label>Tiêu đề:</label><br>
            <input type="text" name="tieu_de" required style="width:100%;">
        </div>
        <div style="margin-bottom:10px;">
            <label>Nội dung:</label><br>
            <textarea name="noi_dung" rows="5" required style="width:100%;"></textarea>
        </div>
        <div style="margin-bottom:10px;">
            <label>Người gửi:</label><br>
            <input type="text" name="nguoi_gui" value="Admin" required style="width:100%;">
        </div>
        <div style="margin-bottom:10px;">
            <label>Gửi đến lớp:</label><br>
            <select name="id_lop" style="width:100%;" required>
                <option value="">-- Toàn hệ thống --</option>
                <?php if (!empty($lopHoc)): ?>
                    <?php foreach ($lopHoc as $lop): ?>
                        <option value="<?= $lop->id ?>"><?= htmlspecialchars($lop->ten_lop) ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </div>
        <button type="submit" style="width:100%; padding: 10px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">Thêm Mới</button>
    </form>
  </div>
</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>
