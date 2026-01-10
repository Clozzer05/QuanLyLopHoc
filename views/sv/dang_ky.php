<?php include __DIR__.'/../layouts/header.php'; ?>

<div class="reg-container">
    <div class="reg-header">
        <h2 style="margin: 0; color: #1a202c;">ĐĂNG KÝ LỚP HỌC MỚI</h2>
        <p style="color: #718096; margin-top: 5px;">Chọn các lớp học đang mở để ghi danh vào học kỳ này.</p>
    </div>

    <?php if (!empty($lopMo)): ?>
        <table class="reg-table">
            <thead>
                <tr>
                    <th width="25%">Tên lớp</th>
                    <th width="30%">Môn học</th>
                    <th width="25%">Giáo viên</th>
                    <th width="20%" style="text-align: center;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lopMo as $lop): ?>
                <tr>
                    <td><b style="color: #2b6cb0;"><?= htmlspecialchars($lop->ten_lop) ?></b></td>
                    <td><?= htmlspecialchars($lop->ten_mon) ?></td>
                    <td><?= htmlspecialchars($lop->ho_ten) ?></td>
                    <td align="center">
                        <a href="index.php?controller=sinhvien&action=thucHienDangKy&id_lop=<?= $lop->id ?>" 
                           class="btn-register" 
                           onclick="return confirm('Bạn chắc chắn muốn đăng ký lớp này?')">
                            Đăng ký ngay
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="empty-state">
            <p style="font-size: 1.1em; margin: 0;">Hiện không có lớp nào mở để đăng ký hoặc bạn đã đăng ký hết các lớp hiện có.</p>
        </div>
    <?php endif; ?>

<div style="margin-top: 20px;">
    <a href="index.php?controller=sinhvien&action=index" 
       class="btn" 
       style="background-color: #000000; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-weight: bold;">
       Quay lại trang chủ
    </a>
</div>

<?php include __DIR__.'/../layouts/footer.php'; ?>