<?php

class PaymentModel extends Database
{
    // Lưu đơn hàng COD hoặc MoMo (nếu đã thanh toán thành công)
    protected function placeOrder($userInfo, $userProducts, $paymentMethod = 'cod', $transId = null)
    {
        try {
            $pdo = $this->connect();
            $pdo->beginTransaction();

            // Lưu thông tin đơn hàng
            $sqlOrder = "INSERT INTO `order` (`fullname`, `email`, `phone_number`, `address`, `note`, `user_id`, `payment_method`, `trans_id`) 
                         VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $statementOrder = $pdo->prepare($sqlOrder);
            $statementOrder->execute([
                $userInfo['fullname'],
                $userInfo['email'],
                $userInfo['phone_number'],
                $userInfo['address'],
                $userInfo['note'],
                $userInfo["id"],
                $paymentMethod,
                $transId
            ]);

            $orderId = $pdo->lastInsertId();

            // Lưu chi tiết từng sản phẩm kèm giá tại thời điểm mua
            foreach ($userProducts as $product) {
                $productId = $product["id"];
                $productQuantity = $product["customer_quantity"];
                $productPrice = $product["price"]; // giá lúc mua

                $sqlOrderDetails = "INSERT INTO `orderdetail` (`order_id`, `product_id`, `num`, `price`) 
                                    VALUES (?, ?, ?, ?)";
                $statementOrderDetails = $pdo->prepare($sqlOrderDetails);
                $statementOrderDetails->execute([
                    $orderId,
                    $productId,
                    $productQuantity,
                    $productPrice
                ]);
            }

            $pdo->commit();
            return true;

        } catch (Exception $e) {
            error_log($e->getMessage());
            $pdo->rollBack();
            return false;
        }
    }

    // Lưu thanh toán MoMo vào bảng momo_payments
    protected function createMomoPayment($orderId, $amount, $requestId, $orderInfo, $payUrl, $signature)
    {
        try {
            $pdo = $this->connect();
            $sql = "INSERT INTO momo_payments (order_id, amount, request_id, order_info, order_type, pay_url, signature, created_at)
                    VALUES (?, ?, ?, ?, 'atm', ?, ?, NOW())";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$orderId, $amount, $requestId, $orderInfo, $payUrl, $signature]);
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }

    // Cập nhật trạng thái thanh toán MoMo
    protected function updateMomoPayment($orderId, $status, $transId, $resultCode, $message)
    {
        try {
            $pdo = $this->connect();
            $sql = "UPDATE momo_payments SET order_type=?, trans_id=?, result_code=?, message=? WHERE order_id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$status, $transId, $resultCode, $message, $orderId]);
            return true;
        } catch (Exception $e) {
            error_log($e->getMessage());
            return false;
        }
    }
}
