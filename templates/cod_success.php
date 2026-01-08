<?php
session_start();

// Kiểm tra xem có dữ liệu đơn hàng hợp lệ không (an toàn hơn là kiểm tra last_order_id)
if (!isset($_SESSION["last_order_id"]) || $_SESSION["last_order_id"] <= 0) {
    header("Location: ../templates/trangchu.php");
    exit();
}

// Lấy thông tin từ session
$orderId = $_SESSION["last_order_id"];
$totalAmount = $_SESSION["last_total_amount"] ?? 0;
$userFullname = $_SESSION["fullname"] ?? "Khách hàng";
$current_time = date('H:i:s d/m/Y');
$payment_method = "Thanh toán khi nhận hàng (COD)";

// Xóa các session tạm sau khi dùng (tùy chọn, tránh xem lại nhiều lần)
unset($_SESSION["last_order_id"], $_SESSION["last_total_amount"], $_SESSION["order_placed"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đặt hàng thành công - Aurelia</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Fontawesome -->
    <link rel="stylesheet" href="../public/assets/icons/css/all.min.css">
</head>
<body>

<div class="payment-wrapper p-5">
    <div class="payment-box">

        <!-- ICON + TITLE -->
        <div class="text-center mb-4">
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>
            <h2 class="text-success fw-bold mt-3">Đặt hàng thành công!</h2>
            <p class="text-muted">Cảm ơn quý khách đã tin tưởng Aurelia Jewelry</p>
        </div>

        <!-- COUNTDOWN -->
        <div class="countdown-box mb-4">
            <i class="fas fa-clock me-2"></i>
            Tự động chuyển đến trang đơn hàng sau
            <strong><span id="countdown">10</span> giây</strong>...
        </div>

        <!-- ORDER INFO -->
        <div class="info-card mb-3">
            <h6><i class="fas fa-box me-2"></i> Thông tin đơn hàng</h6>
            <div class="info-row">
                <span>Mã đơn hàng:</span>
                <strong>#<?= str_pad($orderId, 8, '0', STR_PAD_LEFT) ?></strong>
            </div>
            <div class="info-row">
                <span>Khách hàng:</span>
                <strong><?= htmlspecialchars($userFullname) ?></strong>
            </div>
            <div class="info-row">
                <span>Tổng tiền:</span>
                <strong><?= number_format($totalAmount) ?> VND</strong>
            </div>
            <div class="info-row">
                <span>Phương thức thanh toán:</span>
                <strong>Thanh toán khi nhận hàng (COD)</strong>
            </div>
        </div>

        <!-- TRANSACTION INFO -->
        <div class="info-card mb-4">
            <h6><i class="fas fa-truck me-2"></i> Thông tin vận chuyển</h6>
            <div class="info-row">
                <span>Thời gian đặt:</span>
                <strong><?= $current_time ?></strong>
            </div>
            <div class="info-row">
                <span>Ghi chú:</span>
                <strong>Đơn hàng sẽ được giao trong 3-7 ngày</strong>
            </div>
        </div>

        <!-- BUTTONS -->
        <div class="d-flex flex-column align-items-center mt-4">
            <a href="../templates/customerinfo.php" class="btn btn-gold mb-3 px-5">
                <i class="fas fa-receipt me-2"></i> Xem chi tiết đơn hàng
            </a>

            <a href="../templates/trangchu.php" class="btn btn-outline-gold px-5">
                <i class="fas fa-home me-2"></i> Tiếp tục mua sắm
            </a>
        </div>
    </div>
</div>

<style>
    .payment-wrapper {
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        background: linear-gradient(135deg, #fff8e1, #fdf3c4);
    }

    .payment-box {
        width: 100%;
        max-width: 700px;
        background: linear-gradient(180deg, #fffdf7, #fff7db);
        padding: 40px;
        border-radius: 24px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
        border: 1px solid #f1d98c;
    }

    .success-icon {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: #fff4cc;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto;
    }

    .success-icon i {
        font-size: 40px;
        color: #c9a227;
    }

    .countdown-box {
        background: linear-gradient(135deg, #f1c40f, #d4ac0d);
        color: #3d2f00;
        padding: 14px 20px;
        border-radius: 999px;
        text-align: center;
        font-size: 15px;
        font-weight: 600;
    }

    .info-card {
        background: #fffaf0;
        border-radius: 16px;
        padding: 20px;
        border: 1px solid #f3e1a5;
    }

    .info-card h6 {
        font-weight: 700;
        margin-bottom: 15px;
        color: #a67c00;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 12px;
        font-size: 15px;
    }

    .btn-gold {
        background: linear-gradient(135deg, #f1c40f, #d4ac0d);
        color: #3d2f00;
        font-weight: 700;
        padding: 14px 30px;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(212, 172, 13, 0.4);
        border: none;
        transition: all 0.3s;
    }

    .btn-gold:hover {
        background: linear-gradient(135deg, #d4ac0d, #b7950b);
        transform: translateY(-2px);
    }

    .btn-outline-gold {
        background: #fff;
        color: #b7950b;
        font-weight: 600;
        padding: 14px 30px;
        border-radius: 16px;
        border: 2px solid #f1c40f;
        transition: all 0.3s;
    }

    .btn-outline-gold:hover {
        background: #fff6d6;
        color: #7d6608;
        border-color: #d4ac0d;
    }
</style>

<script>
    // Countdown tự động redirect
    let seconds = 10;
    const countdownEl = document.getElementById('countdown');

    const timer = setInterval(() => {
        seconds--;
        countdownEl.textContent = seconds;
        if (seconds <= 0) {
            clearInterval(timer);
            window.location.href = "../templates/customerinfo.php";
        }
    }, 1000);
</script>

</body>
</html>