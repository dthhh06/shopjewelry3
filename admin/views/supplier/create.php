<h1 class="mt-4">Thêm nhà cung cấp</h1>

<form action="index.php?act=supplier-store" method="POST" class="w-50">

    <div class="mb-3">
        <label class="form-label">Tên NCC</label>
        <input type="text" name="name" required class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Địa chỉ</label>
        <input type="text" name="address" required class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Liên lạc</label>
        <input type="text" name="contact" required class="form-control">
    </div>

    <button class="btn btn-success">Lưu</button>
    <a href="index.php?act=supplier" class="btn btn-secondary">Quay lại</a>
</form>
