<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>AURELLIA Admin</title>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- SweetAlert2 CSS (chỉ CSS ở head) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <!-- SB Admin 2 CSS -->
    <link href="assets/css/styles.css" rel="stylesheet" />
</head>

<body class="sb-nav-fixed">

    <?php include "navbar.php"; ?>

    <div id="layoutSidenav">
        <?php include "sidebar.php"; ?>

        <div id="layoutSidenav_content">
            <main class="p-4">
                <?php include $view; ?>
            </main>

            <?php include "footer.php"; ?>
        </div>
    </div>

    <!-- Core JS -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- SB Admin 2 Scripts -->
    <script src="assets/js/scripts.js"></script>

    <!-- SweetAlert2 JS + Xử lý thông báo chung (phải ở cuối body) -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '<?= addslashes($msg) ?>',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
        <?php endif; ?>

        <?php if (isset($_SESSION['error'])): ?>
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: '<?= addslashes($_SESSION['error']) ?>',
                confirmButtonText: 'OK'
            });
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '<?= addslashes($_SESSION['success']) ?>',
                timer: 3000,
                timerProgressBar: true,
                showConfirmButton: false
            });
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
    });
    </script>

</body>

</html>