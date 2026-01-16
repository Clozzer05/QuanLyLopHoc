DROP DATABASE IF EXISTS QuanLyLopHoc;

CREATE DATABASE QuanLyLopHoc;
USE QuanLyLopHoc;

CREATE TABLE nguoi_dung (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ten_dang_nhap VARCHAR(50) NOT NULL UNIQUE,
    mat_khau VARCHAR(255) NOT NULL,
    ho_ten VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    vai_tro ENUM('admin', 'gv', 'sv') NOT NULL DEFAULT 'sv',
    ngay_tao TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE mon_hoc (
    id INT AUTO_INCREMENT PRIMARY KEY,
    ten_mon VARCHAR(100) NOT NULL,
    so_tin_chi INT NOT NULL DEFAULT 3,
    mo_ta TEXT
);

CREATE TABLE lop_hoc (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_mon_hoc INT NOT NULL,
    id_giao_vien INT,
    ten_lop VARCHAR(100) NOT NULL,
    hoc_ky VARCHAR(20),
    si_so_toi_da INT DEFAULT 50,
    FOREIGN KEY (id_mon_hoc) REFERENCES mon_hoc(id) ON DELETE CASCADE,
    FOREIGN KEY (id_giao_vien) REFERENCES nguoi_dung(id) ON DELETE SET NULL
);

CREATE TABLE dang_ky (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_sinh_vien INT NOT NULL,
    id_lop INT NOT NULL,
    diem_giua_ky FLOAT,
    diem_cuoi_ky FLOAT,
    ngay_dang_ky TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_sinh_vien) REFERENCES nguoi_dung(id) ON DELETE CASCADE,
    FOREIGN KEY (id_lop) REFERENCES lop_hoc(id) ON DELETE CASCADE,
    UNIQUE(id_sinh_vien, id_lop)
);

CREATE TABLE tai_lieu (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tieu_de VARCHAR(200) NOT NULL,
    duong_dan_file VARCHAR(255) NOT NULL,
    nguoi_upload INT NOT NULL,
    id_lop INT DEFAULT NULL,
    ngay_upload TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (nguoi_upload) REFERENCES nguoi_dung(id) ON DELETE CASCADE,
    FOREIGN KEY (id_lop) REFERENCES lop_hoc(id) ON DELETE CASCADE
);

CREATE TABLE bai_tap (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_lop INT NOT NULL,
    tieu_de VARCHAR(200) NOT NULL,
    mo_ta TEXT,
    han_nop DATETIME,
    file_de_bai VARCHAR(255),
    ngay_tao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_lop) REFERENCES lop_hoc(id) ON DELETE CASCADE
);

CREATE TABLE bai_nop (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_bai_tap INT NOT NULL,
    id_sinh_vien INT NOT NULL,
    file_bai_lam VARCHAR(255) NOT NULL,
    diem FLOAT,
    nhan_xet TEXT,
    ngay_nop TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_bai_tap) REFERENCES bai_tap(id) ON DELETE CASCADE,
    FOREIGN KEY (id_sinh_vien) REFERENCES nguoi_dung(id) ON DELETE CASCADE
);

CREATE TABLE thong_bao (
    id INT AUTO_INCREMENT PRIMARY KEY,
    tieu_de VARCHAR(200) NOT NULL,
    noi_dung TEXT NOT NULL,
    nguoi_gui INT NOT NULL,
    id_lop INT DEFAULT NULL,
    ngay_tao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (nguoi_gui) REFERENCES nguoi_dung(id) ON DELETE CASCADE,
    FOREIGN KEY (id_lop) REFERENCES lop_hoc(id) ON DELETE CASCADE
);

CREATE TABLE diem_danh (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_lop INT NOT NULL,
    id_sinh_vien INT NOT NULL,
    ngay_diem_danh DATE NOT NULL,
    trang_thai ENUM('co_mat', 'vang_co_phep', 'vang_khong_phep') DEFAULT 'co_mat',
    ghi_chu VARCHAR(255),
    FOREIGN KEY (id_lop) REFERENCES lop_hoc(id) ON DELETE CASCADE,
    FOREIGN KEY (id_sinh_vien) REFERENCES nguoi_dung(id) ON DELETE CASCADE
);

