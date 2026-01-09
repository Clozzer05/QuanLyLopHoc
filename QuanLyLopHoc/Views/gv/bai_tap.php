<?php include __DIR__.'/../layouts/header.php'; ?>

    <h3>BÀI TẬP - <?= $lop['ten_lop'] ?></h3>

    <div class="row">
        <div class="card" style="flex: 2;">
            <h4>Danh sách bài đã giao</h4>
            <table>
                <thead>
                <tr>
                    <th>Tiêu đề</th>
                    <th>Hạn nộp</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($baiTap as $bt): ?>
                    <tr>
                        <td><?= $bt['tieu_de'] ?></td>
                        <td><?= $bt['han_nop'] ?></td>
                        <td>
                            <a href="/giaovien/chamdiem/<?= $bt['id'] ?>" class="btn btn-primary btn-sm">Chấm điểm</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <div class="card" style="flex: 1; height: fit-content;">
            <h4>➕ Giao bài tập mới</h4>
            <form method="post" action="/giaovien/addBaiTap">
                <input type="hidden" name="id_lop" value="<?= $lop['id'] ?>">

                <label>Tiêu đề:</label>
                <input name="tieu_de" placeholder="Nhập tiêu đề..." required>

                <label>Hạn nộp:</label>
                <input type="datetime-local" name="han_nop" required>

                <button class="btn btn-success" style="width: 100%;">Giao bài</button>
            </form>
        </div>
    </div>

<?php include __DIR__.'/../layouts/footer.php'; ?>