<h1 class="mt-4">Chi tiết đơn hàng #<?= $order['id'] ?></h1>

<div class="row">
    <div class="col-md-6">
        <p><strong>Khách hàng:</strong> <?= htmlspecialchars($order['fullname']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($order['email']) ?></p>
        <p><strong>SDT:</strong> <?= htmlspecialchars($order['phone_number']) ?></p>
        <p><strong>Địa chỉ:</strong> <?= htmlspecialchars($order['address']) ?></p>
        <p><strong>Ghi chú:</strong> <?= htmlspecialchars($order['note']) ?></p>
        <p><strong>Ngày đặt:</strong> <?= $order['order_date'] ?></p>
        <p><strong>Tổng tiền:</strong> <?= number_format($order['total_money']) ?>đ</p>
    </div>

    <div class="col-md-6">
        <form action="index.php?act=order-update-status" method="POST" class="mb-3">
            <input type="hidden" name="id" value="<?= $order['id'] ?>">
            <label class="form-label"><strong>Trạng thái</strong></label>
            <select name="status" class="form-select w-50">
                <option value="0" <?= $order['status']==0 ? 'selected' : '' ?>>Đang xử lý</option>
                <option value="1" <?= $order['status']==1 ? 'selected' : '' ?>>Đã duyệt</option>
            </select>
            <button class="btn btn-success mt-2">Cập nhật</button>
            <a href="index.php?act=order" class="btn btn-secondary mt-2">Quay lại</a>
        </form>
    </div>
</div>

<hr>

<h4>Sản phẩm trong đơn</h4>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Hình</th>
            <th>Sản phẩm</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tổng</th>
        </tr>
    </thead>
    <tbody>
        <?php while($d = $details->fetch_assoc()) { ?>
        <tr>
            <td>
                <?php if(!empty($d['thumbnail'])): ?>
                    <img src="<?= htmlspecialchars($d['thumbnail']) ?>" width="60" alt="">
                <?php endif; ?>
            </td>
            <td><?= htmlspecialchars($d['title']) ?></td>
            <td><?= number_format($d['price']) ?>đ</td>
            <td><?= $d['num'] ?></td>
            <td><?= number_format($d['total_money']) ?>đ</td>
        </tr>
        <?php } ?>
    </tbody>
</table>
