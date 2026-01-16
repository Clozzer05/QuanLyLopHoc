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
    <h3>LỊCH SỬ ĐIỂM DANH: <?= htmlspecialchars($lop->ten_lop) ?></h3>
    <a href="index.php?controller=giaovien&action=diemdanh&id_lop=<?= $idLop ?>" 
       class="btn" 
       style="background: #6c757d; color: #fff; text-decoration: none; padding: 8px 15px; border-radius: 4px; font-weight: bold;">
        Quay lại điểm danh
    </a>
</div>

<!-- Form chọn ngày -->
<div class="card" style="margin-bottom: 20px; padding: 20px;">
    <h4 style="margin-top: 0; margin-bottom: 15px;">📅 Tra cứu điểm danh theo ngày</h4>
    
    <?php if (!empty($danhSachNgay)): ?>
        <form id="searchDateForm" method="GET" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
            <input type="hidden" name="controller" value="giaovien">
            <input type="hidden" name="action" value="xemLichSuDiemDanh">
            <input type="hidden" name="id_lop" value="<?= $idLop ?>">
            <?php if (!empty($searchTerm)): ?>
                <input type="hidden" name="search" value="<?= htmlspecialchars($searchTerm) ?>">
            <?php endif; ?>
            
            <div style="display: flex; gap: 10px; align-items: center;">
                <label style="font-weight: bold;">Chọn ngày:</label>
                <select name="ngay_xem" id="ngaySelect" 
                        style="padding: 8px; border: 1px solid #ccc; border-radius: 4px; min-width: 150px;">
                    <option value="">-- Chọn ngày --</option>
                    <?php foreach ($danhSachNgay as $ngay): ?>
                        <option value="<?= $ngay ?>" <?= ($ngayXem == $ngay) ? 'selected' : '' ?>>
                            <?= date('d/m/Y', strtotime($ngay)) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                
                <button type="submit" 
                        style="background: #007bff; color: white; border: none; padding: 8px 20px; border-radius: 4px; cursor: pointer; font-weight: bold;">
                    🔍 Tra cứu
                </button>
                
                <button type="button" 
                        id="btnResetDate"
                        style="background: #6c757d; color: white; border: none; padding: 8px 20px; border-radius: 4px; cursor: pointer; font-weight: bold;">
                    🔄 Xóa
                </button>
            </div>
        </form>
    <?php else: ?>
        <p style="color: #666; margin: 0;">Chưa có dữ liệu điểm danh nào trong lớp này.</p>
    <?php endif; ?>
</div>

<!-- Form tìm kiếm sinh viên -->
<?php if (!empty($ngayXem)): ?>
<div class="card" style="margin-bottom: 20px; padding: 20px;">
    <h4 style="margin-top: 0; margin-bottom: 15px;">🔍 Tìm kiếm sinh viên</h4>
    <form method="GET" id="searchStudentForm" style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
        <input type="hidden" name="controller" value="giaovien">
        <input type="hidden" name="action" value="xemLichSuDiemDanh">
        <input type="hidden" name="id_lop" value="<?= $idLop ?>">
        <input type="hidden" name="ngay_xem" value="<?= $ngayXem ?>">
        
        <input type="text" 
               name="search" 
               id="searchStudentInput"
               value="<?= htmlspecialchars($searchTerm) ?>"
               placeholder="Nhập tên hoặc mã sinh viên..."
               style="flex: 1; min-width: 300px; padding: 10px; border: 1px solid #ccc; border-radius: 4px; font-size: 1em;">
        
        <button type="submit" 
                style="background: #007bff; color: white; border: none; padding: 10px 25px; border-radius: 4px; cursor: pointer; font-weight: bold;">
            🔍 Tìm kiếm
        </button>
        
        <button type="button" 
                onclick="clearStudentSearch()"
                style="background: #6c757d; color: white; border: none; padding: 10px 25px; border-radius: 4px; cursor: pointer; font-weight: bold;">
            🔄 Xóa
        </button>
    </form>
    
    <?php if (!empty($searchTerm)): ?>
        <div style="margin-top: 10px; padding: 10px; background: #fff3cd; border-left: 4px solid #ffc107; border-radius: 4px;">
            <strong>Đang tìm kiếm:</strong> "<?= htmlspecialchars($searchTerm) ?>" 
            - Tìm thấy <?= count($lichSu) ?> sinh viên
        </div>
    <?php endif; ?>
</div>
<?php endif; ?>

<?php if (!empty($ngayXem)): ?>
    <div class="card" style="margin-bottom: 10px; padding: 15px; background: #e7f3ff; border-left: 4px solid #007bff;">
        <strong>Kết quả điểm danh ngày: <?= date('d/m/Y', strtotime($ngayXem)) ?></strong>
    </div>
<?php endif; ?>

