<?php include __DIR__.'/../layouts/header.php'; ?>

<h2>Đăng nhập</h2>

<?php if (!empty($error)): ?>
    <p style="color:red"><?= $error ?></p>
<?php endif; ?>

<form method="post" action="index.php?controller=auth&action=login">
    <input type="text" name="ten_dang_nhap" placeholder="Tên đăng nhập" required><br><br>
    <input type="password" name="mat_khau" placeholder="Mật khẩu" required><br><br>
    <button type="submit">Đăng nhập</button>
</form>

<?php include __DIR__.'/../layouts/footer.php'; ?>
