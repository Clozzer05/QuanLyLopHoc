<?php include __DIR__.'/../layouts/header.php'; ?>

<h3>TRANG QUẢN TRỊ</h3>

<ul>
    <li>
        <a href="index.php?controller=admin&action=monhoc">
            📘 Quản lý môn học
        </a>
    </li>

    <li>
        <a href="index.php?controller=admin&action=lophoc">
            🏫 Quản lý lớp học
        </a>
    </li>

    <li>
        <a href="index.php?controller=admin&action=nguoidung">
            👤 Quản lý người dùng
        </a>
    </li>

    <li>
        <a href="index.php?controller=admin&action=tailieu">
            📂 Quản lý tài liệu
        </a>
    </li>

    <!-- ✅ THÊM MỚI -->
    <li>
        <a href="index.php?controller=admin&action=thongbao">
            📢 Quản lý thông báo
        </a>
    </li>
</ul>

<?php include __DIR__.'/../layouts/footer.php'; ?>
