<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>AURELLIA index</title>

    <!-- SB index CSS -->
    <link href="assets/css/styles.css" rel="stylesheet" />
    <link href="assets/vendor/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="sb-nav-fixed">

    <?php include "navbar.php"; ?>

    <div id="layoutSidenav">
        <?php include "sidebar.php"; ?>

        <div id="layoutSidenav_content">
            <main class="p-4">
                <?php include $view; ?>  <!-- load nội dung của từng trang -->
            </main>

            <?php include "footer.php"; ?>
        </div>
    </div>

    <!-- SB index JS -->
    <script src="assets/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/scripts.js"></script>

</body>
</html>
