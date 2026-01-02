<?php
include_once("../database/connection.php");
include_once("../models/paymentmodel.s.php");
include_once("../controllers/paymentcontr.s.php");

if (session_status() == PHP_SESSION_NONE) session_start();

// LẤY PHƯƠNG THỨC THANH TOÁN USER ĐÃ CHỌN
$method = $_POST["selected_payment"] ?? "";

// Nếu chưa chọn → báo lỗi
if ($method === "") {
    header("Location: ../templates/payment.php?err=nomethod");
    exit();
}

// ==== NẾU LÀ MOMO → lưu tạm thông tin giao hàng rồi chuyển sang momo_qr.php ====
if ($method === "momo") {
    // Kiểm tra dữ liệu cần thiết giống như COD
    if (!isset(
        $_SESSION["id"],
        $_SESSION["useremail"],
        $_SESSION["fullname"],
        $_SESSION["phone_number"],
        $_POST["address"],
        $_POST["district"],
        $_POST["province"]
    )) {
        header("Location: ../templates/payment.php?err=missingdata");
        exit();
    }

    // Lưu tạm địa chỉ và note vào session để dùng sau khi MoMo callback
    $_SESSION['momo_temp_address'] = $_POST["address"] . ", " . $_POST["district"] . ", " . $_POST["province"];
    $_SESSION['momo_temp_note']    = $_POST["note"] ?? "";

    // Chuyển hướng sang tạo QR MoMo
    header("Location: momo_qr.php");
    exit();
}

// ==== COD → xử lý bình thường ====
if (!isset(
    $_SESSION["id"],
    $_SESSION["useremail"],
    $_SESSION["fullname"],
    $_SESSION["phone_number"],
    $_POST["address"],
    $_POST["district"],
    $_POST["province"]
)) {
    header("Location: ../templates/trangchu.php?missingdata");
    exit();
}

$userInfo = [
    "id" => $_SESSION["id"],
    "email" => $_SESSION["useremail"],
    "fullname" => $_SESSION["fullname"],
    "phone_number" => $_SESSION["phone_number"],
    "address" => $_POST["address"] . ", " . $_POST["district"] . ", " . $_POST["province"],
    "note" => $_POST["note"] ?? ""
];

$userProducts = $_SESSION["cart"] ?? [];
if (empty($userProducts)) {
    header("Location: ../templates/trangchu.php?emptycart");
    exit();
}

$paymentObj = new PaymentController();
$isPlaced = $paymentObj->placeOrder($userInfo, $userProducts);

if ($isPlaced) {
    unset($_SESSION["cart"]);
    $_SESSION["order_placed"] = true;
    header("Location: ../templates/trangchu.php?order=success");
    exit();
} else {
    header("Location: ../templates/trangchu.php?order=failed");
    exit();
}