INSERT INTO nguoi_dung (ten_dang_nhap, mat_khau, ho_ten, email, vai_tro) VALUES
('admin', '123456', 'Quản trị hệ thống', 'admin@qlop.vn', 'admin'),
('gv_anh', '123456', 'Nguyễn Văn Anh', 'anh.gv@qlop.vn', 'gv'),
('gv_binh', '123456', 'Trần Thị Bình', 'binh.gv@qlop.vn', 'gv'),
('gv_chau', '123456', 'Lê Minh Châu', 'chau.gv@qlop.vn', 'gv'),
('sv01', '123456', 'Phạm Văn A', 'sv01@qlop.vn', 'sv'),
('sv02', '123456', 'Nguyễn Thị B', 'sv02@qlop.vn', 'sv'),
('sv03', '123456', 'Trần Văn C', 'sv03@qlop.vn', 'sv'),
('sv04', '123456', 'Lê Thị D', 'sv04@qlop.vn', 'sv'),
('sv05', '123456', 'Hoàng Văn E', 'sv05@qlop.vn', 'sv'),
('sv06', '123456', 'Phan Thị F', 'sv06@qlop.vn', 'sv'),
('sv07', '123456', 'Vũ Văn G', 'sv07@qlop.vn', 'sv');

INSERT INTO mon_hoc (ten_mon, so_tin_chi, mo_ta) VALUES
('Lập trình C cơ bản', 3, 'Nhập môn lập trình C'),
('Lập trình PHP', 3, 'Lập trình web với PHP & MySQL'),
('Cơ sở dữ liệu', 3, 'Thiết kế và quản lý CSDL'),
('Mạng máy tính', 3, 'Kiến thức cơ bản về mạng'),
('Hệ điều hành', 3, 'Nguyên lý hệ điều hành');

INSERT INTO lop_hoc (id_mon_hoc, id_giao_vien, ten_lop, hoc_ky, si_so_toi_da) VALUES
(1, 2, 'C01', 'HK1-2025', 60),
(1, 3, 'C02', 'HK1-2025', 50),
(2, 3, 'PHP01', 'HK1-2025', 55),
(3, 4, 'CSDL01', 'HK2-2025', 50),
(4, 2, 'MMT01', 'HK2-2025', 45),
(5, 4, 'HDH01', 'HK2-2025', 40);

INSERT INTO dang_ky (id_sinh_vien, id_lop, diem_giua_ky, diem_cuoi_ky) VALUES
(5, 1, 7.5, 8.0),
(6, 1, 6.5, 7.0),
(7, 1, 8.0, 8.5),
(8, 1, 5.5, 6.0),
(5, 3, 7.0, 7.5),
(6, 3, 8.5, 9.0),
(7, 3, 6.0, 6.5),
(8, 4, 7.5, 8.0),
(9, 4, 6.5, 7.0),
(10, 4, 8.0, 8.5),
(5, 6, 6.0, 6.5),
(6, 6, 7.0, 7.5);

INSERT INTO thong_bao (tieu_de, noi_dung, nguoi_gui, id_lop) VALUES
('Chào mừng sinh viên', 'Chào mừng các bạn đến với lớp học', 2, 1),
('Lịch học tuần 1', 'Tuần 1 học lý thuyết', 2, 1),
('Thông báo kiểm tra', 'Tuần sau kiểm tra giữa kỳ', 3, 3),
('Nghỉ học', 'Buổi học ngày mai được nghỉ', 4, 4),
('Thông báo chung', 'Sinh viên theo dõi LMS thường xuyên', 1, NULL);

INSERT INTO diem_danh (id_lop, id_sinh_vien, ngay_diem_danh, trang_thai) VALUES
(1, 5, '2025-09-01', 'co_mat'),
(1, 6, '2025-09-01', 'co_mat'),
(1, 7, '2025-09-01', 'vang_khong_phep'),
(1, 8, '2025-09-01', 'co_mat'),
(1, 5, '2025-09-08', 'co_mat'),
(1, 6, '2025-09-08', 'vang_co_phep'),
(1, 7, '2025-09-08', 'co_mat'),
(1, 8, '2025-09-08', 'co_mat'),
(3, 5, '2025-09-02', 'co_mat'),
(3, 6, '2025-09-02', 'co_mat'),
(3, 7, '2025-09-02', 'vang_khong_phep'),
(4, 8, '2025-10-01', 'co_mat'),
(4, 9, '2025-10-01', 'co_mat'),
(4, 10, '2025-10-01', 'vang_co_phep');







