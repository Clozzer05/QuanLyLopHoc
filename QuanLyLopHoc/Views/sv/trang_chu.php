<?php include __DIR__.'/../layouts/header.php'; ?>

    <h3>🎓 TRANG CHỦ SINH VIÊN</h3>

    <div style="margin-bottom: 20px;">
        <a href="index.php?controller=sinhvien&action=thongBao" style="font-weight: bold; color: red;">
            🔔 Xem thông báo mới nhất
        </a>
    </div>

    <h4>Danh sách lớp đang theo học:</h4>

<?php if (empty($lopHoc)): ?>
    <p>Bạn chưa đăng ký lớp học nào.</p>
<?php else: ?>
    <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse;">
        <tr style="background-color: #f2f2f2;">
            <th>ID Lớp</th>
            <th>Tên Lớp</th>
            <th>Môn Học</th>
            <th>Giáo Viên</th>
            <th>Hành động</th>
        </tr>
        <?php foreach ($lopHoc as $lop): ?>
            <tr>
                <td><?= $lop->id ?></td>
                <td><?= htmlspecialchars($lop->ten_lop) ?></td>
                <td><?= htmlspecialchars($lop->ten_mon ?? 'N/A') ?></td>
                <td><?= htmlspecialchars($lop->ten_giao_vien ?? 'N/A') ?></td>
                <td>
                    <a href="index.php?controller=sinhvien&action=baitap&id_lop=<?= $lop->id ?>">
                        📝 Làm bài tập
                    </a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
<?php endif; ?>

<?php include __DIR__.'/../layouts/footer.php'; ?>