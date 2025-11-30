<h1 class="mt-4">Quản lý vai trò</h1>

<a href="index.php?act=role-create" class="btn btn-primary mb-3">+ Thêm vai trò</a>

<div class="card mb-4">
    <div class="card-body">
        
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên vai trò</th>
                    <th>Privilege</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php while($r = $roles->fetch_assoc()) { ?>
                <tr>
                    <td><?= $r['id'] ?></td>
                    <td><?= $r['name'] ?></td>

                    <td>
                        <a href="index.php?act=role-permissions&id=<?= $r['id'] ?>" 
                           class="btn btn-info btn-sm">
                           <i class="fas fa-shield-alt"></i> Phân quyền
                        </a>
                    </td>

                    <td>
                        <a href="index.php?act=role-edit&id=<?= $r['id'] ?>" 
                           class="btn btn-warning btn-sm">Sửa</a>

                        <a href="index.php?act=role-delete&id=<?= $r['id'] ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Xóa vai trò này?')">Xóa</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>

    </div>
</div>
