<h1 class="mt-4">Quản lý danh mục</h1>

<a href="index.php?act=category-create" class="btn btn-primary mb-3">+ Thêm danh mục</a>

<div class="card mb-4">
    <div class="card-header">Danh sách danh mục</div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên danh mục</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php while($c = $categories->fetch_assoc()) { ?>
                <tr>
                    <td><?= $c['id'] ?></td>
                    <td><?= $c['name'] ?></td>
                    <td>
                        <a href="index.php?act=category-edit&id=<?= $c['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="index.php?act=category-delete&id=<?= $c['id'] ?>" class="btn btn-danger btn-sm"
                           onclick="return confirm('Xóa danh mục?')">Xóa</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
</div>
