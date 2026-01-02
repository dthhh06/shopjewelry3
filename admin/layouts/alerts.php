<!-- SweetAlert2 CDN (chỉ load một lần) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Hàm hiển thị SweetAlert2 chung
function showAlert(type, title, text, timer = null) {
    Swal.fire({
        icon: type,
        title: title,
        text: text,
        confirmButtonText: 'OK',
        allowOutsideClick: false,
        ...(timer && { timer: timer, timerProgressBar: true, showConfirmButton: false })
    });
}

// Xử lý thông báo từ PHP (GET hoặc SESSION)
document.addEventListener('DOMContentLoaded', function() {
    <?php if (isset($_GET['success'])): ?>
        <?php 
        $msg = match ($_GET['success']) {
            'created' => 'Thêm mới thành công!',
            'updated' => 'Cập nhật thành công!',
            'deleted' => 'Xóa thành công!',
            default => 'Thao tác thành công!'
        };
        ?>
        showAlert('success', 'Thành công!', '<?= addslashes($msg) ?>', 3000);
    <?php endif; ?>

    <?php if (isset($_SESSION['error'])): ?>
        showAlert('error', 'Lỗi!', '<?= addslashes($_SESSION['error']) ?>');
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        showAlert('success', 'Thành công!', '<?= addslashes($_SESSION['success']) ?>', 3000);
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <?php if (isset($_GET['msg'])): ?>
        showAlert('info', 'Thông báo', '<?= addslashes($_GET['msg']) ?>', 4000);
    <?php endif; ?>
});
</script>