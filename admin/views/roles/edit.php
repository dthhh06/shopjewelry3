<h1 class="mt-4">Chỉnh sửa Role: <?= htmlspecialchars($role['name']) ?></h1>

<form action="index.php?act=role-update" method="POST" class="w-50">
    <input type="hidden" name="id" value="<?= $role['id'] ?>">

    <div class="mb-3">
        <label class="form-label">Tên Role <span class="text-danger">*</span></label>
        <input type="text" name="name" class="form-control" value="<?= htmlspecialchars($role['name']) ?>" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Mô tả</label>
        <textarea name="description" class="form-control" rows="4"><?= htmlspecialchars($role['description'] ?? '') ?></textarea>
    </div>

    <button type="submit" class="btn btn-success">
        <i class="fas fa-save me-1"></i> Cập nhật
    </button>
    <a href="index.php?act=role" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i> Quay lại
    </a>
</form>