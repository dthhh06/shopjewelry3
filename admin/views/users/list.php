<h1 class="mt-4">Quản lý người dùng</h1>

<a href="index.php?act=user-create" class="btn btn-primary mb-3">+ Thêm user</a>

<div class="card">
    <div class="card-header">
        <i class="fas fa-users"></i> Danh sách người dùng
    </div>

    <div class="card-body">
        <table class="table table-bordered">

            <thead>
                <tr>
                    <th>ID</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th>SĐT</th>
                    <th>Role</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($u = $users->fetch_assoc()) { ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= $u['fullname'] ?></td>
                    <td><?= $u['email'] ?></td>
                    <td><?= $u['phone_number'] ?></td>
                    <td><?= $u['role_name'] ?></td>
                    <td>
                        <a href="index.php?act=user-edit&id=<?= $u['id'] ?>" 
                           class="btn btn-warning btn-sm">Sửa</a>

                        <a href="index.php?act=user-delete&id=<?= $u['id'] ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Xóa user này?')">Xóa</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
</div>
