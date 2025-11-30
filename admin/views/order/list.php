<h1 class="mt-4">Quản lý đơn hàng</h1>

<div class="card mb-4">
    <div class="card-header">Danh sách đơn hàng</div>

    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Khách hàng</th>
                    <th>SDT</th>
                    <th>Ngày đặt</th>
                    <th>Tổng tiền</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php while($o = $orders->fetch_assoc()) { ?>
                <tr style="cursor:pointer" onclick="window.location='index.php?act=order-detail&id=<?= $o['id'] ?>'">
                    <td><?= $o['id'] ?></td>
                    <td><?= htmlspecialchars($o['fullname'] ?: $o['user_name']) ?></td>
                    <td><?= htmlspecialchars($o['phone_number']) ?></td>
                    <td><?= $o['order_date'] ?></td>
                    <td><?= number_format($o['total_money']) ?>đ</td>
                    <td>
                        <?php if ($o['status'] == 0) { ?>
                            <span class="badge bg-warning text-dark">Đang xử lý</span>
                        <?php } else { ?>
                            <span class="badge bg-success">Đã duyệt</span>
                        <?php } ?>
                    </td>
                    <td>
                        <a href="index.php?act=order-detail&id=<?= $o['id'] ?>" class="btn btn-sm btn-primary">Xem</a>
                        <a href="index.php?act=order-delete&id=<?= $o['id'] ?>"
                           class="btn btn-sm btn-danger"
                           onclick="event.stopPropagation(); return confirm('Xóa đơn hàng?')">Xóa</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
</div>
