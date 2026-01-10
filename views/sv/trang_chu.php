<?php include __DIR__.'/../layouts/header.php'; ?>

<style>
    .home-container {
        max-width: 1100px;
        margin: 20px auto;
        padding: 0 15px;
    }
    .welcome-card {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        margin-bottom: 25px;
        border-left: 5px solid #007bff;
    }
    .header-flex {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .alert-link {
        background: #fff5f5;
        color: #e53e3e;
        padding: 10px 15px;
        border-radius: 8px;
        border: 1px solid #feb2b2;
        text-decoration: none;
        font-weight: 600;
        transition: 0.3s;
    }
    .alert-link:hover {
        background: #fed7d7;
    }
    .custom-table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 6px rgba(0,0,0,0.05);
    }
    .custom-table th {
        background-color: #f8fafc;
        color: #4a5568;
        font-weight: 600;
        padding: 15px;
        text-align: left;
        border-bottom: 2px solid #edf2f7;
    }
    .custom-table td {
        padding: 15px;
        border-bottom: 1px solid #edf2f7;
        color: #2d3748;
    }
    .custom-table tr:last-child td {
        border-bottom: none;
    }
    .custom-table tr:hover {
        background-color: #f7fafc;
    }
    .badge-id {
        background: #edf2f7;
        color: #4a5568;
        padding: 4px 8px;
        border-radius: 5px;
        font-size: 0.9em;
    }
</style>

<div class="home-container">
    <div class="welcome-card">
        <h2 style="margin: 0; color: #1a202c;">TRANG CHỦ SINH VIÊN</h2>
        <p style="color: #718096; margin-top: 5px;">Hệ thống quản lý học tập cá nhân</p>
    </div>

    <div class="header-flex">
        <a href="index.php?controller=sinhvien&action=thongBao" class="alert-link">
             Xem thông báo mới nhất
        </a>
        <a href="index.php?controller=sinhvien&action=dangky" class="btn btn-success" style="padding: 10px 20px; border-radius: 8px; font-weight: bold; box-shadow: 0 2px 4px rgba(0,128,0,0.2);">
             Đăng ký môn học
        </a>
    </div>

    <h4 style="color: #4a5568; margin-bottom: 15px; display: flex; align-items: center; gap: 10px;">
        <span style="width: 4px; height: 20px; background: #007bff; display: inline-block; border-radius: 2px;"></span>
        Danh sách lớp đang theo học
    </h4>

    <?php if (empty($lopHoc)): ?>
        <div style="text-align: center; padding: 40px; background: #fff; border-radius: 10px; border: 2px dashed #cbd5e0;">
            <p style="color: #a0aec0; font-size: 1.1em;">Bạn chưa đăng ký lớp học nào.</p>
            <a href="index.php?controller=sinhvien&action=dangky" style="color: #007bff; font-weight: bold;">Đăng ký ngay</a>
        </div>
    <?php else: ?>
        <table class="custom-table">
            <thead>
                <tr>
                    <th width="100">ID Lớp</th>
                    <th>Tên Lớp</th>
                    <th>Môn Học</th>
                    <th>Giáo Viên</th>
                    <th style="text-align: center;">Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($lopHoc as $lop): ?>
                    <tr>
                        <td><span class="badge-id">#<?= $lop->id ?></span></td>
                        <td><b style="color: #2b6cb0;"><?= htmlspecialchars($lop->ten_lop) ?></b></td>
                        <td><?= htmlspecialchars($lop->ten_mon ?? 'N/A') ?></td>
                        <td>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <div style="width: 30px; height: 30px; background: #ebf8ff; color: #3182ce; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.8em; font-weight: bold;">
                                    <?= mb_substr($lop->ten_giao_vien ?? 'G', 0, 1) ?>
                                </div>
                                <?= htmlspecialchars($lop->ten_giao_vien ?? 'N/A') ?>
                            </div>
                        </td>
                        <td align="center">
                            <a href="index.php?controller=sinhvien&action=chiTietLop&id=<?= $lop->id ?>" class="btn btn-sm btn-primary" style="padding: 8px 16px; border-radius: 6px; font-weight: 500;">
                                 Xem chi tiết
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include __DIR__.'/../layouts/footer.php'; ?>