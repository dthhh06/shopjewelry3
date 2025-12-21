<?php
session_start();
$adminName = $_SESSION["fullname"] ?? "Admin";
$adminAvatar = "../assets/imgs/admin/admin.jpg";
?>

<nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">

    <!-- Logo -->
    <a class="navbar-brand ps-3" href="index.php">AURELLIA Admin</a>

    <!-- Toggle sidebar -->
    <button class="btn btn-link btn-sm order-1 order-lg-0 me-4" id="sidebarToggle">
        <i class="fas fa-bars"></i>
    </button>

    <!-- Right side -->
    <ul class="navbar-nav ms-auto me-3 me-lg-4">

        <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button"
                data-bs-toggle="dropdown" aria-expanded="false">

                <img src="<?= $adminAvatar ?>"
                    style="width:32px; height:32px; border-radius:50%; object-fit:cover; margin-right:6px;">
                <?= $adminName ?>
            </a>

            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">

                <li>
                    <a class="dropdown-item" href="../templates/trangchu.php">
                        <i class="fa-solid fa-house me-2"></i> Trang chủ
                    </a>

                </li>

                <li>
                    <hr class="dropdown-divider" />
                </li>

                <li>
                    <a class="dropdown-item text-danger" href="../includes/logout.inc.php">
                        <i class="fa-solid fa-right-from-bracket me-2"></i> Đăng xuất
                    </a>
                </li>

            </ul>

        </li>
    </ul>
</nav>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        console.log(typeof bootstrap); // phải ra "object"
    });
    document.addEventListener("DOMContentLoaded", function() {
        const toggle = document.getElementById("navbarDropdown");
        const menu = toggle.nextElementSibling;

        toggle.addEventListener("click", function(e) {
            e.preventDefault();
            e.stopPropagation();
            menu.classList.toggle("show");
        });

        document.addEventListener("click", function() {
            menu.classList.remove("show");
        });
    });
</script>