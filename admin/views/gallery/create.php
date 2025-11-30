<h1 class="mt-4">Thêm hình mới</h1>

<form action="index.php?act=galleries-store" method="POST" enctype="multipart/form-data" class="w-50">

    <div class="mb-3">
        <label class="form-label">Tiêu đề</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Ảnh</label>
        <input type="file" name="thumbnail" class="form-control" required>
    </div>

    <button class="btn btn-success">Lưu</button>
    <a href="index.php?act=galleries" class="btn btn-secondary">Quay lại</a>

</form>
