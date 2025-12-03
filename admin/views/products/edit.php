<h1 class="mt-4">Sửa sản phẩm</h1>

<form action="index.php?act=product-update" method="POST" enctype="multipart/form-data" class="w-75">

    <input type="hidden" name="id" value="<?= $product['id'] ?>">
    <input type="hidden" name="old_thumbnail" value="<?= $product['thumbnail'] ?>">

    <div class="mb-3">
        <label>Tên sản phẩm</label>
        <input name="title" class="form-control" value="<?= $product['title'] ?>" required>
    </div>

    <div class="mb-3">
        <label>Danh mục</label>
        <select name="category_id" class="form-control">
            <?php while($c = $cats->fetch_assoc()) { ?>
            <option value="<?= $c['id'] ?>" 
                <?= $c['id'] == $product['category_id'] ? 'selected' : '' ?>>
                <?= $c['name'] ?>
            </option>
            <?php } ?>
        </select>
    </div>

    <div class="row">
        <div class="col-md-4 mb-3">
            <label>Giá</label>
            <input name="price" type="number" value="<?= $product['price'] ?>" class="form-control">
        </div>

        <div class="col-md-4 mb-3">
            <label>Giảm (%)</label>
            <input name="discount" type="number" value="<?= $product['discount'] ?>" class="form-control">
        </div>

        <div class="col-md-4 mb-3">
            <label>Số lượng</label>
            <input name="quantity" type="number" value="<?= $product['quantity'] ?>" class="form-control">
        </div>
    </div>

    <div class="mb-3">
        <label>Ảnh hiện tại</label><br>
        <img src="<?= $product['thumbnail'] ?>" width="100">
    </div>

    <div class="mb-3">
        <label>Đổi ảnh mới (1)</label>
        <input type="file" name="thumbnail" class="form-control">
    </div>
        <div class="mb-3">
        <label>Đổi ảnh mới (2)</label>
        <input type="file" name="image1" class="form-control">
    </div>
        <div class="mb-3">
        <label>Đổi ảnh mới (3)</label>
        <input type="file" name="image2" class="form-control">
    </div>

    <div class="mb-3">
        <label>Mô tả</label>
        <textarea name="description" class="form-control"><?= $product['description'] ?></textarea>
    </div>

    <button class="btn btn-success">Cập nhật</button>
    <a href="index.php?act=products" class="btn btn-secondary">Hủy</a>
</form>
