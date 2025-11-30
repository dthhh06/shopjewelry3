<h1 class="mt-4">Thêm người dùng</h1>

<form method="POST" action="index.php?act=user-store" class="w-75">

    <div class="mb-3">
        <label>Họ tên</label>
        <input name="fullname" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input name="email" type="email" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Số điện thoại</label>
        <input name="phone_number" class="form-control">
    </div>

    <div class="mb-3">
        <label>Mật khẩu</label>
        <input name="password" type="password" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Role</label>
        <select name="role_id" class="form-control">
            <?php while($r = $roles->fetch_assoc()) { ?>
                <option value="<?= $r['id'] ?>"><?= $r['name'] ?></option>
            <?php } ?>
        </select>
    </div>

    <button class="btn btn-success">Lưu</button>
    <a href="index.php?act=users" class="btn btn-secondary">Hủy</a>

</form>
