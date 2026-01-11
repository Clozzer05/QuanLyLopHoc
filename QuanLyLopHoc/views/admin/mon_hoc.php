<?php include __DIR__.'/../layouts/header.php'; ?>

    <p><a href="index.php?controller=admin&action=index">⬅️ Quay lại Trang chủ</a></p>

    <h3>QUẢN LÝ MÔN HỌC</h3>

        <div style="display: flex; justify-content: flex-end; align-items: center; margin-bottom: 10px;">
        <button onclick="document.getElementById('modal-them-monhoc').style.display='block'" style="color: #1976d2; font-weight: bold;">➕ Thêm môn học mới</button>
    </div>
    
    <table border="1" cellpadding="5" style="width: 100%; border-collapse: collapse;">
        <thead>
        <tr style="background-color: #f2f2f2;">
            <th>ID</th>
            <th>Tên Môn</th>
            <th>Số Tín Chỉ</th>
            <th>Hành Động</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($monHoc)):  ?>
            <?php foreach ($monHoc as $row): ?>
                <tr style="<?= (isset($editingMonHoc) && $editingMonHoc->id == $row->id) ? 'background-color: #ffffcc;' : '' ?>">
                    <td><?= $row->id ?></td>
                    <td><?= htmlspecialchars($row->ten_mon) ?></td>
                    <td><?= $row->so_tin_chi ?></td>
                    <td>
                        <a href="index.php?controller=admin&action=monhoc&edit_id=<?= $row->id ?>">️ Sửa</a> |
                        <a href="index.php?controller=admin&action=deleteMonHoc&id=<?= $row->id ?>"
                           onclick="return confirm('Xóa môn này?');" style="color: red;"> Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">Chưa có môn học nào.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <hr>



    <div id="modal-them-monhoc" style="display:none; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3); z-index:999;">
      <div style="background:#fff; padding:24px; border-radius:8px; max-width:420px; margin:60px auto; position:relative;">
        <span style="position:absolute; top:8px; right:12px; cursor:pointer; font-size:20px;" onclick="document.getElementById('modal-them-monhoc').style.display='none'">&times;</span>
        <h4 style="color:#1976d2;">➕ Thêm môn mới</h4>
        <form action="index.php?controller=admin&action=addMonHoc" method="POST">
            <div style="margin-bottom: 10px;">
                <label>Tên Môn:</label><br>
                <input type="text" name="ten_mon" placeholder="Nhập tên môn" required style="width: 100%;">
            </div>
            <div style="margin-bottom: 10px;">
                <label>Số Tín Chỉ:</label><br>
                <input type="number" name="so_tin_chi" value="3" required style="width: 100%;">
            </div>
            <button type="submit" style="width:100%; padding: 10px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">Thêm Mới</button>
        </form>
      </div>
    </div>

    <?php if (isset($editingMonHoc) && is_object($editingMonHoc)): ?>
    <div id="modal-sua-monhoc" style="display:block; position:fixed; top:0; left:0; width:100vw; height:100vh; background:rgba(0,0,0,0.3); z-index:999;">
      <div style="background:#fff; padding:24px; border-radius:8px; max-width:420px; margin:60px auto; position:relative;">
        <span style="position:absolute; top:8px; right:12px; cursor:pointer; font-size:20px;" onclick="window.location.href='index.php?controller=admin&action=monhoc'">&times;</span>
        <h4 style="color:blue;">️ Sửa môn: <?= htmlspecialchars($editingMonHoc->ten_mon) ?></h4>
        <form action="index.php?controller=admin&action=updateMonHoc&id=<?= $editingMonHoc->id ?>" method="POST">
            <div style="margin-bottom: 10px;">
                <label>Tên Môn:</label><br>
                <input type="text" name="ten_mon" value="<?= htmlspecialchars($editingMonHoc->ten_mon) ?>" required style="width: 100%;">
            </div>
            <div style="margin-bottom: 10px;">
                <label>Số Tín Chỉ:</label><br>
                <input type="number" name="so_tin_chi" value="<?= $editingMonHoc->so_tin_chi ?>" required style="width: 100%;">
            </div>
            <button type="submit" style="width:100%; padding: 10px; background: #28a745; color: white; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">Lưu Cập Nhật</button>
            <div style="text-align: center;">
                <a href="index.php?controller=admin&action=monhoc" style="display:inline-block; margin-top:10px;">Hủy</a>
            </div>
        </form>
      </div>
    </div>
    <?php endif; ?>

<?php include __DIR__.'/../layouts/footer.php'; ?>

