<?php include __DIR__.'/../layouts/header.php'; ?>

<div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
    <h3>DANH SÁCH BÀI NỘP: <?= htmlspecialchars($baiTap->tieu_de ?? 'Bài tập') ?></h3>
    <a href="index.php?controller=giaovien&action=baitap&id_lop=<?= $baiTap->id_lop ?>" 
       style="background: #000; color: #fff; text-decoration: none; padding: 8px 20px; border-radius: 4px; font-weight: bold; font-size: 0.9em;">
       Quay lại
    </a>
</div>

<div class="card">
    <table border="1" cellpadding="10" style="width: 100%; border-collapse: collapse;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th>Họ tên sinh viên</th>
                <th style="text-align: center; width: 150px;">Thời gian nộp</th>
                <th style="text-align: center; width: 150px;">File bài làm</th>
                <th style="text-align: center; width: 100px;">Điểm</th>
                <th style="text-align: center; width: 150px;">Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($danhSachNop)): ?>
                <?php foreach ($danhSachNop as $item): ?>
                <tr id="row_<?= $item->id ?>">
                    <td><?= htmlspecialchars($item->ho_ten) ?></td>
                    <td align="center">
                        <?= date('d/m/Y H:i', strtotime($item->ngay_nop)) ?>
                    </td>
                    <td align="center">
                        <?php if (!empty($item->file_bai_lam)): ?>
                            <a href="public/uploads/bai_nop/<?= $item->file_bai_lam ?>" target="_blank" style="color: blue; text-decoration: underline;">
                                📥 Tải bài làm
                            </a>
                        <?php else: ?>
                            <span style="color: #999;">Không có file</span>
                        <?php endif; ?>
                    </td>
                    <td align="center">
                        <span id="diem_display_<?= $item->id ?>" style="font-weight: bold; color: <?= isset($item->diem) ? '#28a745' : '#dc3545' ?>;">
                            <?= isset($item->diem) ? number_format($item->diem, 1) : 'Chưa chấm' ?>
                        </span>
                    </td>
                    <td align="center">
                        <button onclick="showEditForm(<?= $item->id ?>, <?= $item->diem ?? 0 ?>, '<?= addslashes($item->nhan_xet ?? '') ?>')" 
                                class="btn btn-sm btn-warning" 
                                style="padding: 5px 15px; background: #ffc107; color: #000; border: none; border-radius: 4px; cursor: pointer; font-weight: bold;">
                            ✏️ Sửa điểm
                        </button>
                    </td>
                </tr>
                <!-- Form chấm điểm ẩn -->
                <tr id="edit_form_<?= $item->id ?>" style="display: none; background-color: #f8f9fa;">
                    <td colspan="5">
                        <form method="POST" action="index.php?controller=giaovien&action=saveDiem" style="padding: 15px;">
                            <input type="hidden" name="id_bai_nop" value="<?= $item->id ?>">
                            <input type="hidden" name="id_bai_tap" value="<?= $baiTap->id ?>">
                            
                            <div style="display: flex; gap: 15px; align-items: center;">
                                <div style="flex: 0 0 150px;">
                                    <label style="font-weight: bold; display: block; margin-bottom: 5px;">Điểm:</label>
                                    <input type="number" name="diem" step="0.1" min="0" max="10" 
                                           value="<?= $item->diem ?? '' ?>" 
                                           placeholder="0.0"
                                           required
                                           style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px; text-align: center; font-size: 1.1em;">
                                </div>
                                
                                <div style="flex: 1;">
                                    <label style="font-weight: bold; display: block; margin-bottom: 5px;">Nhận xét:</label>
                                    <input type="text" name="nhan_xet" 
                                           value="<?= htmlspecialchars($item->nhan_xet ?? '') ?>" 
                                           placeholder="Nhập nhận xét"
                                           style="width: 100%; padding: 8px; border: 1px solid #ddd; border-radius: 4px;">
                                </div>
                                
                                <div style="flex: 0 0 200px; padding-top: 25px;">
                                    <button type="submit" style="background: #28a745; color: white; border: none; padding: 8px 20px; border-radius: 4px; cursor: pointer; font-weight: bold; margin-right: 5px;">
                                        💾 Lưu
                                    </button>
                                    <button type="button" onclick="hideEditForm(<?= $item->id ?>)" style="background: #6c757d; color: white; border: none; padding: 8px 20px; border-radius: 4px; cursor: pointer;">
                                        Hủy
                                    </button>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" align="center" style="padding: 20px; color: #666;">
                        Chưa có sinh viên nào nộp bài tập này.
                    </td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<script>
function showEditForm(id, diem, nhanxet) {
    document.getElementById('edit_form_' + id).style.display = 'table-row';
}

function hideEditForm(id) {
    document.getElementById('edit_form_' + id).style.display = 'none';
}
</script>

<?php include __DIR__.'/../layouts/footer.php'; ?>