<div class="card">
    <table border="1" style="width: 100%; border-collapse: collapse; background: #fff;">
        <thead>
            <tr style="background: #f8f9fa;">
                <th style="padding: 12px; text-align: left;">Mã SV</th>
                <th style="padding: 12px; text-align: left;">Họ tên sinh viên</th>
                <th style="width: 250px; text-align: center;">Trạng thái ghi nhận</th>
                <th style="width: 120px; text-align: center;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($lichSu)): ?>
                <?php foreach ($lichSu as $item): ?>
                    <!-- Hàng hiển thị thông tin -->
                    <tr id="row_display_<?= $item->id ?>">
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">
                            <code style="background: #f0f0f0; padding: 3px 8px; border-radius: 3px; font-weight: bold;">
                                <?= htmlspecialchars($item->ma_sinh_vien ?? 'N/A') ?>
                            </code>
                        </td>
                        <td style="padding: 12px; border-bottom: 1px solid #eee;">
                            <?= htmlspecialchars($item->ho_ten) ?>
                        </td>
                        <td align="center" style="border-bottom: 1px solid #eee;">
                            <span id="status_display_<?= $item->id ?>">
                                <?php if ($item->trang_thai == 'co_mat'): ?>
                                    <span style="color: #28a745; font-weight: bold; background: #d4edda; padding: 5px 15px; border-radius: 20px;">
                                        ✓ CÓ MẶT
                                    </span>
                                <?php elseif ($item->trang_thai == 'vang_co_phep'): ?>
                                    <span style="color: #ffc107; font-weight: bold; background: #fff3cd; padding: 5px 15px; border-radius: 20px;">
                                        ⚠ VẮNG CÓ PHÉP
                                    </span>
                                <?php else: ?>
                                    <span style="color: #dc3545; font-weight: bold; background: #f8d7da; padding: 5px 15px; border-radius: 20px;">
                                        ✗ VẮNG KHÔNG PHÉP
                                    </span>
                                <?php endif; ?>
                            </span>
                            
                            <?php if (!empty($item->ghi_chu)): ?>
                                <br><small style="color: #666; font-style: italic;" id="note_display_<?= $item->id ?>">
                                    (<?= htmlspecialchars($item->ghi_chu) ?>)
                                </small>
                            <?php endif; ?>
                        </td>
                        <td align="center" style="border-bottom: 1px solid #eee;">
                            <button onclick="showEditForm(<?= $item->id ?>, '<?= $item->trang_thai ?>', '<?= addslashes($item->ghi_chu ?? '') ?>')"
                                    style="background: #ffc107; color: #000; border: none; padding: 5px 15px; border-radius: 4px; cursor: pointer; font-weight: bold; font-size: 0.9em;">
                                ✏️ Sửa
                            </button>
                        </td>
                    </tr>
                    
                    <!-- Hàng chỉnh sửa (ẩn mặc định) -->
                    <tr id="row_edit_<?= $item->id ?>" style="display: none; background: #f8f9fa;">
                        <td colspan="4" style="padding: 15px; border-bottom: 1px solid #eee;">
                            <form method="POST" action="index.php?controller=giaovien&action=updateDiemDanh" style="display: flex; gap: 15px; align-items: center; flex-wrap: wrap;">
                                <input type="hidden" name="id_diem_danh" value="<?= $item->id ?>">
                                <input type="hidden" name="id_lop" value="<?= $idLop ?>">
                                <input type="hidden" name="ngay_xem" value="<?= $ngayXem ?>">
                                <input type="hidden" name="search" value="<?= htmlspecialchars($searchTerm) ?>">
                                
                                <div style="flex: 1; min-width: 200px;">
                                    <strong><?= htmlspecialchars($item->ho_ten) ?></strong>
                                    <small style="display: block; color: #666;">
                                        (<?= htmlspecialchars($item->ma_sinh_vien ?? 'N/A') ?>)
                                    </small>
                                </div>
                                
                                <div style="display: flex; gap: 15px; align-items: center;">
                                    <label style="display: flex; align-items: center; gap: 5px;">
                                        <input type="radio" name="trang_thai" value="co_mat" 
                                               <?= ($item->trang_thai == 'co_mat') ? 'checked' : '' ?>
                                               style="width: 16px; height: 16px;">
                                        <span style="color: #28a745; font-weight: bold;">Có mặt</span>
                                    </label>
                                    
                                    <label style="display: flex; align-items: center; gap: 5px;">
                                        <input type="radio" name="trang_thai" value="vang_co_phep"
                                               <?= ($item->trang_thai == 'vang_co_phep') ? 'checked' : '' ?>
                                               style="width: 16px; height: 16px;">
                                        <span style="color: #ffc107; font-weight: bold;">Vắng có phép</span>
                                    </label>
                                    
                                    <label style="display: flex; align-items: center; gap: 5px;">
                                        <input type="radio" name="trang_thai" value="vang_khong_phep"
                                               <?= ($item->trang_thai == 'vang_khong_phep') ? 'checked' : '' ?>
                                               style="width: 16px; height: 16px;">
                                        <span style="color: #dc3545; font-weight: bold;">Vắng không phép</span>
                                    </label>
                                </div>
                                
                                <div style="flex: 1; min-width: 200px;">
                                    <input type="text" name="ghi_chu" 
                                           value="<?= htmlspecialchars($item->ghi_chu ?? '') ?>"
                                           placeholder="Ghi chú (tùy chọn)"
                                           style="width: 100%; padding: 8px; border: 1px solid #ccc; border-radius: 4px;">
                                </div>
                                
                                <div style="display: flex; gap: 5px;">
                                    <button type="submit"
                                            style="background: #28a745; color: white; border: none; padding: 8px 20px; border-radius: 4px; cursor: pointer; font-weight: bold;">
                                        💾 Lưu
                                    </button>
                                    <button type="button" onclick="hideEditForm(<?= $item->id ?>)"
                                            style="background: #6c757d; color: white; border: none; padding: 8px 20px; border-radius: 4px; cursor: pointer; font-weight: bold;">
                                        Hủy
                                    </button>
                                </div>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" align="center" style="padding: 30px; color: #666;">
                        <?php if (empty($ngayXem)): ?>
                            Vui lòng chọn ngày để xem lịch sử điểm danh.
                        <?php elseif (!empty($searchTerm)): ?>
                            Không tìm thấy sinh viên nào với từ khóa "<?= htmlspecialchars($searchTerm) ?>"
                        <?php else: ?>
                            Không có dữ liệu điểm danh cho ngày này.
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<?php if (!empty($lichSu)): ?>
    <div class="card" style="margin-top: 20px; padding: 15px; background: #f8f9fa;">
        <h5 style="margin-top: 0;">Thống kê:</h5>
        <?php 
            $tongSV = count($lichSu);
            $coMat = 0;
            $vangCoPhep = 0;
            $vangKhongPhep = 0;
            
            foreach ($lichSu as $item) {
                if ($item->trang_thai == 'co_mat') $coMat++;
                elseif ($item->trang_thai == 'vang_co_phep') $vangCoPhep++;
                else $vangKhongPhep++;
            }
            
            $tiLeCoMat = $tongSV > 0 ? round(($coMat / $tongSV) * 100, 1) : 0;
        ?>
        <div style="display: flex; gap: 30px; flex-wrap: wrap;">
            <div>
                <strong>Tổng số sinh viên:</strong> <?= $tongSV ?>
            </div>
            <div style="color: #28a745;">
                <strong>Có mặt:</strong> <?= $coMat ?> (<?= $tiLeCoMat ?>%)
            </div>
            <div style="color: #ffc107;">
                <strong>Vắng có phép:</strong> <?= $vangCoPhep ?>
            </div>
            <div style="color: #dc3545;">
                <strong>Vắng không phép:</strong> <?= $vangKhongPhep ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<script>
