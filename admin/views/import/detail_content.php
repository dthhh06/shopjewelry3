<div class="mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="text-primary">Phiếu nhập hàng #<?= $import['id'] ?></h2>
        <a href="index.php?act=import" class="btn btn-secondary">← Quay lại</a>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">Nhà cung cấp</h5>
                </div>
                <div class="card-body">
                    <h5><?= htmlspecialchars($import['supplier_name']) ?></h5>
                    <p class="mb-1">ĐT: <?= htmlspecialchars($import['supplier_phone'] ?? 'Chưa có') ?></p>
                    <p class="mb-0">Địa chỉ: <?= htmlspecialchars($import['supplier_address'] ?? 'Chưa có') ?></p>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card h-100">
                <div class="card-header bg-success text-white">
                    <h5 class="mb-0">Nhân viên nhập kho</h5>
                </div>
                <div class="card-body">
                    <h5><?= htmlspecialchars($import['user_name']) ?></h5>
                    <p class="mb-1">Email: <?= htmlspecialchars($import['user_email'] ?? 'Chưa có') ?></p>
                    <p class="mb-0">Ngày nhập: <?= date('d/m/Y H:i', strtotime($import['created_at'])) ?></p>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mb-3">Chi tiết sản phẩm nhập</h4>
    <div class="table-responsive">
        <table class="table table-bordered table-striped">
            <thead class="table-dark">
                <tr>
                    <th width="40%">Sản phẩm</th>
                    <th width="15%" class="text-center">Số lượng</th>
                    <th width="20%" class="text-end">Giá nhập</th>
                    <th width="25%" class="text-end">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $total = 0;
                while ($row = $details->fetch_assoc()):
                    $subtotal = $row['amount'] * $row['price'];
                    $total += $subtotal;
                ?>
                <tr>
                    <td><?= htmlspecialchars($row['product_name']) ?></td>
                    <td class="text-center fw-bold"><?= number_format($row['amount']) ?></td>
                    <td class="text-end"><?= number_format($row['price']) ?> đ</td>
                    <td class="text-end fw-bold text-danger"><?= number_format($subtotal) ?> đ</td>
                </tr>
                <?php endwhile; ?>
                <?php if ($total == 0): ?>
                <tr>
                    <td colspan="4" class="text-center py-4 text-muted">Không có sản phẩm nào</td>
                </tr>
                <?php endif; ?>
            </tbody>
            <tfoot class="table-primary">
                <tr>
                    <th colspan="3" class="text-end fs-5">TỔNG CỘNG</th>
                    <th class="text-end text-danger fs-4 fw-bold"><?= number_format($total) ?> đ</th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>