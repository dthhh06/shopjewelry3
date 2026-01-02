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
                        <th width="8%">ID</th>
                        <th width="10%">Ảnh</th>
                        <th width="30%">Tên sản phẩm</th>
                        <th width="15%">Danh mục</th>
                        <th width="12%" class="text-end">Tồn kho</th>
                        <th width="12%" class="text-end">Giá bán</th>
                        <th width="8%" class="text-center">Giảm (%)</th>
                        <th width="15%" class="text-end">Giá sau giảm</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // $products lấy từ controller (getAll())
                    foreach ($products as $p): 
                        $final_price = $p['price'] > 0 ? $p['price'] * (100 - $p['discount']) / 100 : 0;
                        $stock_status = $p['quantity'] > 0 ? 'success' : 'danger';
                        $stock_text = $p['quantity'] > 0 ? $p['quantity'] : 'Hết hàng';
                    ?>
                    <tr>
                        <td class="text-center"><?= $p['id'] ?></td>
                        <td>
                            <?php if (!empty($p['thumbnail'])): ?>
                                <img src="<?= $p['thumbnail'] ?>" alt="<?= htmlspecialchars($p['title']) ?>" width="60" class="rounded">
                            <?php else: ?>
                                <div class="bg-light border rounded d-flex align-items-center justify-content-center" style="width:60px;height:60px;">
                                    <i class="fas fa-image text-muted"></i>
                                </div>
                            <?php endif; ?>
                        </td>
                        <td class="fw-bold"><?= htmlspecialchars($p['title']) ?></td>
                        <td><?= htmlspecialchars($p['category_name'] ?? 'Chưa có') ?></td>
                        <td class="text-end">
                            <span class="badge bg-<?= $stock_status ?> fs-6">
                                <?= $stock_text ?>
                            </span>
                        </td>
                        <td class="text-end">
                            <?php if ($p['price'] > 0): ?>
                                <?= number_format($p['price']) ?>đ
                            <?php else: ?>
                                <span class="text-muted">Chưa có giá</span>
                            <?php endif; ?>
                        </td>
                        <td class="text-center"><?= $p['discount'] ?>%</td>
                        <td class="text-end fw-bold text-primary">
                            <?php if ($final_price > 0): ?>
                                <?= number_format($final_price) ?>đ
                            <?php else: ?>
                                <span class="text-muted">Chưa bán</span>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>

                    <?php if (empty($products)): ?>
                    <tr>
                        <td colspan="8" class="text-center text-muted py-4">
                            Chưa có sản phẩm nào trong kho
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <div class="mt-4 alert alert-info">
            <i class="fas fa-info-circle"></i>
            <strong>Thống kê nhanh:</strong>
            Tổng sản phẩm: <strong><?= count($products) ?></strong> | 
            Còn hàng: <strong class="text-success"><?= array_reduce($products, fn($carry, $p) => $carry + ($p['quantity'] > 0 ? 1 : 0), 0) ?></strong> | 
            Hết hàng: <strong class="text-danger"><?= array_reduce($products, fn($carry, $p) => $carry + ($p['quantity'] == 0 ? 1 : 0), 0) ?></strong>
        </div>
    </div>
</div>