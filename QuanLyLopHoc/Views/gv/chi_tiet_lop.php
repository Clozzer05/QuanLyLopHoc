<?php include __DIR__.'/../layouts/header.php'; ?>

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h3>CHI TIẾT LỚP: <?= $lop['ten_lop'] ?></h3>
        <a href="/giaovien" class="btn btn-secondary btn-sm">Quay lại</a>
    </div>

    <div class="card">
        <table>
            <thead>
            <tr>
                <th>Họ tên</th>
                <th style="width: 150px; text-align: center;">Giữa kỳ</th>
                <th style="width: 150px; text-align: center;">Cuối kỳ</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($sinhVien as $sv): ?>
                <tr>
                    <td><?= $sv['ho_ten'] ?></td>
                    <td style="text-align: center;"><?= $sv['diem_giua_ky'] ?></td>
                    <td style="text-align: center;"><?= $sv['diem_cuoi_ky'] ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php include __DIR__.'/../layouts/footer.php'; ?>