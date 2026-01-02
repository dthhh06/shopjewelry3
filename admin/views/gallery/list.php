<h1 class="mt-4 mb-4">Thư viện ảnh sản phẩm</h1>

<div class="row g-4">
    <?php while ($p = $products->fetch_assoc()): ?>
        <div class="col-12 mb-4">
            <div class="card border-primary shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-box me-2"></i>
                        <?= htmlspecialchars($p['title']) ?> (ID: <?= $p['id'] ?>)
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <?php if ($p['thumbnail']): ?>
                        <div class="col-md-4">
                            <div class="text-center">
                                <p class="fw-bold text-primary mb-2">Ảnh chính (Thumbnail)</p>
                                <img src="<?= $p['thumbnail'] ?>" class="img-fluid rounded border" style="max-height:250px;">
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if ($p['image1']): ?>
                        <div class="col-md-4">
                            <div class="text-center">
                                <p class="fw-bold text-success mb-2">Ảnh phụ 1</p>
                                <img src="<?= $p['image1'] ?>" class="img-fluid rounded border" style="max-height:250px;">
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if ($p['image2']): ?>
                        <div class="col-md-4">
                            <div class="text-center">
                                <p class="fw-bold text-info mb-2">Ảnh phụ 2</p>
                                <img src="<?= $p['image2'] ?>" class="img-fluid rounded border" style="max-height:250px;">
                            </div>
                        </div>
                        <?php endif; ?>

                        <?php if (!$p['thumbnail'] && !$p['image1'] && !$p['image2']): ?>
                        <div class="col-12 text-center text-muted py-5">
                            <i class="fas fa-image fa-3x mb-3"></i>
                            <p>Chưa có ảnh nào cho sản phẩm này</p>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endwhile; ?>
</div>

<?php if ($products->num_rows == 0): ?>
<div class="text-center py-5">
    <i class="fas fa-images fa-5x text-muted mb-4"></i>
    <h3>Chưa có sản phẩm nào có ảnh</h3>
    <p>Hãy thêm sản phẩm và upload ảnh để hiển thị ở đây</p>
</div>
<?php endif; ?>