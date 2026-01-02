<?php
session_start();
include_once("../database/connection.php");
include_once("../models/paymentmodel.s.php");
include_once("../controllers/paymentcontr.s.php");

// Lấy dữ liệu từ MoMo callback
$orderId    = isset($_GET["orderId"]) ? intval($_GET["orderId"]) : 0;
$resultCode = isset($_GET["resultCode"]) ? intval($_GET["resultCode"]) : -1;
$transId    = isset($_GET["transId"]) ? htmlspecialchars($_GET["transId"]) : "";
$message    = isset($_GET["message"]) ? htmlspecialchars($_GET["message"]) : "";
$amount     = isset($_GET["amount"]) ? intval($_GET["amount"]) : 0;  // ← LẤY SỐ TIỀN TỪ URL

$paymentObj = new PaymentController();
$success = false;
$totalAmount = $amount;  // ← DÙNG LUÔN SỐ TIỀN THỰC TẾ ĐÃ THANH TOÁN
$status_text = "Thanh toán thất bại";
$payment_method = "MoMo Wallet";

if ($orderId > 0) {
    if ($resultCode === 0) {
        $success = true;
        $status_text = "Thanh toán thành công";

        // Nếu vì lý do nào đó amount không có trong URL, mới fallback tính từ cart (nhưng ưu tiên amount từ MoMo)
        if ($totalAmount <= 0 && !empty($_SESSION["cart"])) {
            foreach ($_SESSION["cart"] as $item) {
                $totalAmount += $item['price'] * ($item['quantity'] ?? $item['customer_quantity']);
            }
            $totalAmount += 40000; // phí ship (nếu cần)
        }

        if (!empty($_SESSION["cart"])) {
            $userInfo = [
                "id"           => $_SESSION["id"] ?? 0,
                "fullname"     => $_SESSION["fullname"] ?? "",
                "email"        => $_SESSION["useremail"] ?? "",
                "phone_number" => $_SESSION["phone_number"] ?? "",
                "address"      => $_SESSION["momo_temp_address"] ?? "",
                "note"         => $_SESSION["momo_temp_note"] ?? ""
            ];

            // Gọi placeOrder với phương thức momo và transId
            $paymentObj->placeOrder($userInfo, $_SESSION["cart"], "momo", $transId);
            unset($_SESSION["cart"]);
            unset($_SESSION["momo_temp_address"], $_SESSION["momo_temp_note"]); // xóa temp
        }

        $paymentObj->updateMomo($orderId, "paid", $transId, $resultCode, $message);
    } else {
        $paymentObj->updateMomo($orderId, "failed", $transId, $resultCode, $message);
    }
}

$current_time = date('H:i:s d/m/Y');
?>
<link rel="stylesheet" href="../public/assets/icons/css/all.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />

<div class="payment-wrapper p-5">
    <div class="payment-box">

        <!-- ICON + TITLE -->
        <div class="text-center mb-4">
            <div class="success-icon">
                <i class="fas fa-check"></i>
            </div>
            <h2 class="text-success fw-bold mt-3">Thanh toán thành công!</h2>
            <p class="text-muted">Thanh toán thành công!</p>
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
                <span>Thông tin đơn hàng:</span>
                <strong>Thanh toán đơn hàng AURELIA Jewelry</strong>
            </div>
            <div class="info-row">
                <span>Số tiền:</span>
                <strong><?= number_format($totalAmount) ?> đ</strong>
            </div>
        </div>

        <!-- TRANSACTION INFO -->
        <div class="info-card mb-4">
            <h6><i class="fas fa-credit-card me-2"></i> Thông tin giao dịch</h6>
            <div class="info-row">
                <span>Phương thức:</span>
                <strong><?= $payment_method ?></strong>
            </div>
            <div class="info-row">
                <span>Mã giao dịch:</span>
                <strong><?= $transId ?></strong>
            </div>
            <div class="info-row">
                <span>Thời gian:</span>
                <strong><?= $current_time ?></strong>
            </div>
        </div>

        <!-- BUTTONS -->
        <div class="d-flex flex-column align-center mt-4">
            <a href="../templates/customerinfo.php"
                class="btn btn-gold mb-3 px-5">
                <i class="fas fa-receipt me-2"></i> Xem đơn hàng ngay
            </a>

            <a href="../templates/trangchu.php"
                class="btn btn-outline-gold px-5">
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
        background: #f5f6fa;
    }

    .payment-box {
        width: 100%;
        max-width: 700px;
        background: #ffffff;
        padding: 32px;
        border-radius: 24px;
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.15);
    }

    /* Success icon */
    .success-icon {
        width: 90px;
        height: 90px;
        border-radius: 50%;
        background: #bdf0cfff !important;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: auto;
    }

    .success-icon i {
        font-size: 40px;
        color: green !important;
    }

    /* Countdown */
    .countdown-box {
        background: linear-gradient(135deg, #c77dff, #9d4edd);
        color: #fff;
        padding: 14px 20px;
        border-radius: 999px;
        text-align: center;
        font-size: 15px;
    }

    /* Info cards */
    .info-card {
        background: #f8f9fb;
        border-radius: 16px;
        padding: 20px;
    }

    .info-card h6 {
        font-weight: 700;
        margin-bottom: 15px;
    }

    .info-row {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 15px;
    }

    .btn-gradient {
        background: linear-gradient(135deg, #9d4edd, #7b2cbf);
        color: #fff;
        font-weight: 600;
        padding: 14px;
        border-radius: 14px;
        border: none;
    }

    .btn-gradient:hover {
        opacity: 0.9;
        color: #fff;
    }

    .payment-wrapper {
        background: linear-gradient(135deg, #fff8e1, #fdf3c4);
    }

    .payment-box {
        background: linear-gradient(180deg, #fffdf7, #fff7db);
        border: 1px solid #f1d98c;
    }

    .success-icon {
        background: #fff4cc;
    }

    .success-icon i {
        color: #c9a227;
    }

    .countdown-box {
        background: linear-gradient(135deg, #f1c40f, #d4ac0d);
    }

    .info-card {
        background: #fffaf0;
        border: 1px solid #f3e1a5;
    }

    .info-card h6 {
        color: #a67c00;
    }

    .text-success {
        color: green !important;
    }

    .btn-gold {
        background: linear-gradient(135deg, #f1c40f, #d4ac0d);
        color: #3d2f00;
        font-weight: 700;
        padding: 14px;
        border-radius: 16px;
        box-shadow: 0 8px 20px rgba(212, 172, 13, 0.4);
        border: none;
    }

    .btn-gold:hover {
        background: linear-gradient(135deg, #d4ac0d, #b7950b);
        color: #3d2f00;
    }

    .btn-outline-gold {
        background: #fff;
        color: #b7950b;
        font-weight: 600;
        padding: 14px;
        border-radius: 16px;
        border: 2px solid #f1c40f;
    }

    .btn-outline-gold:hover {
        background: #fff6d6;
        color: #7d6608;
    }
</style>
<script>
    let seconds = 10;
    const countdownEl = document.getElementById('countdown');
    const redirectUrl = "<?php echo $success ? '../templates/customerinfo.php' : '../templates/trangchu.php'; ?>";

    const timer = setInterval(() => {
        seconds--;
        countdownEl.textContent = seconds;
        if (seconds <= 0) {
            clearInterval(timer);
            window.location.href = redirectUrl;
        }
    }, 1000);
</script>