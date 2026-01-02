<h1 class="mt-4">Tạo phiếu nhập</h1>

<form action="index.php?act=import-store" method="POST">

    <div class="row">
        <div class="col-md-4">
            <label class="form-label">Nhà cung cấp</label>
            <select name="supplier_id" class="form-control">
                <?php foreach ($suppliers as $s): ?>
                    <option value="<?= $s['id'] ?>"><?= $s['name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="col-md-4">
            <label class="form-label">Nhân viên nhập</label>
            <select name="user_id" class="form-control">
                <?php foreach ($users as $u): ?>
                    <option value="<?= $u['id'] ?>"><?= $u['fullname'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
    </div>

    <hr>

    <h4>Sản phẩm nhập</h4>
    <table class="table table-bordered">
        <thead class="table-light">
            <tr>
                <th width="30%">Sản phẩm</th>
                <th width="12%">Số lượng</th>
                <th width="15%">Giá nhập (đ)</th>
                <th width="15%">Giá bán ra (đ) <span class="text-danger">*</span></th>
                <th width="13%">Giảm giá (%)</th>
                <th width="15%">Giá sau giảm (đ)</th>
            </tr>
        </thead>
        <tbody id="importRows">
            <tr>
                <td>
                    <select name="product_id[]" class="form-control" required>
                        <?php foreach ($products as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= $p['title'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td>
                    <input type="number" name="amount[]" class="form-control amount" min="1" required placeholder="SL">
                </td>
                <td>
                    <input type="number" name="price[]" class="form-control import-price" min="0" step="1000" required placeholder="Giá nhập">
                </td>
                <td>
                    <input type="number" name="sale_price[]" class="form-control sale-price" min="1" step="1000" required placeholder="Giá bán">
                </td>
                <td>
                    <input type="number" name="discount[]" class="form-control discount" min="0" max="99" value="0">
                </td>
                <td class="text-end fw-bold text-primary final-price">0 đ</td>
            </tr>
        </tbody>
    </table>

    <button type="button" class="btn btn-outline-secondary mb-3" onclick="addRow()">+ Thêm sản phẩm</button>
    <br>
    <button type="submit" class="btn btn-success btn-lg">Lưu phiếu nhập</button>

</form>

<script>
    function calculateFinalPrice(row) {
        const salePrice = parseInt(row.querySelector('.sale-price').value) || 0;
        const discount = parseInt(row.querySelector('.discount').value) || 0;
        const importPrice = parseInt(row.querySelector('.import-price').value) || 0;

        const finalPrice = salePrice * (100 - discount) / 100;
        row.querySelector('.final-price').textContent = new Intl.NumberFormat('vi-VN').format(finalPrice) + ' đ';

        // Kiểm tra ràng buộc realtime
        const submitBtn = document.querySelector('button[type="submit"]');
        if (importPrice > 0 && salePrice > 0 && importPrice >= finalPrice) {
            row.style.backgroundColor = '#fff0f0';
            submitBtn.disabled = true;
            row.querySelector('.final-price').innerHTML += ' <span class="text-danger">(Lỗi: Giá nhập ≥ Giá sau giảm)</span>';
        } else {
            row.style.backgroundColor = '';
            submitBtn.disabled = false;
        }
    }

    function addRow() {
        const tbody = document.getElementById('importRows');
        const html = `
        <tr>
            <td>
                <select name="product_id[]" class="form-control" required>
                    <?php foreach ($products as $p): ?>
                        <option value="<?= $p['id'] ?>"><?= $p['title'] ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td>
                <input type="number" name="amount[]" class="form-control amount" min="1" required>
            </td>
            <td>
                <input type="number" name="price[]" class="form-control import-price" min="0" step="1000" required>
            </td>
            <td>
                <input type="number" name="sale_price[]" class="form-control sale-price" min="1" step="1000" required>
            </td>
            <td>
                <input type="number" name="discount[]" class="form-control discount" min="0" max="99" value="0">
            </td>
            <td class="text-end fw-bold text-primary final-price">0 đ</td>
        </tr>
    `;
        tbody.insertAdjacentHTML('beforeend', html);

        // Gắn sự kiện cho dòng mới
        const newRow = tbody.lastElementChild;
        newRow.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', () => calculateFinalPrice(newRow));
        });
    }

    // Gắn sự kiện cho dòng đầu tiên và khi thêm dòng mới
    document.querySelectorAll('#importRows tr').forEach(row => {
        row.querySelectorAll('input').forEach(input => {
            input.addEventListener('input', () => calculateFinalPrice(row));
        });
    });

    // Tính lần đầu khi load trang
    document.querySelectorAll('#importRows tr').forEach(calculateFinalPrice);
</script>