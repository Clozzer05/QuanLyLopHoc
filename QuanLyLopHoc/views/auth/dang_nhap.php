<?php include __DIR__.'/../layouts/header.php'; ?>

    <div style="width: 300px; margin: 50px auto; border: 1px solid #ddd; padding: 20px; border-radius: 5px; box-shadow: 0 0 10px rgba(0,0,0,0.1);">
        <h3 style="text-align: center;"> Đăng Nhập</h3>

        <?php if (!empty($error)): ?>
            <p class="error" style="text-align: center;"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="post" action="index.php?controller=auth&action=login">
            <div style="margin-bottom: 15px;">
                <label>Tên đăng nhập:</label><br>
                <input type="text" name="ten_dang_nhap" style="width: 100%; box-sizing: border-box;" required autofocus>
            </div>

            <div style="margin-bottom: 15px;">
                <label>Mật khẩu:</label><br>
                <input type="password" name="mat_khau" style="width: 100%; box-sizing: border-box;" required>
            </div>

            <button type="submit" style="width: 100%; background-color: #007bff; color: white; border: none; padding: 10px;">
                Đăng Nhập
            </button>
        </form>
    </div>

<?php include __DIR__.'/../layouts/footer.php'; ?>