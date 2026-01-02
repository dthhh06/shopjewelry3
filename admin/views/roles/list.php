<h1 class="mt-4">Quản lý Role</h1>

<a href="index.php?act=role-create" class="btn btn-primary mb-3">+ Thêm Role mới</a>

<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-shield-halved me-1"></i>
        Danh sách Role
    </div>
    <div class="card-body">
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <?php 
                $msg = match ($_GET['success']) {
                    'created' => 'Thêm role thành công!',
                    'updated' => 'Cập nhật thành công!',
                    'deleted' => 'Xóa role thành công!',
                    default => 'Lưu thành công!'
                };
                echo $msg;
                ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        <?php endif; ?>

        <table class="table table-bordered table-hover">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tên Role</th>
                    <th>Mô tả</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($roles as $role): ?>
                <tr>
                    <td><?= $role['id'] ?></td>
                    <td><strong><?= htmlspecialchars($role['name']) ?></strong></td>
                    <td><?= htmlspecialchars($role['description'] ?? '') ?></td>
                    <td>
                        <a href="index.php?act=role-edit&id=<?= $role['id'] ?>" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Sửa
                        </a>
                        <a href="index.php?act=role-permissions&id=<?= $role['id'] ?>" class="btn btn-info btn-sm">
                            <i class="fas fa-key"></i> Phân quyền
                        </a>
                        <?php if ($role['id'] > 3): ?>
                        <a href="index.php?act=role-delete&id=<?= $role['id'] ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Xóa role này?')">
                            <i class="fas fa-trash"></i> Xóa
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>