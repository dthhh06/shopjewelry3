<h1 class="mt-4">Thêm Role mới</h1>

<form action="index.php?act=role-store" method="POST" class="w-50">
    <div class="mb-3">
        <label class="form-label">Tên Role <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Mô tả</label>
        <textarea name="description" class="form-control" rows="4"></textarea>
    </div>

    <button type="submit" class="btn btn-success">
        <i class="fas fa-save me-1"></i> Lưu Role
    </button>
    <a href="index.php?act=role" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i> Quay lại
    </a>
</form>