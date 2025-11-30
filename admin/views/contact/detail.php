<h1 class="mt-4">Chi tiết liên hệ</h1>

<div class="card">
    <div class="card-body">

        <p><strong>Họ tên:</strong> <?= htmlspecialchars($contact['fullname']) ?></p>
        <p><strong>Email:</strong> <?= htmlspecialchars($contact['email']) ?></p>
        <p><strong>Số điện thoại:</strong> <?= htmlspecialchars($contact['phone_number']) ?></p>
        <p><strong>Nội dung:</strong></p>
        <p><?= nl2br(htmlspecialchars($contact['content'])) ?></p>

        <a href="index.php?act=contact" class="btn btn-secondary mt-3">Quay lại</a>
    </div>
</div>
