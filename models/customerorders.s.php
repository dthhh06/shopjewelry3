<?php
class CustomerOrdersModel extends Database
{

    // Lấy danh sách đơn hàng theo userid
    protected function getOrdersById($userid)
    {
        try {
            $sql = "SELECT 
                        id,
                        order_date,
                        address,
                        total_money,
                        status,
                        payment_method
                    FROM `order`
                    WHERE user_id = ?
                    ORDER BY id DESC";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$userid]);

            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }
    }

    // LẤY CHI TIẾT ĐƠN HÀNG (JOIN ORDERDETAIL + PRODUCT)
    protected function getOrderDetailsById($orderid, $userid)
    {
        try {
            $sql = "SELECT 
                        orderdetail.price AS orderdetail_price,
                        orderdetail.num,
                        orderdetail.total_money,
                        product.title,
                        product.thumbnail,
                        o.payment_method,
                        o.order_date,
                        o.address,
                        o.fullname,
                        o.phone_number,
                        o.note
                    FROM `order` AS o
                    JOIN orderdetail ON o.id = orderdetail.order_id
                    JOIN product ON orderdetail.product_id = product.id
                    WHERE o.id = ? AND o.user_id = ?";

            $statement = $this->connect()->prepare($sql);
            $statement->execute([$orderid, $userid]);

            return $statement->fetchAll(PDO::FETCH_ASSOC) ?? [];
        } catch (Exception $e) {
            echo $e->getMessage();
            exit();
        }
    }
}
