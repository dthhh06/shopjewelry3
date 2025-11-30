<h1 class="mt-4">Phiếu nhập hàng</h1>

<a href="index.php?act=import-create" class="btn btn-success mb-3">+ Tạo phiếu nhập</a>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nhà cung cấp</th>
                    <th>Nhân viên</th>
                    <th>Ngày tạo</th>
                    <th>Tổng tiền</th>
                    <th width="150">Thao tác</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($imports as $i): ?>
                    <tr>
                        <td><?= $i['id'] ?></td>
                        <td><?= $i['supplier_name'] ?></td>
                        <td><?= $i['user_name'] ?></td>
                        <td><?= $i['created_at'] ?></td>
                        <td><?= number_format($i['total_import_order']) ?>đ</td>
                        <td>
                            <a href="index.php?act=import-detail&id=<?= $i["id"] ?>"
                                class="btn btn-info btn-sm">
                                Xem
                            </a>

                            <a href="index.php?act=import-delete&id=<?= $i['id'] ?>" class="btn btn-sm btn-danger"
                                onclick="return confirm('Xóa?')">Xóa</a>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>