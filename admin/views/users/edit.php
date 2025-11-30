<h1 class="mt-4">Sửa user</h1>

<form method="POST" action="index.php?act=user-update" class="w-75">

    <input type="hidden" name="id" value="<?= $user['id'] ?>">

    <div class="mb-3">
        <label>Họ tên</label>
        <input name="fullname" value="<?= $user['fullname'] ?>" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Email</label>
        <input name="email" type="email" value="<?= $user['email'] ?>" class="form-control" required>
    </div>

    <div class="mb-3">
        <label>Số điện thoại</label>
        <input name="phone_number" value="<?= $user['phone_number'] ?>" class="form-control">
    </div>

    <div class="mb-3">
        <label>Mật khẩu mới (bỏ trống nếu không đổi)</label>
        <input name="password" type="password" class="form-control">
    </div>

    <div class="mb-3">
        <label>Role</label>
        <select name="role_id" class="form-control">
            <?php while($r = $roles->fetch_assoc()) { ?>
                <option value="<?= $r['id'] ?>"
                    <?= $r['id'] == $user['role_id'] ? 'selected' : '' ?>>
                    <?= $r['name'] ?>
                </option>
            <?php } ?>
        </select>
    </div>

    <button class="btn btn-success">Cập nhật</button>
    <a href="index.php?act=users" class="btn btn-secondary">Quay lại</a>

</form>
