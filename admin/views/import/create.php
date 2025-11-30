<h1 class="mt-4">Tạo phiếu nhập</h1>

<form action="admin.php?act=import-store" method="POST">

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
    <table class="table">
        <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Giá nhập</th>
            </tr>
        </thead>
        <tbody id="importRows">
            <tr>
                <td>
                    <select name="product_id[]" class="form-control">
                        <?php foreach ($products as $p): ?>
                            <option value="<?= $p['id'] ?>"><?= $p['title'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </td>
                <td><input type="number" name="amount[]" class="form-control"></td>
                <td><input type="number" name="price[]" class="form-control"></td>
            </tr>
        </tbody>
    </table>

    <button type="button" class="btn btn-secondary" onclick="addRow()">+ Thêm sản phẩm</button>
    <br><br>
    <button class="btn btn-success">Lưu phiếu nhập</button>

</form>

<script>
function addRow() {
    let html = `
        <tr>
            <td>
                <select name="product_id[]" class="form-control">
                    <?php foreach ($products as $p): ?>
                    <option value="<?= $p['id'] ?>"><?= $p['title'] ?></option>
                    <?php endforeach; ?>
                </select>
            </td>
            <td><input type="number" name="amount[]" class="form-control"></td>
            <td><input type="number" name="price[]" class="form-control"></td>
        </tr>
    `;
    document.getElementById("importRows").insertAdjacentHTML('beforeend', html);
}
</script>
