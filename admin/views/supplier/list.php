<h1 class="mt-4">Nhà cung cấp</h1>

<a href="index.php?act=supplier-create" class="btn btn-success mb-3">+ Thêm nhà cung cấp</a>

<div class="card mb-4">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tên NCC</th>
                    <th>Địa chỉ</th>
                    <th>Liên hệ</th>
                    <th width="150">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($suppliers as $s): ?>
                <tr>
                    <td><?= $s["id"] ?></td>
                    <td><?= $s["name"] ?></td>
                    <td><?= $s["address"] ?></td>
                    <td><?= $s["contact"] ?></td>
                    <td>
                        <a href="index.php?act=supplier-edit&id=<?= $s['id'] ?>" class="btn btn-sm btn-warning">Sửa</a>
                        <a href="index.php?act=supplier-delete&id=<?= $s['id'] ?>" class="btn btn-sm btn-danger" onclick="return confirm('Xóa?')">Xóa</a>
                    </td>
                </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
