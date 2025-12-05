<?php
include_once("../database/connection.php");
include_once("../models/paymentmodel.s.php");
include_once("../controllers/paymentcontr.s.php");

if (session_status() == PHP_SESSION_NONE) session_start();

// PHẢI bấm nút PLACE ORDER
// if (!isset($_POST["place-order"])) {
//     header("Location: ../templates/trangchu.php?notsubmitted");
//     exit();
// }

// LẤY PHƯƠNG THỨC THANH TOÁN USER ĐÃ CHỌN
$method = $_POST["selected_payment"] ?? "";

// Nếu chưa chọn → báo lỗi
if ($method === "") {
    header("Location: ../templates/payment.php?err=nomethod");
    exit();
}

// ==== NẾU LÀ MOMO → chuyển sang momo_atm.php ====
if ($method === "momo") {
    header("Location: momo_atm.php");
    exit();
}

// ==== NẾU LÀ VNPAY → chuyển sang vnpay.php ====
if ($method === "vnpay") {
    header("Location: vnpay.php");
    exit();
}

// ==== COD → xử lý bình thường ====
if (!isset($_SESSION["id"], $_SESSION["useremail"], $_SESSION["fullname"],
          $_SESSION["phone_number"], $_POST["address"], $_POST["district"], $_POST["province"])) {
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
