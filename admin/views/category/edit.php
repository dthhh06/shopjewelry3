<h1 class="mt-4">Sửa danh mục</h1>

<form action="index.php?act=category-update" method="POST" class="w-50">

    <input type="hidden" name="id" value="<?= $category['id'] ?>">

    <div class="mb-3">
        <label class="form-label">Tên danh mục</label>
        <input type="text" name="name" class="form-control"
               value="<?= $category['name'] ?>" required>
    </div>

    <button class="btn btn-success">Cập nhật</button>
    <a href="index.php?act=category" class="btn btn-secondary">Quay lại</a>

</form>
