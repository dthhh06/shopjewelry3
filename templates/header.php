<?php
session_start();

/* --- CART QUANTITY (FAST) --- */
$totalOfQuantiy = 0;

if (!empty($_SESSION['cart'])) {
    // dùng array_sum cho nhanh thay vì foreach
    $totalOfQuantiy = array_sum(
        array_map(fn($p) => intval($p['customer_quantity']), $_SESSION['cart'])
    );
}

/* --- CATEGORY QUERY --- */
require_once($_SERVER['DOCUMENT_ROOT'] . '/shopjewelry3/database/connection.php');

$db = new Database();
$pdo = $db->connect();

$stmt = $pdo->prepare("SELECT id, name FROM category WHERE isDeleted = 0 ORDER BY id DESC");
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Icons + Base CSS -->
<!-- <link rel="stylesheet" href="../public/assets/icons/css/all.min.css"> -->
<link rel="stylesheet" href="../public/assets/css/header.css">
<script src="../public/assets/libs/jquery-3.7.1.min.js"></script>

<header class="tiffany-header" id="tiffanyHeader" role="banner">
    <div class="header-inner">

        <!-- LEFT: LOCATION BUTTON -->
        <a href="javascript:void(0)" class="icon-btn location-btn" title="Location">
            <i class="fa-solid fa-location-dot"></i>
        </a>

        <!-- CENTER LOGO -->
        <a href="./trangchu.php" class="tiffany-logo">
            <i class="fas fa-gem"></i>Aurelia
        </a>

        <!-- RIGHT SECTION -->
        <div class="right-area">

            <!-- USER DROPDOWN -->
            <div class="header-user" id="headerUser">
                <button class="header-user-btn icon-btn" id="userBtn" aria-expanded="false" aria-controls="userDropdown">
                    <i class="fa-regular fa-user"></i>
                </button>

                <div class="header-user-dropdown" id="userDropdown" role="menu" aria-hidden="true">

                    <?php if (!empty($_SESSION['id'])): ?>
                        <a href="./customerinfo.php" class="ud-item">
                            <i class="fa-solid fa-user"></i>
                            <span class="ud-text"><?= htmlspecialchars($_SESSION['fullname']) ?></span>
                        </a>
                        <a href="../includes/logout.inc.php" class="ud-item">
                            <i class="fa-solid fa-power-off"></i>
                            <span class="ud-text">Đăng xuất</span>
                        </a>

                    <?php else: ?>
                        <a href="../templates/login.php" class="ud-item">
                            <i class="fa-solid fa-user-plus"></i>
                            <span class="ud-text">Đăng nhập</span>
                        </a>
                        <a href="../templates/signup.php" class="ud-item">
                            <i class="fa-solid fa-right-from-bracket"></i>
                            <span class="ud-text">Đăng ký</span>
                        </a>
                    <?php endif; ?>

                </div>
            </div>

            <!-- CART -->
            <a href="javascript:void(0)" class="shoppingcart icon-btn" title="Giỏ hàng" data-preserve-old-cart="1">
                <i class="fa-solid fa-cart-shopping"></i>
                <span class="quantity-badge"><?= $totalOfQuantiy ?></span>
            </a>

        </div>
    </div>

    <!-- NAVIGATION -->
    <nav class="tiffany-nav" role="navigation" aria-label="Main Navigation">
        <ul class="nav-list" >

            <li class="nav-item">
                <a href="../templates/trangchu.php" style="text-decoration: none !important;">TRANG CHỦ</a>
            </li>

            <li class="item dropdown position-static">
                <a href="../templates/SanPham.php" class="text-decoration-none" >SẢN PHẨM</a>

                <ul class="child-list-items show-on-hover">
                    <?php if ($categories): ?>
                        <?php foreach ($categories as $c): ?>
                            <li class="child-item">
                                <a href="/shopjewelry3/templates/SanPham.php?category_id=<?= $c['id'] ?>">
                                    <?= htmlspecialchars($c['name']) ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <li class="child-item">Không có loại sản phẩm</li>
                    <?php endif; ?>
                </ul>
            </li>

            <li class="nav-item"><a href="../templates/gioithieu.php">GIỚI THIỆU</a></li>
            <li class="nav-item"><a href="../templates/feedback.php">PHẢN HỒI</a></li>

        </ul>
    </nav>

    <script src="../public/js/header.js"></script>

</header>
