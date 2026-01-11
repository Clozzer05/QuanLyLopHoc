<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Lớp học</title>
    <style>
        /* --- CẤU HÌNH CHUNG --- */
        :root {
            --primary-color: #007bff;
            --secondary-color: #6c757d;
            --success-color: #28a745;
            --danger-color: #dc3545;
            --bg-color: #f4f6f8;
            --white: #ffffff;
            --border-color: #ddd;
        }
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: var(--bg-color); margin: 0; color: #333; }
        a { text-decoration: none; color: var(--primary-color); }
        a:hover { text-decoration: underline; }

        /* --- LAYOUT --- */
        .container { max-width: 1000px; margin: 0 auto; padding: 20px; }
        .card { background: var(--white); border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); padding: 20px; margin-bottom: 20px; }
        .row { display: flex; gap: 20px; flex-wrap: wrap; }
        .col-half { flex: 1; min-width: 300px; }

        /* --- MENU --- */
        nav { background: var(--primary-color); padding: 15px 0; color: white; margin-bottom: 20px; }
        nav .container { display: flex; justify-content: space-between; align-items: center; padding: 0 20px; }
        nav a { color: white; margin-left: 20px; font-weight: bold; }
        nav a:hover { text-decoration: none; opacity: 0.8; }

        /* --- BẢNG (TABLE) --- */
        table { width: 100%; border-collapse: collapse; margin-top: 10px; background: white; }
        th, td { padding: 12px; border: 1px solid var(--border-color); text-align: left; }
        th { background-color: #f1f1f1; font-weight: bold; }
        tr:nth-child(even) { background-color: #f9f9f9; }

        /* --- FORM & BUTTON --- */
        input, select, textarea { width: 100%; padding: 10px; margin: 5px 0 15px; border: 1px solid #ccc; border-radius: 4px; box-sizing: border-box; }
        button, .btn { display: inline-block; padding: 10px 15px; border: none; border-radius: 4px; cursor: pointer; color: white; font-size: 14px; text-align: center; }
        .btn-primary { background-color: var(--primary-color); }
        .btn-success { background-color: var(--success-color); }
        .btn-danger { background-color: var(--danger-color); }
        .btn-sm { padding: 5px 10px; font-size: 12px; }
        button:hover { opacity: 0.9; }

        /* --- UTILS --- */
        h3 { border-bottom: 2px solid var(--primary-color); padding-bottom: 10px; color: var(--primary-color); }
        .actions { display: flex; gap: 5px; }
    </style>
</head>
<body>
<nav>
    <div class="container">
        <div class="brand">QUẢN LÝ LỚP HỌC</div>
        <div class="menu">
            <?php if (isset($_SESSION['user'])): ?>
                <?php 
                    $role = $_SESSION['user']->vai_tro; 
                    $homeController = 'sinhvien';
                    if ($role == 'gv') $homeController = 'giaovien';
                    if ($role == 'admin') $homeController = 'admin';
                ?>
                
                <a href="index.php?controller=<?= $homeController ?>&action=index">Trang chủ</a>
                <a href="index.php?controller=auth&action=logout">Đăng xuất</a>
            <?php else: ?>
                <a href="index.php?controller=auth&action=login">Đăng nhập</a>
            <?php endif; ?>
        </div>
    </div>
</nav>
<div class="container">