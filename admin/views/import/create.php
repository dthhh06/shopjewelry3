<h1 class="mt-4">Tạo phiếu nhập</h1>

<form action="index.php?act=import-store" method="POST" id="importForm">

    <?php 
    // Token chống double submit
    $token = bin2hex(random_bytes(32));
    $_SESSION['import_token'] = $token;
    ?>
    <input type="hidden" name="form_token" value="<?= $token ?>">

    <div class="row mb-4">
        <div class="col-md-4">
            <label class="form-label fw-bold">Nhà cung cấp <span class="text-danger">*</span></label>
            <select name="supplier_id" class="form-control" required>
                <option value="">-- Chọn nhà cung cấp --</option>
                <?php foreach ($suppliers as $s): ?>
                    <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label fw-bold">Nhân viên nhập kho <span class="text-danger">*</span></label>
            <select name="user_id" class="form-control" required>
                <option value="">-- Chọn nhân viên --</option>
                <?php foreach ($users as $u): ?>
                    <option value="<?= $u['id'] ?>"><?= htmlspecialchars($u['fullname']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <hr>

    <h4 class="mb-3">Sản phẩm nhập kho</h4>

    <div class="alert alert-info border-0 shadow-sm">
        <strong>Hướng dẫn nhập giá:</strong><br>
        • <strong>Giá nhập</strong>: Giá bạn mua từ nhà cung cấp (phải nhỏ hơn giá bán thực tế)<br>
        • <strong>Giá bán thực tế</strong>: Giá khách hàng sẽ trả → <u>sẽ được lưu trực tiếp vào giá bán của sản phẩm</u><br>
        • <strong>Giảm giá (%)</strong>: % giảm hiển thị trên website (ví dụ: Giảm 20%)<br><br>
        <span class="text-primary fw-bold">
            Ví dụ: Bạn muốn bán 800.000đ và hiển thị "Giảm 20%" → Nhập:
            <br>→ Giá bán thực tế = 800.000
            <br>→ Giảm giá = 20
        </span>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover">
            <thead class="table-primary">
                <tr class="text-center">
                    <th width="28%">Sản phẩm</th>
                    <th width="12%">Số lượng</th>
                    <th width="15%">Giá nhập (đ)</th>
                    <th width="15%">Giá bán thực tế (đ) <span class="text-danger">*</span></th>
                    <th width="12%">Giảm giá (%)</th>
                    <th width="12%">Giá niêm yết (tham khảo)</th>
                    <th width="6%">Xóa</th>
                </tr>
            </thead>
            <tbody id="importRows">
                <tr>
                    <td>
                        <select name="product_id[]" class="form-control" required>
                            <option value="">-- Chọn sản phẩm --</option>
                            <?php foreach ($products as $p): ?>
                                <option value="<?= $p['id'] ?>"><?= htmlspecialchars($p['title']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </td>
                    <td><input type="number" name="amount[]" class="form-control amount" min="1" required></td>
                    <td><input type="number" name="price[]" class="form-control import-price" min="0" step="1000" required></td>
                    <td><input type="number" name="final_price[]" class="form-control final-price-input" min="1" step="1000" required></td>
                    <td><input type="number" name="discount[]" class="form-control discount" min="0" max="99" value="0"></td>
                    <td class="text-end fw-bold text-success calc-price pt-3">0 đ</td>
                    <td class="text-center">
                        <button type="button" class="btn btn-danger btn-sm remove-row" title="Xóa dòng">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>

    <div class="mt-3 mb-4">
        <button type="button" class="btn btn-outline-primary" onclick="addRow()">
            <i class="fas fa-plus"></i> Thêm sản phẩm
        </button>
    </div>

    <button type="submit" class="btn btn-success btn-lg px-5" id="submitBtn">
        <i class="fas fa-save"></i> Lưu phiếu nhập
    </button>
</form>

<script>
// Tính giá niêm yết tham khảo và kiểm tra lỗi
function calculate(row) {
    const finalPrice = parseFloat(row.querySelector('.final-price-input').value) || 0;
    const discount = parseInt(row.querySelector('.discount').value) || 0;
    const importPrice = parseFloat(row.querySelector('.import-price').value) || 0;

    let listPrice = finalPrice;
    if (discount > 0 && discount < 100) {
        listPrice = Math.ceil(finalPrice / (1 - discount / 100));
    }

    row.querySelector('.calc-price').textContent = new Intl.NumberFormat('vi-VN').format(listPrice) + ' đ';

    // Kiểm tra giá nhập >= giá bán thực tế → cảnh báo + disable nút
    const submitBtn = document.getElementById('submitBtn');
    if (importPrice >= finalPrice && importPrice > 0 && finalPrice > 0) {
        row.style.backgroundColor = '#ffe6e6';
        submitBtn.disabled = true;
    } else {
        row.style.backgroundColor = '';
        // Chỉ enable nếu tất cả dòng đều hợp lệ
        const invalidRows = document.querySelectorAll('#importRows tr[style*="background-color"]');
        submitBtn.disabled = invalidRows.length > 0;
    }
}

function addRow() {
    const tbody = document.getElementById('importRows');
    const newRow = tbody.querySelector('tr').cloneNode(true);

    // Reset values
    newRow.querySelectorAll('input, select').forEach(el => {
        if (el.tagName === 'SELECT') el.selectedIndex = 0;
        else el.value = '';
    });
    newRow.querySelector('.discount').value = '0';
    newRow.querySelector('.calc-price').textContent = '0 đ';
    newRow.style.backgroundColor = '';

    tbody.appendChild(newRow);

    // Gắn lại event
    newRow.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', () => calculate(newRow));
    });
    calculate(newRow);
}

// Xóa dòng (giữ ít nhất 1 dòng)
document.getElementById('importRows').addEventListener('click', function(e) {
    if (e.target.closest('.remove-row')) {
        const row = e.target.closest('tr');
        if (document.querySelectorAll('#importRows tr').length > 1) {
            row.remove();
        }
    }
});

// Gắn event cho tất cả dòng hiện tại
document.querySelectorAll('#importRows tr').forEach(row => {
    row.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', () => calculate(row));
    });
    calculate(row);
});

// Chống double submit + UX tốt
document.getElementById('importForm').addEventListener('submit', function(e) {
    const btn = document.getElementById('submitBtn');
    if (btn.disabled) {
        e.preventDefault();
        return;
    }
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Đang lưu phiếu...';
});
</script>