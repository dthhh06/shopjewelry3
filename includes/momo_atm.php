<?php
session_start();
include_once("../database/connection.php");
include_once("../models/paymentmodel.s.php");
include_once("../controllers/paymentcontr.s.php");

// Tính tổng tiền
$cart = $_SESSION["cart"] ?? [];
if (empty($cart)) die("Cart empty");

$total = 0;
foreach ($cart as $p) {
    $total += intval($p["customer_quantity"]) * intval($p["price"]);
}
$total += 40000;

// Tạo orderId
$orderId = time();

// Cấu hình MoMo
$endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";
$partnerCode = "MOMO";
$accessKey = "F8BBA842ECF85";
$secretKey = "K951B6PE1waDMi640xX08PD3vg6EkVlz";

$redirectUrl = "http://localhost:8088/shopjewelry3/includes/momo_return.php";
$ipnUrl = $redirectUrl;

$requestId = time() . "";
$orderInfo = "Thanh toán MoMo ATM";
$requestType = "payWithATM";
$extraData = "";

// Tạo chữ ký
$rawHash = "accessKey=$accessKey&amount=$total&extraData=$extraData&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=$requestType";
$signature = hash_hmac("sha256", $rawHash, $secretKey);

// Gửi yêu cầu MoMo
$data = [
    "partnerCode" => $partnerCode,
    "partnerName" => "Test",
    "storeId" => "MoMoTestStore",
    "requestId" => $requestId,
    "amount" => $total,
    "orderId" => $orderId,
    "orderInfo" => $orderInfo,
    "redirectUrl" => $redirectUrl,
    "ipnUrl" => $ipnUrl,
    "lang" => "vi",
    "signature" => $signature,
    "extraData" => $extraData,
    "requestType" => $requestType
];

$payload = json_encode($data);

$ch = curl_init($endpoint);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);

$result = curl_exec($ch);
curl_close($ch);

$response = json_decode($result, true);

// Lưu vào DB momo_payments
$paymentObj = new PaymentController();
$paymentObj->createMomo($orderId, $total, $requestId, $orderInfo, $response['payUrl'], $signature);

// Redirect sang MoMo
if (isset($response["payUrl"])) {
    header("Location: " . $response["payUrl"]);
    exit;
} else {
    die("Không thể tạo liên kết thanh toán MoMo. Vui lòng thử lại.");
}
