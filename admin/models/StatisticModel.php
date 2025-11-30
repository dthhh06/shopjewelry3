<?php
class StatisticModel {
    private $conn;

    function __construct($db) {
        $this->conn = $db;
    }

    // Doanh thu trong tháng
    function getRevenueMonth() {
        $sql = "SELECT SUM(total_money) AS revenue
                FROM `order`
                WHERE MONTH(order_date) = MONTH(NOW())
                AND YEAR(order_date) = YEAR(NOW())
                AND status = 1 AND isDeleted = 0";
        return $this->conn->query($sql)->fetch_assoc()['revenue'] ?? 0;
    }

    // Doanh thu trong tuần
    function getRevenueWeek() {
        $sql = "SELECT SUM(total_money) AS revenue
                FROM `order`
                WHERE YEARWEEK(order_date, 1) = YEARWEEK(NOW(), 1)
                AND status = 1 AND isDeleted = 0";
        return $this->conn->query($sql)->fetch_assoc()['revenue'] ?? 0;
    }

    // Số sản phẩm bán theo danh mục
    function getSoldByCategory() {
        $sql = "SELECT c.name AS category, SUM(od.num) AS total_sold
                FROM orderdetail od
                JOIN product p ON od.product_id = p.id
                JOIN category c ON p.category_id = c.id
                GROUP BY c.id
                ORDER BY total_sold DESC";
        return $this->conn->query($sql);
    }

    // Doanh thu theo tháng trong năm
    function getRevenueChart() {
        $sql = "SELECT MONTH(order_date) AS month, SUM(total_money) AS revenue
                FROM `order`
                WHERE YEAR(order_date) = YEAR(NOW())
                AND status = 1
                GROUP BY MONTH(order_date)
                ORDER BY month ASC";
        return $this->conn->query($sql);
    }
}
