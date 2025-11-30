<?php
class OrderModel {
    private $conn;

    function __construct($db) {
        $this->conn = $db;
    }

    // Lấy tất cả đơn (không xóa) kèm tên user nếu có
    function getAll() {
        $sql = "SELECT o.*, u.fullname as user_name
                FROM `order` o
                LEFT JOIN `user` u ON o.user_id = u.id
                WHERE o.isDeleted = 0
                ORDER BY o.id DESC";
        return $this->conn->query($sql);
    }

    // Lấy 1 đơn theo id
    function getById($id) {
        $id = (int)$id;
        $sql = "SELECT * FROM `order` WHERE id = $id LIMIT 1";
        return $this->conn->query($sql)->fetch_assoc();
    }

    // Lấy chi tiết các sản phẩm trong đơn
    function getDetails($order_id) {
        $order_id = (int)$order_id;
        $sql = "SELECT od.*, p.title, p.thumbnail
                FROM `orderdetail` od
                JOIN `product` p ON od.product_id = p.id
                WHERE od.order_id = $order_id";
        return $this->conn->query($sql);
    }

    // Cập nhật trạng thái đơn (0 hoặc 1)
    function updateStatus($id, $status) {
        $id = (int)$id;
        $status = (int)$status;
        $sql = "UPDATE `order` SET status = $status WHERE id = $id";
        return $this->conn->query($sql);
    }

    // Xoá mềm đơn
    function delete($id) {
        $id = (int)$id;
        $sql = "UPDATE `order` SET isDeleted = 1 WHERE id = $id";
        return $this->conn->query($sql);
    }
}
