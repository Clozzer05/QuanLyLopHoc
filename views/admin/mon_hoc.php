<?php include __DIR__.'/../layouts/header.php'; ?>

    <p><a href="index.php?controller=admin&action=index">⬅️ Quay lại Dashboard</a></p>

    <h3>QUẢN LÝ MÔN HỌC</h3>

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
        <?php if (!empty($monHoc)): // Kiểm tra xem có dữ liệu không ?>
            <?php foreach ($monHoc as $row): ?>
                <tr style="<?= (isset($editingMonHoc) && $editingMonHoc->id == $row->id) ? 'background-color: #ffffcc;' : '' ?>">
                    <td><?= $row->id ?></td>
                    <td><?= htmlspecialchars($row->ten_mon) ?></td>
                    <td><?= $row->so_tin_chi ?></td>
                    <td>
                        <a href="index.php?controller=admin&action=monhoc&edit_id=<?= $row->id ?>">✏️ Sửa</a> |
                        <a href="index.php?controller=admin&action=deleteMonHoc&id=<?= $row->id ?>"
                           onclick="return confirm('Xóa môn này?');">❌ Xóa</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="4">Chưa có môn học nào.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>

    <hr>

    <div style="width: 50%; background: #f9f9f9; padding: 20px; border: 1px solid #ddd;">
        <?php if (isset($editingMonHoc)): ?>
            <h4 style="color: blue;">✏️ Sửa môn: <?= htmlspecialchars($editingMonHoc->ten_mon) ?></h4>
            <form action="index.php?controller=admin&action=updateMonHoc&id=<?= $editingMonHoc->id ?>" method="POST">
                <div style="margin-bottom: 10px;">
                    <label>Tên Môn:</label><br>
                    <input type="text" name="ten_mon" value="<?= htmlspecialchars($editingMonHoc->ten_mon) ?>" required style="width: 100%;">
                </div>
                <div style="margin-bottom: 10px;">
                    <label>Số Tín Chỉ:</label><br>
                    <input type="number" name="so_tin_chi" value="<?= $editingMonHoc->so_tin_chi ?>" required style="width: 100%;">
                </div>
                <button type="submit">Lưu Cập Nhật</button>
                <a href="index.php?controller=admin&action=monhoc">Hủy</a>
            </form>
        <?php else: ?>
            <h4 style="color: green;">➕ Thêm Môn Mới</h4>
            <form action="index.php?controller=admin&action=addMonHoc" method="POST">
                <div style="margin-bottom: 10px;">
                    <label>Tên Môn:</label><br>
                    <input type="text" name="ten_mon" placeholder="Nhập tên môn" required style="width: 100%;">
                </div>
                <div style="margin-bottom: 10px;">
                    <label>Số Tín Chỉ:</label><br>
                    <input type="number" name="so_tin_chi" value="3" required style="width: 100%;">
                </div>
                <button type="submit">Thêm Mới</button>
            </form>
        <?php endif; ?>
    </div>

<?php include __DIR__.'/../layouts/footer.php'; ?>