<h1 class="mt-4">Thêm sản phẩm</h1>

<form action="index.php?act=product-store" method="POST" enctype="multipart/form-data" class="w-75">

    <div class="mb-3">
        <label>Tên sản phẩm</label>
        <input name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Danh mục</label>
        <select name="category_id" class="form-control" required>
            <?php while($c = $cats->fetch_assoc()) { ?>
                <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label>Giá</label>
            <input name="price" type="number" class="form-control" required>
        </div>

        <div class="col-md-4 mb-3">
            <label>Giảm (%)</label>
            <input name="discount" type="number" value="0" class="form-control">
        </div>

        <div class="col-md-4 mb-3">
            <label>Số lượng</label>
            <input name="quantity" type="number" value="1" class="form-control">
        </div>
    </div>

    <div class="mb-3">
        <label>Ảnh sản phẩm</label>
        <input type="file" name="thumbnail" class="form-control">
    </div>

    <div class="mb-3">
        <label>Mô tả</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <button class="btn btn-success">Lưu</button>
    <a href="index.php?act=products" class="btn btn-secondary">Hủy</a>

</form>
