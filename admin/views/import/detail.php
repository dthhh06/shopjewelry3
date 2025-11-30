<h1 class="mt-4">Chi tiết phiếu nhập #<?= $import["id"] ?></h1>

<a href="index.php?act=import" class="btn btn-secondary mb-3">Quay lại</a>

<div class="card mb-4">
    <div class="card-body">

        <!-- Hàng 1 -->
        <div class="row">
            <div class="col-md-6">
                <h5><b>Invoice To</b></h5>
                <p>
                    <b><?= $import["supplier_name"] ?></b><br>
                    Phone: <?= $import["supplier_phone"] ?><br>
                    Address: <?= $import["supplier_address"] ?><br>
                </p>
            </div>

            <div class="col-md-6">
                <h5><b>Employee Name</b></h5>
                <p>
                    <b><?= $import["user_name"] ?></b><br>
                    Email: <?= $import["user_email"] ?><br>
                    Phone: <?= $import["user_phone"] ?><br>
                </p>
            </div>
        </div>

        <hr>

        <!-- Hàng 2 -->
        <div class="row mb-3">
            <div class="col-md-4">
                <h6><b>Created At:</b></h6>
                <?= $import["created_at"] ?>
            </div>
            <div class="col-md-4">
                <h6><b>Payment Information:</b></h6>
                Credit Card
            </div>
        </div>

    </div>
</div>


<!-- Chi tiết sản phẩm -->
<h4>Sản phẩm nhập</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Sản phẩm</th>
            <th>Số lượng</th>
            <th>Giá nhập</th>
            <th>Tổng tiền</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($d = $details->fetch_assoc()): ?>
        <tr>
            <td><?= $d["product_name"] ?></td>
            <td><?= $d["amount"] ?></td>
            <td><?= number_format($d["price"]) ?>đ</td>
            <td><?= number_format($d["total_price"]) ?>đ</td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<div class="alert alert-info">
    <b>Tổng giá trị phiếu nhập:</b> <?= number_format($import["total_import_order"]) ?> đ
</div>
