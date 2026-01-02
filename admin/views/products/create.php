<h1 class="mt-4">Thêm sản phẩm</h1>

<form action="index.php?act=product-store" method="POST" enctype="multipart/form-data" class="w-75">

    <div class="mb-3">
        <label>Tên sản phẩm</label>
        <input name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Danh mục</label>
        <select name="category_id" class="form-control" required>
            <?php while ($c = $cats->fetch_assoc()) { ?>
                <option value="<?= $c['id'] ?>"><?= $c['name'] ?></option>
            <?php } ?>
        </select>
    </div>

    <div class="mb-3">
        <label>Ảnh sản phẩm (1)</label>
        <input type="file" name="thumbnail" class="form-control">
    </div>
    <div class="mb-3">
        <label>Ảnh sản phẩm (2)</label>
        <input type="file" name="image1" class="form-control">
    </div>    <div class="mb-3">
        <label>Ảnh sản phẩm (3)</label>
        <input type="file" name="image2" class="form-control">
    </div>

    <div class="mb-3">
        <label>Mô tả</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <button class="btn btn-success">Lưu</button>
    <a href="index.php?act=products" class="btn btn-secondary">Hủy</a>

</form>