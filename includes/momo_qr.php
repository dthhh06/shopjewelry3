<?php
session_start();

include_once("../database/connection.php");
include_once("../models/paymentmodel.s.php");
include_once("../controllers/paymentcontr.s.php");

/* 1. Tính tổng tiền giỏ hàng */
$cart = $_SESSION["cart"] ?? [];
if (empty($cart)) {
    die("Giỏ hàng trống!");
}

$total = 0;
foreach ($cart as $p) {
    $total += intval($p["customer_quantity"]) * intval($p["price"]);
}
$total += 40000; // phí ship
$total = strval($total);

/* 2. Tạo orderId và requestId unique */
$orderId   = time() . mt_rand(1000, 9999);
$requestId = $orderId;

/* 3. Cấu hình MoMo test */
$endpoint    = "https://test-payment.momo.vn/v2/gateway/api/create";
$partnerCode = "MOMO";
$accessKey   = "F8BBA842ECF85";
$secretKey   = "K951B6PE1waDMi640xX08PD3vg6EkVlz";

$redirectUrl = "http://localhost:8088/shopjewelry3/includes/momo_return.php";
$ipnUrl      = $redirectUrl;

$orderInfo   = "Thanh toán đơn hàng Arelia Jewelry";
$requestType = "captureWallet";  // Quan trọng: dùng ví + QR
$extraData   = "";

/* 4. Tạo chữ ký */
$rawHash = "accessKey=" . $accessKey .
    "&amount=" . $total .
    "&extraData=" . $extraData .
    "&ipnUrl=" . $ipnUrl .
    "&orderId=" . $orderId .
    "&orderInfo=" . $orderInfo .
    "&partnerCode=" . $partnerCode .
    "&redirectUrl=" . $redirectUrl .
    "&requestId=" . $requestId .
    "&requestType=" . $requestType;

$signature = hash_hmac("sha256", $rawHash, $secretKey);

/* 5. Gửi request đến MoMo */
$data = [
    "partnerCode" => $partnerCode,
    "partnerName" => "Arelia Jewelry",
    "storeId"     => "AreliaStore",
    "requestId"   => $requestId,
    "amount"      => $total,
    "orderId"     => $orderId,
    "orderInfo"   => $orderInfo,
    "redirectUrl" => $redirectUrl,
    "ipnUrl"      => $ipnUrl,
    "lang"        => "vi",
    "extraData"   => $extraData,
    "requestType" => $requestType,
    "signature"   => $signature
];

$payload = json_encode($data);

$ch = curl_init($endpoint);
curl_setopt_array($ch, [
    CURLOPT_POST           => true,
    CURLOPT_POSTFIELDS     => $payload,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_HTTPHEADER     => ["Content-Type: application/json"],
    CURLOPT_TIMEOUT        => 30,
    CURLOPT_SSL_VERIFYPEER => false,
    CURLOPT_SSL_VERIFYHOST => false
]);

$result = curl_exec($ch);
curl_close($ch);

$response = json_decode($result, true);

/* 6. Kiểm tra lỗi */
if (!is_array($response) || $response["resultCode"] != 0) {
    die("Lỗi MoMo: " . ($response["message"] ?? "Không rõ lỗi"));
}

/* 7. Lưu tạm vào DB */
$paymentObj = new PaymentController();
$paymentObj->createMomo(
    $orderId,
    $total,
    $requestId,
    $orderInfo,
    $response["payUrl"],  // lưu payUrl
    $signature
);

/* 8. Chuyển hướng sang trang MoMo chính thức → hiện giao diện đẹp như ảnh bạn gửi */
header("Location: " . $response["payUrl"]);
exit;