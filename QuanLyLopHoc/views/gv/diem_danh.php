<?php include __DIR__.'/../layouts/header.php'; ?>

<?php if (isset($_SESSION['success'])): ?>
    <div style="background: #d4edda; color: #155724; padding: 15px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #c3e6cb; font-weight: bold;">
        ✓ <?= $_SESSION['success']; unset($_SESSION['success']); ?>
    </div>
<?php endif; ?>

<?php if (isset($_SESSION['error'])): ?>
    <div style="background: #f8d7da; color: #721c24; padding: 15px; border-radius: 4px; margin-bottom: 20px; border: 1px solid #f5c6cb; font-weight: bold;">
        ✗ <?= $_SESSION['error']; unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h3>ĐIỂM DANH: <?= htmlspecialchars($lop->ten_lop ?? 'Lớp học') ?></h3>
    <div style="display: flex; gap: 10px;">
        <a href="index.php?controller=giaovien&action=xemLichSuDiemDanh&id_lop=<?= $idLop ?>" 
           style="background: #28a745; color: #fff; text-decoration: none; padding: 8px 20px; border-radius: 4px; font-weight: bold; font-size: 0.9em;">
            📋 Xem lịch sử
        </a>
        <a href="index.php?controller=giaovien&action=index" 
           style="background: #000; color: #fff; text-decoration: none; padding: 8px 20px; border-radius: 4px; font-weight: bold; font-size: 0.9em;">
            Quay lại
        </a>
    </div>
</div>

<!-- Form tìm kiếm -->
<div class="card" style="margin-bottom: 20px; padding: 20px;">
    <h4 style="margin-top: 0; margin-bottom: 15px;">🔍 Tìm kiếm sinh viên</h4>
    <form method="GET" id="searchForm" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
        <input type="hidden" name="controller" value="giaovien">
        <input type="hidden" name="action" value="diemdanh">
        <input type="hidden" name="id_lop" value="<?= $idLop ?>">
        
        <input type="text" 
               name="search" 
               id="searchInput"
               value="<?= htmlspecialchars($searchTerm) ?>"
               placeholder="Nhập tên hoặc mã sinh viên..."
               style="flex: 1; min-width: 300px; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 1em;">
        
        <button type="submit" 
                style="background: #007bff; color: white; border: none; padding: 10px 25px; border-radius: 4px; cursor: pointer; font-weight: bold;">
            🔍 Tìm kiếm
        </button>
        
        <button type="button" 
                onclick="clearSearch()"
                style="background: #6c757d; color: white; border: none; padding: 10px 25px; border-radius: 4px; cursor: pointer; font-weight: bold;">
            🔄 Xóa
        </button>
    </form>
    
    <?php if (!empty($searchTerm)): ?>
        <div style="margin-top: 10px; padding: 10px; background: #e7f3ff; border-left: 4px solid #007bff; border-radius: 4px;">
            <strong>Đang tìm kiếm:</strong> "<?= htmlspecialchars($searchTerm) ?>" 
            - Tìm thấy <?= count($sinhVien) ?> sinh viên
        </div>
    <?php endif; ?>
</div>

