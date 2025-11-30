<h1 class="mt-4">Sửa hình ảnh</h1>

<form action="index.php?act=galleries-update" method="POST" enctype="multipart/form-data" class="w-50">

    <input type="hidden" name="id" value="<?= $gallery['id'] ?>">

    <div class="mb-3">
        <label class="form-label">Tiêu đề</label>
        <input type="text" name="title" class="form-control" 
               value="<?= htmlspecialchars($gallery['title']) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Ảnh hiện tại</label><br>
        <img src="<?= $gallery['thumbnail'] ?>" width="120">
    </div>

    <div class="mb-3">
        <label class="form-label">Thay ảnh mới (nếu muốn)</label>
        <input type="file" name="thumbnail" class="form-control">
    </div>

    <button class="btn btn-success">Cập nhật</button>
    <a href="index.php?act=galleries" class="btn btn-secondary">Quay lại</a>

</form>

