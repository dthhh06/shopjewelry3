<h1 class="mt-4">Danh sách sản phẩm</h1>

<a href="index.php?act=product-create" class="btn btn-primary mb-3">+ Thêm sản phẩm</a>

<div class="card">
    <div class="card-header">
        <i class="fas fa-box"></i> Products
    </div>

    <div class="card-body">
        <table class="table table-bordered">
            
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ảnh</th>
                    <th>Tên</th>
                    <th>Danh mục</th>
                    <th>Giá</th>
                    <th>Giảm</th>
                    <th>SL</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($p = $products->fetch_assoc()) { ?>
                <tr>
                    <td><?= $p["id"] ?></td>
                    <td><img src="<?= $p["thumbnail"] ?>" width="60"></td>
                    <td><?= $p["title"] ?></td>
                    <td><?= $p["category_name"] ?></td>
                    <td><?= number_format($p["price"]) ?>đ</td>
                    <td><?= $p["discount"] ?>%</td>
                    <td><?= $p["quantity"] ?></td>
                    <td>
                        <a href="index.php?act=product-edit&id=<?= $p['id'] ?>" 
                           class="btn btn-warning btn-sm">Sửa</a>

                        <a href="index.php?act=product-delete&id=<?= $p['id'] ?>" 
                           onclick="return confirm('Xóa sản phẩm?')" 
                           class="btn btn-danger btn-sm">Xóa</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
</div>
