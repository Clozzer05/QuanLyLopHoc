<?php include __DIR__.'/../layouts/header.php'; ?>

    <p><a href="index.php?controller=admin&action=index">⬅️ Quay lại Trang chủ</a></p>

    <h3>QUẢN LÝ LỚP HỌC</h3>

    <div style="display: flex; justify-content: flex-end; align-items: center; margin-bottom: 10px;">
        <button onclick="document.getElementById('modal-them-lop').style.display='block'" style="color: #1976d2; font-weight: bold;">➕ Thêm lớp học mới</button>
    </div>

    <table border="1" cellpadding="5" style="width: 100%; border-collapse: collapse;">
        <tr>
            <th>ID</th>
            <th>Tên lớp</th>
            <th>Môn học</th>
            <th>Giáo viên</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($lopHoc as $lop): ?>
            <tr style="<?= (isset($editingLopHoc) && $editingLopHoc->id == $lop->id) ? 'background-color: #ffffcc;' : '' ?>">
                <td><?= $lop->id ?></td>
                <td><?= htmlspecialchars($lop->ten_lop) ?></td>
                <td><?= $lop->ten_mon ?? '...' ?></td>

                <td><?= $lop->ten_giao_vien ?? $lop->ho_ten ?? '...' ?></td>

                <td>
                    <a href="index.php?controller=admin&action=lophoc&edit_id=<?= $lop->id ?>">✏️ Sửa</a> |
                    <a href="index.php?controller=admin&action=deleteLopHoc&id=<?= $lop->id ?>" onclick="return confirm('Xóa lớp này?')">❌ Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>

    <hr>

<?php if (isset($editingLopHoc)): ?>
    <h4 style="color: blue;">✏️ Đang sửa lớp: <?= htmlspecialchars($editingLopHoc->ten_lop) ?></h4>
    <form method="post" action="index.php?controller=admin&action=updateLopHoc&id=<?= $editingLopHoc->id ?>">
        <div style="margin-bottom: 10px;">
            <label>Tên lớp:</label><br>
            <input name="ten_lop" value="<?= htmlspecialchars($editingLopHoc->ten_lop) ?>" required>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Môn học:</label><br>
            <select name="id_mon_hoc">
                <?php foreach ($monHoc as $m): ?>
                    <option value="<?= $m->id ?>" <?= $m->id == $editingLopHoc->id_mon_hoc ? 'selected' : '' ?>>
                        <?= $m->ten_mon ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <div style="margin-bottom: 10px;">
            <label>Giáo viên:</label><br>
            <select name="id_giao_vien">
                <?php foreach ($giaoVien as $gv): ?>
                    <option value="<?= $gv->id ?>" <?= $gv->id == $editingLopHoc->id_giao_vien ? 'selected' : '' ?>>
                        <?= $gv->ho_ten ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>

        <button type="submit">Lưu Cập Nhật</button>
        <a href="index.php?controller=admin&action=lophoc">Hủy bỏ</a>
    </form>





<?php endif; ?>


<div id="modal-them-lop" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3); z-index:999;">
  <div style="background:#fff; padding:24px; border-radius:8px; max-width:400px; margin:60px auto; position:relative;">
    <span style="position:absolute; top:8px; right:12px; cursor:pointer; font-size:20px;" onclick="document.getElementById('modal-them-lop').style.display='none'">&times;</span>
    <h4>➕ Thêm lớp học mới</h4>
    <form method="post" action="index.php?controller=admin&action=addLopHoc">
        <input name="ten_lop" placeholder="Tên lớp" required style="width:100%;margin-bottom:10px;">

        <select name="id_mon_hoc" style="width:100%;margin-bottom:10px;">
            <option value="">-- Chọn môn học --</option>
            <?php foreach ($monHoc as $m): ?>
                <option value="<?= $m->id ?>"><?= $m->ten_mon ?></option>
            <?php endforeach; ?>
        </select>

        <select name="id_giao_vien" style="width:100%;margin-bottom:10px;">
            <option value="">-- Chọn giáo viên --</option>
            <?php foreach ($giaoVien as $gv): ?>
                <option value="<?= $gv->id ?>"><?= $gv->ho_ten ?></option>
            <?php endforeach; ?>
        </select>

        <button type="submit" style="width:100%;">Thêm Mới</button>
    </form>
  </div>
</div>

<?php include __DIR__.'/../layouts/footer.php'; ?>