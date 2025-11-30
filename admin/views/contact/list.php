<h1 class="mt-4">Quản lý liên hệ</h1>

<div class="card mb-4">
    <div class="card-header">Danh sách liên hệ</div>

    <div class="card-body">
        <table class="table table-bordered table-hover">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Người gửi</th>
                    <th>Email</th>
                    <th>SĐT</th>
                    <th>Nội dung</th>
                    <th>Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php while($c = $contacts->fetch_assoc()) { ?>
                <tr>
                    <td><?= $c['id'] ?></td>
                    <td><?= htmlspecialchars($c['fullname']) ?></td>
                    <td><?= htmlspecialchars($c['email']) ?></td>
                    <td><?= htmlspecialchars($c['phone_number']) ?></td>
                    <td><?= htmlspecialchars($c['content']) ?></td>
                    <td>
                        <a href="index.php?act=contact-detail&id=<?= $c['id'] ?>" class="btn btn-primary btn-sm">Xem</a>
                        <a href="index.php?act=contact-delete&id=<?= $c['id'] ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Xóa liên hệ này?')">Xóa</a>
                    </td>
                </tr>
                <?php } ?>
            </tbody>

        </table>
    </div>
</div>
