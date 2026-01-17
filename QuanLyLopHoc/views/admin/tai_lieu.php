<?php include __DIR__.'/../layouts/header.php'; ?>

    <style>
        .page-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; }
        .btn-add { color: #fff; background-color: #28a745; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer; font-weight: bold; }
        .btn-add:hover { background-color: #218838; }
        .table-docs { width: 100%; border-collapse: collapse; margin-top: 10px; }
        .table-docs th, .table-docs td { border: 1px solid #ddd; padding: 12px; text-align: left; }
        .table-docs th { background-color: #f8f9fa; }
        .form-group { margin-bottom: 15px; }
        .form-control { width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        .file-input-wrapper { border: 1px dashed #ccc; padding: 20px; text-align: center; background: #f9f9f9; border-radius: 4px; }
        .modal { display: none; position: fixed; z-index: 1000; left: 0; top: 0; width: 100%; height: 100%; overflow: auto; background-color: rgba(0,0,0,0.5); }
        .modal-content { background-color: #fff; margin: 5% auto; padding: 30px; border: 1px solid #888; width: 90%; max-width: 600px; border-radius: 8px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); position: relative; }
        .close { position: absolute; top: 10px; right: 20px; font-size: 28px; font-weight: bold; cursor: pointer; color: #aaa; }
        .close:hover { color: #000; }
        .badge-global { background-color: #17a2b8; color: white; padding: 4px 8px; border-radius: 4px; font-size: 0.9em; font-weight: bold; }
    </style>

    <p><a href="index.php?controller=admin&action=index" style="text-decoration: none;">⬅️ Quay lại Trang chủ</a></p>

    <div class="page-header">
        <h3>QUẢN LÝ TÀI LIỆU HỆ THỐNG</h3>
        <button onclick="openModal()" class="btn-add">Thêm tài liệu mới</button>
    </div>

<?php if (!empty($taiLieu)): ?>
    <table class="table-docs">
        <thead>
        <tr>
            <th style="width: 50px;">ID</th>
            <th>Tiêu đề </th>
            <th>File đính kèm</th>
            <th>Phạm vi (Lớp)</th>
            <th style="width: 150px;">Hành động</th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($taiLieu as $tl): ?>
            <tr>
                <td><?= $tl->id ?></td>
                <td><?= htmlspecialchars($tl->tieu_de) ?></td>
                <td>
                    <?php if (!empty($tl->duong_dan_file)): ?>
                        <a href="public/uploads/tai_lieu/<?= htmlspecialchars($tl->duong_dan_file) ?>" target="_blank" style="color: #007bff; text-decoration: none;">
                             Tải xuống 
                        </a>
                    <?php else: ?>
                        <span style="color: #999;">Không có file</span>
                    <?php endif; ?>
                </td>
                <td>
                    <?php if (empty($tl->id_lop)): ?>
                        <span class="badge-global"> Toàn hệ thống</span>
                    <?php else: ?>
                    <span class="badge-global"> ID Lớp: <?= $tl->id_lop ?></span>
                    <?php endif; ?>
                </td>
                <td>
                    <a href="index.php?controller=admin&action=tailieu&edit_id=<?= $tl->id ?>">️ Sửa</a> |
                    <a href="index.php?controller=admin&action=deleteTaiLieu&id=<?= $tl->id ?>"
                       onclick="return confirm('Xóa tài liệu này?')" style="color: red;"> Xóa</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p> Chưa có tài liệu nào.</p>
<?php endif; ?>


<?php if (isset($editingTaiLieu) && is_object($editingTaiLieu)): ?>
<div id="modal-sua-tailieu" style="display:block; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3); z-index:999;">
  <div style="background:#fff; padding:24px; border-radius:8px; max-width:420px; margin:60px auto; position:relative;">
    <span style="position:absolute; top:8px; right:12px; cursor:pointer; font-size:20px;" onclick="window.location.href='index.php?controller=admin&action=tailieu'">&times;</span>
    <h4 style="color:blue;">Sửa tài liệu: <?= htmlspecialchars($editingTaiLieu->tieu_de) ?></h4>
    <form method="post" action="index.php?controller=admin&action=updateTaiLieu&id=<?= $editingTaiLieu->id ?>" enctype="multipart/form-data">
        <div class="form-group">
            <label>Tiêu đề tài liệu:</label>
            <input type="text" name="tieu_de" class="form-control" value="<?= htmlspecialchars($editingTaiLieu->tieu_de) ?>" required>
        </div>
        <div class="form-group">
            <label>File hiện tại:</label><br>
            <a href="public/uploads/tai_lieu/<?= $editingTaiLieu->duong_dan_file ?>" target="_blank"><?= basename($editingTaiLieu->duong_dan_file) ?></a>
            <input type="hidden" name="old_file" value="<?= $editingTaiLieu->duong_dan_file ?>">
        </div>
        <div class="form-group">
            <label>Chọn file mới (nếu muốn thay đổi):</label>
            <div class="file-input-wrapper">
                <input type="file" name="file_upload" class="form-control" accept=".pdf,.doc,.docx,.xls,.xlsx,.zip,.rar,.ppt,.pptx">
            </div>
        </div>
        <div class="form-group">
            <label>Phạm vi hiển thị:</label>
            <select name="id_lop" class="form-control">
                <option value="" <?= empty($editingTaiLieu->id_lop) ? 'selected' : '' ?> style="font-weight: bold; color: #17a2b8;">
                    Toàn hệ thống
                </option>
                <option disabled>──────────</option>
                <?php foreach ($lopHoc as $lop): ?>
                    <option value="<?= $lop->id ?>" <?= $lop->id == $editingTaiLieu->id_lop ? 'selected' : '' ?>>
                        <?= htmlspecialchars($lop->ten_lop) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <button type="submit" class="btn-add" style="width:100%;">Lưu cập nhật</button>
    </form>
  </div>
</div>
<?php endif; ?>

    <div id="modal-them-tailieu" class="modal">
        <div class="modal-content">
            <span class="close" onclick="document.getElementById('modal-them-tailieu').style.display='none'">&times;</span>
            <h3 style="margin-top: 0; color: #28a745;">Thêm tài liệu mới</h3>

            <form method="post" action="index.php?controller=admin&action=addTaiLieu" enctype="multipart/form-data">
                <div class="form-group">
                    <label style="font-weight: bold;">Tên hiển thị tài liệu:</label>
                    <input type="text" name="tieu_de" class="form-control" placeholder="Nhập tên tài liệu..." required>
                </div>

                <div class="form-group">
                    <label style="font-weight: bold;">Chọn file tài liệu:</label>
                    <div class="file-input-wrapper">
                        <input type="file" name="file_upload" required accept=".pdf,.doc,.docx,.xls,.xlsx,.zip,.rar,.ppt,.pptx" style="width: 100%;">
                    </div>
                </div>

                <div class="form-group">
                    <label style="font-weight: bold;">Phạm vi hiển thị:</label>
                    <select name="id_lop" class="form-control">
                        <option value="" style="font-weight: bold; color: #17a2b8;">Toàn hệ thống</option>
                        <option disabled>──────────</option>

                        <?php if(!empty($lopHoc)): ?>
                            <?php foreach ($lopHoc as $lop): ?>
                                <option value="<?= $lop->id ?>"><?= htmlspecialchars($lop->ten_lop) ?></option>
                            <?php endforeach; ?>
                        <?php endif; ?>
                    </select>
                </div>

                <button type="submit" class="btn-add" style="width: 100%; margin-top: 10px;"> Tải lên tài liệu</button>
            </form>
        </div>
    </div>

    <script>
        function openModal() { document.getElementById('modal-them-tailieu').style.display = "block"; }
        window.onclick = function(event) {
            var modal = document.getElementById('modal-them-tailieu');
            if (event.target == modal) modal.style.display = "none";
        }
    </script>

<?php include __DIR__.'/../layouts/footer.php'; ?>