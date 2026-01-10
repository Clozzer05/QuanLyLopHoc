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

--DỮ LIỆU MẪU

INSERT INTO nguoi_dung (ten_dang_nhap, mat_khau, ho_ten, vai_tro) VALUES 
('admin', '123456', 'Quản Trị Viên', 'admin'),
('gv01', '123456', 'Nguyễn Văn Thầy', 'gv'),
('gv02', '123456', 'Trần Thị Cô', 'gv'),
('sv01', '123456', 'Lê Văn Trò', 'sv'),
('sv02', '123456', 'Phạm Thị Học', 'sv');

INSERT INTO mon_hoc (ten_mon, so_tin_chi) VALUES 
('Lập trình Web PHP', 3),
('Cơ sở dữ liệu', 4),
('Lập trình Java cơ bản', 3, 'Học về cú pháp Java và hướng đối tượng'),
('Phân tích thiết kế hệ thống', 3, 'Học về biểu đồ UML và quy trình phần mềm'),
('Kỹ năng mềm', 2, 'Phát triển kỹ năng giao tiếp và làm việc nhóm');

INSERT INTO lop_hoc (id_mon_hoc, id_giao_vien, ten_lop, hoc_ky) VALUES 
(3, 2, 'JAVA_K60_01', 'HK1-2024', 40),
(4, 3, 'PTTK_K60_02', 'HK1-2024', 45),
(5, 2, 'KNM_K60_05', 'HK1-2024', 60);

INSERT INTO dang_ky (id_sinh_vien, id_lop) VALUES 
(4, 1),
(5, 1);

INSERT INTO tai_lieu (tieu_de, duong_dan_file, nguoi_upload, id_lop) VALUES 
('Giáo trình PHP cơ bản', 'php_tutorial_pdf.pdf', 2, 1),
('Hướng dẫn cài đặt XAMPP', 'cai_dat_xampp.docx', 2, 1),
('Tài liệu ôn tập SQL', 'sql_review.pdf', 1, NULL);

INSERT INTO bai_tap (id_lop, tieu_de, mo_ta, han_nop, file_de_bai) VALUES 
(1, 'Bài tập 01: Cấu trúc PHP', 'Viết các lệnh PHP cơ bản và xử lý mảng.', '2026-01-20 23:59:59', 'bt01_de_bai.pdf'),
(1, 'Bài tập 02: Kết nối MySQL', 'Tạo form đăng ký và lưu vào database.', '2026-02-15 23:59:59', 'bt02_mysql.pdf');

INSERT INTO bai_nop (id_bai_tap, id_sinh_vien, file_bai_lam, diem, nhan_xet) VALUES 
(1, 4, '1736500000_bt01_sv01.zip', 8.5, 'Làm bài tốt, cần trình bày code sạch hơn.'),
(1, 5, '1736500010_bt01_sv02.zip', 9.0, 'Rất tốt, sáng tạo trong cách giải quyết.');

INSERT INTO thong_bao (tieu_de, noi_dung, nguoi_gui, id_lop) VALUES 
('Chào mừng tân sinh viên', 'Chào mừng các em đến với kỳ học mới.', 1, NULL),
('Thông báo dời lịch học', 'Lớp PHP_K60_01 nghỉ học ngày 15/01, sẽ học bù sau.', 2, 1),
('Hạn chót nộp bài tập 1', 'Các em chú ý nộp bài đúng hạn vào ngày 20/01.', 2, 1);

INSERT INTO diem_danh (id_lop, id_sinh_vien, ngay_diem_danh, trang_thai, ghi_chu) VALUES 
(1, 4, '2026-01-05', 'co_mat', 'Đi học đúng giờ'),
(1, 5, '2026-01-05', 'vang_co_phep', 'Xin nghỉ ốm');

UPDATE dang_ky SET diem_giua_ky = 8.5, diem_cuoi_ky = 7.0 WHERE id_sinh_vien = 4 AND id_lop = 1;
UPDATE dang_ky SET diem_giua_ky = 9.0, diem_cuoi_ky = 8.5 WHERE id_sinh_vien = 5 AND id_lop = 1;