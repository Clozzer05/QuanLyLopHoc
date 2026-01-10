<?php include __DIR__.'/../layouts/header.php'; ?>

<div style="padding: 20px;">
    <h3>THÔNG BÁO HỆ THỐNG</h3>

    <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse; margin-top: 10px;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>Tiêu đề</th>
                <th>Nội dung</th>
                <th>Người gửi</th>
                <th>Ngày tạo</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($thongBao)): ?>
                <?php foreach ($thongBao as $tb): ?>
                <tr>
                    <td style="font-weight: bold;"><?= htmlspecialchars($tb->tieu_de) ?></td>
                    <td><?= nl2br(htmlspecialchars($tb->noi_dung)) ?></td>
                    <td><?= htmlspecialchars($tb->ho_ten ?? 'Hệ thống') ?></td>
                    <td><?= date('d/m/Y H:i', strtotime($tb->ngay_tao)) ?></td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" align="center">Hiện tại chưa có thông báo nào dành cho bạn.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
<div style="margin-top: 20px;">
    <a href="index.php?controller=sinhvien&action=index" 
       class="btn" 
       style="background-color: #000000; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 4px; font-weight: bold;">
       Quay lại trang chủ
    </a>
</div>

<?php include __DIR__.'/../layouts/footer.php'; ?>