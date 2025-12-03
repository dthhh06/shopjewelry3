<?php

class PaymentController extends PaymentModel
{
    // Đặt đơn hàng (COD hoặc MoMo)
    public function placeOrder($userInfo, $userProducts, $paymentMethod = 'cod', $transId = null)
    {
        return parent::placeOrder($userInfo, $userProducts, $paymentMethod, $transId);
    }

    // Tạo thanh toán MoMo
    public function createMomo($orderId, $amount, $requestId, $orderInfo, $payUrl, $signature)
    {
        return parent::createMomoPayment($orderId, $amount, $requestId, $orderInfo, $payUrl, $signature);
    }

    // Cập nhật thanh toán MoMo
    public function updateMomo($orderId, $status, $transId, $resultCode, $message)
    {
        return parent::updateMomoPayment($orderId, $status, $transId, $resultCode, $message);
    }
}