// Function hiển thị form chỉnh sửa
function showEditForm(id, trangThai, ghiChu) {
    var displayRow = document.getElementById('row_display_' + id);
    if (displayRow) {
        displayRow.style.display = 'none';
    }
    
    var editRow = document.getElementById('row_edit_' + id);
    if (editRow) {
        editRow.style.display = 'table-row';
    }
}

// Function ẩn form chỉnh sửa
function hideEditForm(id) {
    var displayRow = document.getElementById('row_display_' + id);
    if (displayRow) {
        displayRow.style.display = 'table-row';
    }
    
    var editRow = document.getElementById('row_edit_' + id);
    if (editRow) {
        editRow.style.display = 'none';
    }
}

// Function reset chọn ngày
function resetDateSearch() {
    var selectElement = document.getElementById('ngaySelect');
    if (selectElement) {
        selectElement.value = '';
    }
    window.location.href = 'index.php?controller=giaovien&action=xemLichSuDiemDanh&id_lop=<?= $idLop ?>';
}

// Function xóa tìm kiếm sinh viên
function clearStudentSearch() {
    document.getElementById('searchStudentInput').value = '';
    window.location.href = 'index.php?controller=giaovien&action=xemLichSuDiemDanh&id_lop=<?= $idLop ?>&ngay_xem=<?= $ngayXem ?>';
}

// Gắn event cho nút reset ngày
var btnResetDate = document.getElementById('btnResetDate');
if (btnResetDate) {
    btnResetDate.addEventListener('click', resetDateSearch);
}

// Tự động submit form khi chọn ngày
var ngaySelect = document.getElementById('ngaySelect');
if (ngaySelect) {
    ngaySelect.addEventListener('change', function() {
        if (this.value) {
            var form = document.getElementById('searchDateForm');
            if (form) {
                form.submit();
            }
        }
    });
}

// Focus vào ô tìm kiếm khi nhấn Ctrl+F
document.addEventListener('keydown', function(e) {
    if (e.ctrlKey && e.key === 'f') {
        e.preventDefault();
        var searchInput = document.getElementById('searchStudentInput');
        if (searchInput) {
            searchInput.focus();
        }
    }
});
</script>

<?php include __DIR__.'/../layouts/footer.php'; ?>