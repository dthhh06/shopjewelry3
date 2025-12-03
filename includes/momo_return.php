<?php
session_start();
include_once("../database/connection.php");
include_once("../models/paymentmodel.s.php");
include_once("../controllers/paymentcontr.s.php");

$orderId = isset($_GET["orderId"]) ? intval($_GET["orderId"]) : 0;
$resultCode = isset($_GET["resultCode"]) ? intval($_GET["resultCode"]) : -1;
$transId = isset($_GET["transId"]) ? htmlspecialchars($_GET["transId"]) : "";
$message = isset($_GET["message"]) ? htmlspecialchars($_GET["message"]) : "";

$paymentObj = new PaymentController();

if ($orderId) {
    if ($resultCode === 0) {
        // Thanh toán thành công -> lưu đơn hàng
        if (isset($_SESSION["cart"]) && !empty($_SESSION["cart"])) {
            $userInfo = [
                "id" => $_SESSION["id"],
                "fullname" => $_SESSION["fullname"],
                "email" => $_SESSION["useremail"],
                "phone_number" => $_SESSION["phone_number"] ?? '',
                "address" => $_SESSION["address"] ?? '',
                "note" => $_SESSION["note"] ?? ''
            ];

            $userProducts = $_SESSION["cart"];
            $paymentObj->placeOrder($userInfo, $userProducts, "momo", $transId);
        }

        // Cập nhật momo_payments
        $status = 'paid';
    } else {
        $status = 'failed';
    }

    $paymentObj->updateMomo($orderId, $status, $transId, $resultCode, $message);
}

// Xoá giỏ hàng nếu thanh toán thành công
if ($resultCode === 0) unset($_SESSION["cart"]);

if ($resultCode === 0) {
    echo "<h2 style='color: green; text-align:center;'>Thanh toán thành công!</h2>";
    echo "<h3 style='text-align:center;'>Mã giao dịch: $transId</h3>";
    echo "<p style='text-align:center;'>Đang chuyển hướng về trang chủ...</p>";
    echo "<script>setTimeout(function(){ window.location.href='../templates/trangchu.php?order=success'; }, 3000);</script>";
} else {
    echo "<h2 style='color:red;text-align:center;'>Thanh toán thất bại!</h2>";
    echo "<p style='text-align:center;'>Đang chuyển hướng về trang chủ...</p>";
    echo "<script>setTimeout(function(){ window.location.href='../templates/trangchu.php?order=failed'; }, 3000);</script>";
}
