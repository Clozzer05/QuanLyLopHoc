<?php include __DIR__.'/../layouts/header.php'; ?>

<div class="card">
    <h3> <?= htmlspecialchars($lop->ten_lop) ?></h3>
    <div class="row">
        <div class="col-half">
            <p><b>Môn học:</b> <?= htmlspecialchars($lop->ten_mon) ?></p>
            <p><b>Giáo viên:</b> <?= htmlspecialchars($lop->ho_ten ?? $lop->ten_giao_vien) ?></p>
            <p><b>Học kỳ:</b> <?= htmlspecialchars($lop->hoc_ky) ?></p>
        </div>
        <div class="col-half" style="background: #e9ecef; padding: 15px; border-radius: 8px; border: 1px solid #dee2e6;">
            <h4 style="margin-top: 0;"> KẾT QUẢ HỌC TẬP</h4>
            <p>Điểm giữa kỳ: <b style="color: #007bff; font-size: 1.2em;"><?= $ketQua->diem_giua_ky ?? 'Chưa có' ?></b></p>
            <p>Điểm cuối kỳ: <b style="color: #007bff; font-size: 1.2em;"><?= $ketQua->diem_cuoi_ky ?? 'Chưa có' ?></b></p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-half">
        <div class="card">
            <h4>TÀI LIỆU HỌC TẬP</h4>
            <table border="1" style="width: 100%; border-collapse: collapse;">
                <tr style="background: #f8f9fa;">
                    <th>Tiêu đề</th>
                    <th style="text-align: center;">Hành động</th>
                </tr>
                <?php if (!empty($taiLieu)): ?>
                    <?php foreach ($taiLieu as $tl): ?>
                        <tr>
                            <td style="padding: 8px;"><?= htmlspecialchars($tl->tieu_de) ?></td>
                            <td style="text-align: center; padding: 8px;">
                                <a href="public/uploads/tai_lieu/<?= rawurlencode($tl->duong_dan_file ?? $tl->file_path) ?>" target="_blank" class="btn btn-sm btn-success">Tải về</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr><td colspan="2" align="center" style="padding: 10px;">Chưa có tài liệu.</td></tr>
                <?php endif; ?>
            </table>
        </div>
    </div>

    <div class="col-half">
        <div class="card">
            <h4>THÔNG BÁO</h4>
            <div style="max-height: 300px; overflow-y: auto; padding-right: 5px;">
                <?php if (!empty($thongBao)): ?>
                    <?php foreach ($thongBao as $tb): ?>
                        <div style="border-bottom: 1px solid #eee; padding: 10px 0;">
                            <small style="color: #666;"><?= date('d/m/Y H:i', strtotime($tb->ngay_tao)) ?></small><br>
                            <b style="color: #d9534f;"><?= htmlspecialchars($tb->tieu_de) ?></b>
                            <p style="margin: 5px 0; font-size: 0.9em; color: #444;"><?= nl2br(htmlspecialchars($tb->noi_dung)) ?></p>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p style="text-align: center; color: #888;">Chưa có thông báo.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<div class="card" style="margin-top: 20px;">
    <h4>DANH SÁCH BÀI TẬP</h4>
    <table border="1" style="width: 100%; border-collapse: collapse; margin-top: 10px;">
        <thead>
        <tr style="background-color: #f8f9fa;">
            <th style="padding: 10px; width: 40%;">Nội dung bài tập</th>
            <th style="padding: 10px; width: 20%;">Hạn nộp</th>
            <th style="padding: 10px; width: 40%;">Trạng thái & Nộp bài</th>
        </tr>
        </thead>
        <tbody>
        <?php if (!empty($dsBaiTap)): ?>
            <?php foreach ($dsBaiTap as $bt): ?>
                <tr>
                    <td style="padding: 10px; vertical-align: top;">
                        <b><?= htmlspecialchars($bt->tieu_de) ?></b>
                        <br><small style="color: #666;"><?= htmlspecialchars($bt->mo_ta) ?></small>
                        <?php if (!empty($bt->file_de_bai)): ?>
                            <br>
                            <a href="public/uploads/bai_tap/<?= rawurlencode($bt->file_de_bai) ?>" target="_blank" style="font-size: 0.9em; color: #007bff; font-weight: bold; text-decoration: underline;">
                                 Tải đề bài
                            </a>
                        <?php endif; ?>
                    </td>
                    <td style="padding: 10px; text-align: center; vertical-align: top;">
                    <span style="<?= (strtotime($bt->han_nop) < time()) ? 'color: red; font-weight: bold;' : 'color: #333;' ?>">
                        <?= date('d/m/Y H:i', strtotime($bt->han_nop)) ?>
                    </span>
                    </td>
                    <td style="padding: 10px; vertical-align: top;">
                        <?php if (!empty($bt->bai_nop)): ?>
                            <div style="margin-bottom: 10px; background-color: #e8f5e9; padding: 10px; border-radius: 5px; border: 1px solid #c8e6c9;">
                                <div style="color: #2e7d32; font-weight: bold; font-size: 0.9em;">
                                     Đã nộp: <?= date('d/m/Y H:i', strtotime($bt->bai_nop->ngay_nop)) ?>
                                </div>
                                <div style="margin-top: 3px;">
                                    <a href="public/uploads/bai_nop/<?= rawurlencode($bt->bai_nop->file_bai_lam) ?>" target="_blank" style="font-size: 0.85em; text-decoration: underline;">
                                        Xem file bài làm cũ
                                    </a>
                                </div>
                                <?php if (isset($bt->bai_nop->diem)): ?>
                                    <div style="margin-top: 5px; border-top: 1px dashed #a5d6a7; padding-top: 5px;">
                                        <span style="color: #d32f2f; font-weight: bold;">Điểm: <?= $bt->bai_nop->diem ?></span>
                                        <?php if (!empty($bt->bai_nop->nhan_xet)): ?>
                                            <br><small style="color: #555;">NX: <?= htmlspecialchars($bt->bai_nop->nhan_xet) ?></small>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php else: ?>

                        <?php endif; ?>
                        <?php if (strtotime($bt->han_nop) >= time()): ?>
                            <form action="index.php?controller=sinhvien&action=nopbai" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id_bai_tap" value="<?= $bt->id ?>">
                                <div style="display: flex; gap: 5px; flex-direction: column;">
                                    <input type="file" name="file" required style="font-size: 0.8em; width: 100%;">
                                    <button type="submit" class="btn btn-sm btn-primary" style="width: 100%; border-radius: 4px;">
                                        <?= !empty($bt->bai_nop) ? ' Nộp lại ' : ' Gửi bài ngay' ?>
                                    </button>
                                </div>
                            </form>
                        <?php else: ?>
                            <div style="text-align: center; margin-top: 10px; border-top: 1px solid #eee; padding-top: 5px;">
                                <span style="color: #dc3545; font-weight: bold; font-size: 0.9em;"> Đã hết hạn nộp bài</span>
                            </div>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr><td colspan="3" align="center" style="padding: 30px; color: #666;">Lớp này hiện chưa có bài tập nào.</td></tr>
        <?php endif; ?>
        </tbody>
    </table>
</div>

<div style="margin-top: 20px;">
    <a href="index.php?controller=sinhvien&action=index"
       class="btn"
       style="background-color: #000000; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-weight: bold;">
         Quay lại trang chủ
    </a>
</div>
<?php include __DIR__.'/../layouts/footer.php'; ?>