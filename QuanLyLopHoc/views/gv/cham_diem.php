<?php include __DIR__.'/../layouts/header.php'; ?>

    <h3>CHẤM ĐIỂM</h3>

    <div class="card">
        <table>
            <thead>
            <tr>
                <th>Sinh viên</th>
                <th>Bài làm</th>
                <th width="100px">Điểm</th>
                <th>Nhận xét</th>
                <th width="80px">Lưu</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($baiNop as $bn): ?>
                <tr>
                    <form method="post" action="/giaovien/saveDiem">
                        <input type="hidden" name="id" value="<?= $bn['id'] ?>">
                        <td><?= $bn['ho_ten'] ?></td>
                        <td><a href="<?= $bn['file_bai_lam'] ?>" target="_blank">📥 Tải về</a></td>
                        <td>
                            <input type="number" name="diem" value="<?= $bn['diem'] ?>" step="0.1" min="0" max="10" style="margin:0; text-align: center;">
                        </td>
                        <td>
                            <input type="text" name="nhan_xet" value="<?= $bn['nhan_xet'] ?>" style="margin:0;">
                        </td>
                        <td>
                            <button class="btn btn-primary btn-sm">Lưu</button>
                        </td>
                    </form>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php include __DIR__.'/../layouts/footer.php'; ?>