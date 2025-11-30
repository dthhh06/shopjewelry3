<?php

class PaymentModel extends Database
{
    protected function placeOrder($userInfo, $userProducts)
    {
        try {
            $pdo = $this->connect();
            $pdo->beginTransaction();

            // Lưu thông tin đơn hàng
            $sqlOrder = "INSERT INTO `order` (`fullname`, `email`, `phone_number`, `address`, `note`, `user_id`) 
                         VALUES (?, ?, ?, ?, ?, ?)";
            $statementOrder = $pdo->prepare($sqlOrder);
            $statementOrder->execute([
                $userInfo['fullname'],
                $userInfo['email'],
                $userInfo['phone_number'],
                $userInfo['address'],
                $userInfo['note'],
                $userInfo["id"]
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
            // Log lỗi để debug
            error_log($e->getMessage());
            $pdo->rollBack();
            return false;
        }
    }
}
