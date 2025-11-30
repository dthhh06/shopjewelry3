<h1 class="mt-4">Sửa Role</h1>

<form action="index.php?act=role-update" method="POST" class="w-50">

    <input type="hidden" name="id" value="<?= $role['id'] ?>">

    <div class="mb-3">
        <label>Tên Role</label>
        <input name="name" class="form-control" value="<?= $role['name'] ?>" required>
    </div>

    <button class="btn btn-success">Cập nhật</button>
    <a href="index.php?act=roles" class="btn btn-secondary">Quay lại</a>
</form>
