<?php include __DIR__.'/../layouts/header.php'; ?>

<h3>BÀI TẬP - <?= htmlspecialchars($lop->ten_lop ?? 'Lớp học') ?></h3>

<div class="card" style="margin-bottom: 20px; padding: 20px;">
    <h4 style="margin-top: 0;">Thêm bài tập mới</h4>
    <form action="index.php?controller=giaovien&action=addBaiTap" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id_lop" value="<?= $idLop ?>">
        
        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Tiêu đề bài tập:</label>
            <input type="text" name="tieu_de" placeholder="Nhập tiêu đề bài tập" required 
                   style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Mô tả:</label>
            <textarea name="mo_ta" placeholder="Mô tả chi tiết bài tập" rows="4" 
                      style="width: 100%; padding: 10px; border: 1px solid #ddd; border-radius: 4px; box-sizing: border-box;"></textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">Hạn nộp:</label>
            <input type="datetime-local" name="han_nop" required 
                   style="padding: 10px; border: 1px solid #ddd; border-radius: 4px;">
        </div>

        <div style="margin-bottom: 15px;">
            <label style="display: block; margin-bottom: 5px; font-weight: bold;">File đề bài:</label>
            <input type="file" name="file_de_bai" 
                   accept=".pdf,.doc,.docx,.zip,.rar"
                   style="padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
        </div>
        
        <button type="submit" style="background: #28a745; color: #fff; border: none; padding: 10px 25px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 1em;">
             Thêm bài tập
        </button>
    </form>
</div>

<div class="card">
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
        <h4>Danh sách bài đã giao</h4>
        <div style="display: flex; gap: 10px; align-items: center;">
            <!-- Thanh tìm kiếm -->
            <input type="text" 
                   id="searchBaiTap" 
                   placeholder=" Tìm theo tiêu đề..." 
                   style="padding: 8px 15px; border: 1px solid #ddd; border-radius: 4px; width: 250px;">
            <a href="index.php?controller=giaovien&action=index" 
               style="background: #000; color: #fff; padding: 5px 15px; text-decoration: none; border-radius: 4px; font-size: 0.9em; font-weight: bold;">
                Quay lại
            </a>
        </div>
    </div>

    <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>Tiêu đề</th>
                <th style="width: 150px; text-align: center;">Hạn nộp</th>
                <th style="width: 150px; text-align: center;">Hành động</th>
            </tr>
        </thead>
        <tbody id="baiTapTableBody">
            <?php if (!empty($baiTap)): ?>
                <?php foreach ($baiTap as $bt): ?>
                <tr class="baitap-row" data-title="<?= strtolower($bt->tieu_de) ?>">
                    <td>
                        <b><?= htmlspecialchars($bt->tieu_de) ?></b>
                        <br><small><?= htmlspecialchars($bt->mo_ta) ?></small>
                        <?php if (!empty($bt->file_de_bai)): ?>
                            <br>
                            <a href="public/uploads/bai_tap/<?= rawurlencode($bt->file_de_bai) ?>" 
                               target="_blank" 
                               style="color: #007bff; font-size: 0.9em; font-weight: bold; text-decoration: underline;">
                                Tải file đề bài
                            </a>
                        <?php endif; ?>
                    </td>
                    <td align="center"><?= date('d/m/Y H:i', strtotime($bt->han_nop)) ?></td>
                    <td align="center">
                        <a href="index.php?controller=giaovien&action=viewNopBai&id=<?= $bt->id ?>" class="btn btn-sm btn-primary" style="text-decoration: none; display: inline-block; margin-bottom: 5px;">
                             Xem bài nộp
                        </a>
                        <br>
                        <a href="index.php?controller=giaovien&action=deleteBaiTap&id=<?= $bt->id ?>&id_lop=<?= $idLop ?>" 
                           class="btn btn-sm btn-danger" 
                           style="text-decoration: none; display: inline-block;"
                           onclick="return confirm('Bạn có chắc muốn xóa bài tập này?')">
                             Xóa
                        </a>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr id="noDataRow"><td colspan="3" align="center">Chưa có bài tập nào được giao.</td></tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
document.getElementById('searchBaiTap').addEventListener('input', function() {
    const searchTerm = this.value.toLowerCase().trim();
    const rows = document.querySelectorAll('.baitap-row');
    let visibleCount = 0;
    
    rows.forEach(row => {
        const title = row.getAttribute('data-title');
        
        if (title.includes(searchTerm)) {
            row.style.display = '';
            visibleCount++;
        } else {
            row.style.display = 'none';
        }
    });
    
    // Hiển thị thông báo nếu không tìm thấy
    const tbody = document.getElementById('baiTapTableBody');
    const noResultRow = document.getElementById('noResultRow');
    
    if (visibleCount === 0 && !noResultRow) {
        const existingNoData = document.getElementById('noDataRow');
        if (!existingNoData) {
            tbody.innerHTML += '<tr id="noResultRow"><td colspan="3" align="center" style="padding: 20px; color: #dc3545;">Không tìm thấy bài tập nào phù hợp!</td></tr>';
        }
    } else if (visibleCount > 0 && noResultRow) {
        noResultRow.remove();
    }
});
</script>

<?php include __DIR__.'/../layouts/footer.php'; ?>