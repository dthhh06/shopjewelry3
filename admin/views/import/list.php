<h1 class="mt-4">Phiếu nhập hàng</h1>

<a href="index.php?act=import-create" class="btn btn-success mb-3">+ Tạo phiếu nhập</a>

<div class="card">
    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead class="table-light">
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
                        <td><?= htmlspecialchars($i['supplier_name']) ?></td>
                        <td><?= htmlspecialchars($i['user_name']) ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($i['created_at'])) ?></td>
                        <td class="text-end fw-bold"><?= number_format($i['total_import_order'] ?? 0) ?>đ</td>
                        <td>
                            <!-- Link chuyển trang chi tiết -->
                            <a href="index.php?act=import-detail&id=<?= $i['id'] ?>" class="btn btn-info btn-sm">
                                <i class="fas fa-eye"></i> Xem 
                            </a>

                            <!-- Nút xóa -->
                            <a href="index.php?act=import-delete&id=<?= $i['id'] ?>"
                                class="btn btn-danger btn-sm"
                                onclick="return confirm('Bạn có chắc chắn muốn xóa phiếu nhập #<?= $i['id'] ?>?')">
                                <i class="fas fa-trash"></i> Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>