<h1 class="mt-4">Sửa nhà cung cấp</h1>

<form action="index.php?act=supplier-update" method="POST" class="w-50">

    <input type="hidden" name="id" value="<?= $supplier['id'] ?>">

    <div class="mb-3">
        <label class="form-label">Tên NCC</label>
        <input type="text" name="name" value="<?= $supplier['name'] ?>" required class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Địa chỉ</label>
        <input type="text" name="address" value="<?= $supplier['address'] ?>" required class="form-control">
    </div>

    <div class="mb-3">
        <label class="form-label">Liên hệ</label>
        <input type="text" name="phone" value="<?= $supplier['contact'] ?>" required class="form-control">
    </div>

    <button class="btn btn-success">Cập nhật</button>
    <a href="index.php?act=supplier" class="btn btn-secondary">Quay lại</a>
</form>