<div class="card">
    <form action="index.php?controller=giaovien&action=saveDiemDanh" method="POST" id="formDiemDanh">
        <input type="hidden" name="id_lop" value="<?= $idLop ?>">
        
        <div style="margin-bottom: 20px; padding: 15px; background: #f8f9fa; border-radius: 4px;">
            <label style="font-weight: bold; display: block; margin-bottom: 8px;">Ngày điểm danh:</label>
            <input type="date" 
                   name="ngay_diem_danh" 
                   id="ngayDiemDanh"
                   value="<?= date('Y-m-d') ?>" 
                   required 
                   style="padding: 10px; border-radius: 4px; border: 1px solid #ccc; font-size: 1em; min-width: 200px;">
            <small style="display: block; margin-top: 5px; color: #666;">
                Chọn ngày cần điểm danh
            </small>
        </div>

        <table border="1" cellpadding="12" style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr style="background-color: #f8f9fa;">
                    <th align="left" style="padding: 12px;">Mã SV</th>
                    <th align="left" style="padding: 12px;">Họ tên sinh viên</th>
                    <th style="width: 120px; text-align: center;">Có mặt</th>
                    <th style="width: 120px; text-align: center;">Vắng có phép</th>
                    <th style="width: 120px; text-align: center;">Vắng không phép</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($sinhVien)): ?>
                    <?php foreach ($sinhVien as $sv): ?>
                    <tr style="border-bottom: 1px solid #dee2e6;">
                        <td style="padding: 12px;">
                            <code style="background: #f0f0f0; padding: 3px 8px; border-radius: 3px; font-weight: bold;">
                                <?= htmlspecialchars($sv->ma_sinh_vien ?? $sv->ten_dang_nhap ?? 'N/A') ?>
                            </code>
                        </td>
                        <td style="padding: 12px;">
                            <strong><?= htmlspecialchars($sv->ho_ten) ?></strong>
                        </td>
                        <td align="center" style="background: #f0fff4;">
                            <input type="radio" 
                                   name="sv[<?= $sv->id ?>][trang_thai]" 
                                   value="co_mat" 
                                   checked 
                                   style="width: 18px; height: 18px; cursor: pointer;">
                        </td>
                        <td align="center" style="background: #fffbf0;">
                            <input type="radio" 
                                   name="sv[<?= $sv->id ?>][trang_thai]" 
                                   value="vang_co_phep"
                                   style="width: 18px; height: 18px; cursor: pointer;">
                        </td>
                        <td align="center" style="background: #fff5f5;">
                            <input type="radio" 
                                   name="sv[<?= $sv->id ?>][trang_thai]" 
                                   value="vang_khong_phep"
                                   style="width: 18px; height: 18px; cursor: pointer;">
                        </td>
                        <input type="hidden" name="sv[<?= $sv->id ?>][id]" value="<?= $sv->id ?>">
                    </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" align="center" style="padding: 30px; color: #666;">
                            <?php if (!empty($searchTerm)): ?>
                                Không tìm thấy sinh viên nào với từ khóa "<?= htmlspecialchars($searchTerm) ?>"
                            <?php else: ?>
                                Chưa có sinh viên trong lớp này.
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <?php if (!empty($sinhVien)): ?>
        <div style="margin-top: 20px; text-align: right; padding: 15px; background: #f8f9fa; border-radius: 4px;">
            <button type="submit" 
                    style="padding: 12px 40px; font-weight: bold; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; font-size: 1em;">
                💾 Lưu điểm danh
            </button>
        </div>
        <?php endif; ?>
    </form>
</div>

<script>
// Function xóa tìm kiếm
function clearSearch() {
    document.getElementById('searchInput').value = '';
    window.location.href = 'index.php?controller=giaovien&action=diemdanh&id_lop=<?= $idLop ?>';
}

// Thêm hiệu ứng khi chọn radio button
document.querySelectorAll('input[type="radio"]').forEach(function(radio) {
    radio.addEventListener('change', function() {
        var row = this.closest('tr');
        var cells = row.querySelectorAll('td');
        cells.forEach(function(cell) {
            cell.style.fontWeight = 'normal';
        });
        
        var selectedCell = this.closest('td');
        if (selectedCell) {
            selectedCell.style.fontWeight = 'bold';
        }
    });
});

// Xác nhận trước khi submit
var formDiemDanh = document.getElementById('formDiemDanh');
if (formDiemDanh) {
    formDiemDanh.addEventListener('submit', function(e) {
        var ngayInput = document.getElementById('ngayDiemDanh');
        if (ngayInput && ngayInput.value) {
            var ngayDiemDanh = ngayInput.value;
            var date = new Date(ngayDiemDanh);
            var ngayFormatted = date.toLocaleDateString('vi-VN');
            
            if (!confirm('Bạn có chắc chắn muốn lưu điểm danh cho ngày ' + ngayFormatted + '?')) {
                e.preventDefault();
            }
        }
    });
}

// Focus vào ô tìm kiếm khi nhấn Ctrl+F
document.addEventListener('keydown', function(e) {
    if (e.ctrlKey && e.key === 'f') {
        e.preventDefault();
        document.getElementById('searchInput').focus();
    }
});
</script>

<?php include __DIR__.'/../layouts/footer.php'; ?>