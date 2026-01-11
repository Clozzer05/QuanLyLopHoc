<?php include __DIR__ . '/../layouts/header.php'; ?>




<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" rel="stylesheet">

<style>
.dashboard-card {
    padding: 25px;
    border-radius: 15px;
    border: none;
    box-shadow: 0 8px 20px rgba(0,0,0,0.05);
    height: 100%;
}
.dashboard-card .icon {
    width: 50px;
    height: 50px;
    border-radius: 12px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 22px;
    margin-bottom: 15px;
}
.dashboard-card p {
    font-size: 14px;
    color: #6c757d;
}
.dashboard-card a {
    color: #0d6efd;
    font-weight: 500;
    text-decoration: none;
}
</style>




<div class="container-fluid py-4">

    <h2 class="fw-bold text-primary mb-4">TRANG QUẢN TRỊ</h2>

    <!-- CARD CHỨC NĂNG -->
    <div class="row g-4 mb-5">

        <div class="col-md-3">
            <div class="card dashboard-card">
                <div class="icon bg-primary">
                    <i class="fa-solid fa-book"></i>
                </div>
                <h5>Quản lý môn học</h5>
                <p>Cập nhật danh sách và chương trình đào tạo.</p>
                <a href="index.php?controller=admin&action=monhoc">Truy cập ngay →</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card dashboard-card">
                <div class="icon bg-warning">
                    <i class="fa-solid fa-school"></i>
                </div>
                <h5>Quản lý lớp học</h5>
                <p>Quản lý sĩ số, phòng học và thời khóa biểu.</p>
                <a href="index.php?controller=admin&action=lophoc">Truy cập ngay →</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card dashboard-card">
                <div class="icon bg-info">
                    <i class="fa-solid fa-user-group"></i>
                </div>
                <h5>Quản lý người dùng</h5>
                <p>Phân quyền giáo viên và học sinh.</p>
                <a href="index.php?controller=admin&action=nguoidung">Truy cập ngay →</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card dashboard-card">
                <div class="icon bg-success">
                    <i class="fa-solid fa-folder-open"></i>
                </div>
                <h5>Quản lý tài liệu</h5>
                <p>Kho giáo án, bài tập và học liệu.</p>
                <a href="index.php?controller=admin&action=tailieu">Truy cập ngay →</a>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card dashboard-card">
                <div class="icon bg-success">
                <i class="fa-solid fa-bell"></i>
                </div>
                <h5>Quản lý thông báo</h5>
                <p>Quản lý và gửi thông báo đến người dùng.</p>
                <a href="index.php?controller=admin&action=thongbao">Truy cập ngay →</a>
            </div>
        </div>

    </div>

    <!-- THỐNG KÊ -->
    <h5 class="fw-bold mb-3">
        <i class="fa-solid fa-chart-column text-primary"></i>
        Thống kê nhanh hệ thống
    </h5>

    <div class="card p-4">
        <div class="row text-center">
            <div class="col-md-4">
                <h1 class="text-primary fw-bold"><?php echo isset($soHocSinh) ? $soHocSinh : 0; ?></h1>
                <p class="text-muted">Học sinh đăng ký</p>
            </div>
            <div class="col-md-4">
                <h1 class="text-primary fw-bold"><?php echo isset($soGiaoVien) ? $soGiaoVien : 0; ?></h1>
                <p class="text-muted">Giáo viên hoạt động</p>
            </div>
            <div class="col-md-4">
                <h1 class="text-primary fw-bold"><?php echo isset($soLopHoc) ? $soLopHoc : 0; ?></h1>
                <p class="text-muted">Lớp học hiện tại</p>
            </div>
        </div>
    </div>

</div>

<?php include __DIR__ . '/../layouts/footer.php'; ?>

