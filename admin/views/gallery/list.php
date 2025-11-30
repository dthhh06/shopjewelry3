<h1 class="mt-4">Thư viện hình ảnh</h1>

<a href="index.php?act=galleries-create" class="btn btn-primary mb-3">+ Thêm hình</a>

<div class="card mb-4">
    <div class="card-header">Danh sách hình ảnh</div>

    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Tiêu đề</th>
                    <th>Thumbnail</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php while($g = $galleries->fetch_assoc()) { ?>
                <tr>
                    <td><?= $g['id'] ?></td>
                    <td><?= htmlspecialchars($g['title']) ?></td>
                    <td>
                        <?php if($g['thumbnail']) { ?>
                            <img src="<?= $g['thumbnail'] ?>" width="80">
                        <?php } ?>
                    </td>
                    <td>
                        <a href="index.php?act=galleries-edit&id=<?= $g['id'] ?>" class="btn btn-warning btn-sm">Sửa</a>
                        <a href="index.php?act=galleries-delete&id=<?= $g['id'] ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Xóa hình này?')">Xóa</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
</div>
