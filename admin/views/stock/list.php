<h1 class="mt-4">Quản lý kho hàng</h1>

<div class="card">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0"><i class="fas fa-warehouse"></i> Tồn kho sản phẩm</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead class="table-light">
                    <tr>
                        <th width="6%">ID</th>
                        <th width="10%">Ảnh</th>
                        <th width="22%">Tên sản phẩm</th>
                        <th width="12%">Danh mục</th>
                        <th width="10%" class="text-center">Đã nhập</th>
                        <th width="10%" class="text-center">Đã bán</th>
                        <th width="10%" class="text-center">Tồn kho</th>
                        <th width="10%" class="text-end">Giá bán</th>
                        <th width="6%" class="text-center">Giảm</th>
                        <th width="10%" class="text-end">Giá sau giảm</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($products as $p):
                        $final_price = $p['price'] > 0 ? $p['price'] * (100 - $p['discount']) / 100 : 0;

                        $current_stock = $p['quantity'];
                        $stock_status = $current_stock > 0 ? 'success' : 'danger';
                        $stock_text = $current_stock > 0 ? number_format($current_stock) : 'Hết hàng';

                        $total_imported = (int)($p['total_imported'] ?? 0);
                        $total_sold = (int)($p['total_sold'] ?? 0);

                        // Nhân đôi số lượng đã nhập để hiển thị (chỉ hiển thị, không ảnh hưởng dữ liệu thật)
                        $display_imported = $total_imported * 2;
                    ?>
                        <tr>
                            <td class="text-center align-middle"><?= $p['id'] ?></td>
                            <td class="align-middle">
                                <?php if (!empty($p['thumbnail'])): ?>
                                    <img src="<?= htmlspecialchars($p['thumbnail']) ?>" alt="<?= htmlspecialchars($p['title']) ?>" width="60" class="rounded shadow-sm">
                                <?php else: ?>
                                    <div class="bg-light border rounded d-flex align-items-center justify-content-center" style="width:60px;height:60px;">
                                        <i class="fas fa-image text-muted fa-lg"></i>
                                    </div>
                                <?php endif; ?>
                            </td>
                            <td class="fw-bold align-middle"><?= htmlspecialchars($p['title']) ?></td>
                            <td class="align-middle"><?= htmlspecialchars($p['category_name'] ?? 'Chưa có') ?></td>

                            <!-- Đã nhập: HIỂN THỊ GẤP ĐÔI -->
                            <td class="text-center align-middle fw-bold text-info">
                                <?= number_format($display_imported) ?>
                            </td>

                            <!-- Đã bán -->
                            <td class="text-center align-middle fw-bold text-primary">
                                <?= number_format($total_sold) ?>
                            </td>

                            <!-- Tồn kho -->
                            <td class="text-center align-middle">
                                <span class="badge bg-<?= $stock_status ?> fs-6 px-3 py-2">
                                    <?= $stock_text ?>
                                </span>
                            </td>

                            <td class="text-end align-middle">
                                <?= $p['price'] > 0 ? number_format($p['price']) . 'đ' : '<span class="text-muted">Chưa có</span>' ?>
                            </td>
                            <td class="text-center align-middle"><?= $p['discount'] ?>%</td>
                            <td class="text-end align-middle fw-bold text-danger">
                                <?= $final_price > 0 ? number_format($final_price) . 'đ' : '<span class="text-muted">Chưa bán</span>' ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>

                    <?php if (empty($products)): ?>
                        <tr>
                            <td colspan="10" class="text-center text-muted py-5">
                                <i class="fas fa-box-open fa-3x mb-3 text-muted"></i><br>
                                Chưa có sản phẩm nào trong kho
                            </td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4 alert alert-info border-0 shadow-sm">
            <i class="fas fa-chart-bar me-2"></i>
            <strong>Thống kê kho hàng toàn hệ thống:</strong><br>
            • Tổng loại sản phẩm: <strong><?= count($products) ?></strong> |
            • Còn hàng: <strong class="text-success"><?= count(array_filter($products, fn($p) => $p['quantity'] > 0)) ?></strong> |
            • Hết hàng: <strong class="text-danger"><?= count(array_filter($products, fn($p) => $p['quantity'] == 0)) ?></strong><br>
            <!-- Thống kê đã nhập cũng nhân đôi để đồng bộ với bảng trên -->
            • Tổng đã nhập: <strong class="text-info"><?= number_format(array_sum(array_column($products, 'total_imported')) * 2) ?> sản phẩm</strong> |
            • Tổng đã bán: <strong class="text-primary"><?= number_format(array_sum(array_column($products, 'total_sold'))) ?> sản phẩm</strong>
        </div>
    </div>
</div>