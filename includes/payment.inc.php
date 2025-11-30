<?php

include_once("../database/connection.php");
include_once("../models/paymentmodel.s.php");
include_once("../controllers/paymentcontr.s.php");

if (session_status() == PHP_SESSION_NONE)
    session_start();

// Kiểm tra nút PLACE ORDER
if (!isset($_POST["place-order"])) {
    header("Location: ../templates/trangchu.php?notsubmitted");
    exit();
}

// Kiểm tra dữ liệu bắt buộc
if (!isset($_SESSION["id"], $_SESSION["useremail"], $_SESSION["fullname"], $_SESSION["phone_number"], $_POST["address"], $_POST["district"], $_POST["province"])) {
    header("Location: ../templates/trangchu.php?missingdata");
    exit();
}

// Lấy dữ liệu người dùng
$userId = $_SESSION["id"];
$userEmail = $_SESSION["useremail"];
$userFullName = $_SESSION["fullname"];
$userPhoneNumber = $_SESSION["phone_number"];
$userAddress = $_POST["address"] . ", " . $_POST["district"] . ", " . $_POST["province"];
$userNote = $_POST["note"] ?? ""; // Fix: note có thể để trống

$userInfo = [
    "id" => $userId,
    "email" => $userEmail,
    "fullname" => $userFullName,
    "phone_number" => $userPhoneNumber,
    "address" => $userAddress,
    "note" => $userNote
];

// Lấy danh sách sản phẩm từ giỏ hàng
$userProducts = $_SESSION["cart"] ?? [];

// Kiểm tra giỏ hàng không rỗng
if (empty($userProducts)) {
    header("Location: ../templates/trangchu.php?emptycart");
    exit();
}

// Tạo đối tượng PaymentController và lưu đơn hàng
$paymentObj = new PaymentController();
$isPlaced = $paymentObj->placeOrder($userInfo, $userProducts);

// Xử lý kết quả
if ($isPlaced) {
    unset($_SESSION['cart']); // xóa giỏ hàng sau khi đặt
    $_SESSION['order_placed'] = true;
    header("Location: ../templates/trangchu.php?order=success");
    exit();
} else {
    $_SESSION['order_placed'] = false;
    header("Location: ../templates/trangchu.php?order=failed");
    exit();
}
