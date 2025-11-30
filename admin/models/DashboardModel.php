<?php
class DashboardModel
{
    private $conn;

    function __construct($db)
    {
        $this->conn = $db;
    }

    // Doanh thu hôm nay
    function getTodayRevenue()
    {
        $sql = "SELECT SUM(od.total_money) AS revenue
                FROM orderdetail od
                JOIN `order` o ON od.order_id = o.id
                WHERE DATE(o.order_date) = CURDATE() AND o.isDeleted = 0";
        return $this->conn->query($sql)->fetch_assoc()['revenue'] ?? 0;
    }

    // Doanh thu tuần
    function getWeekRevenue()
    {
        $sql = "SELECT SUM(od.total_money) AS revenue
                FROM orderdetail od
                JOIN `order` o ON od.order_id = o.id
                WHERE YEARWEEK(o.order_date, 1) = YEARWEEK(CURDATE(), 1) AND o.isDeleted = 0";
        return $this->conn->query($sql)->fetch_assoc()['revenue'] ?? 0;
    }

    // Doanh thu tháng
    function getMonthRevenue()
    {
        $sql = "SELECT SUM(od.total_money) AS revenue
                FROM orderdetail od
                JOIN `order` o ON od.order_id = o.id
                WHERE MONTH(o.order_date) = MONTH(CURDATE())
                  AND YEAR(o.order_date) = YEAR(CURDATE())
                  AND o.isDeleted = 0";
        return $this->conn->query($sql)->fetch_assoc()['revenue'] ?? 0;
    }

    // Tổng đơn hàng
    function getTotalOrders()
    {
        $sql = "SELECT COUNT(*) AS total
                FROM `order`
                WHERE isDeleted = 0";
        return $this->conn->query($sql)->fetch_assoc()['total'] ?? 0;
    }

    // Tổng danh mục
    function getTotalCategories()
    {
        $sql = "SELECT COUNT(*) AS total 
                FROM category 
                WHERE isDeleted = 0";
        return $this->conn->query($sql)->fetch_assoc()['total'] ?? 0;
    }

    // Tổng số lượng bán theo danh mục
    function getTotalSoldByCategory()
    {
        $sql = "SELECT c.name AS category_name, SUM(od.num) AS total_sold
                FROM category c
                JOIN product p ON p.category_id = c.id
                JOIN orderdetail od ON od.product_id = p.id
                JOIN `order` o ON od.order_id = o.id
                WHERE c.isDeleted = 0 AND o.isDeleted = 0
                GROUP BY c.id
                ORDER BY total_sold DESC";
        return $this->conn->query($sql);
    }

    // Biểu đồ doanh thu theo tháng
    function getRevenueChart()
    {
        $sql = "SELECT DATE_FORMAT(o.order_date, '%Y-%m') AS month,
                       SUM(od.total_money) AS revenue
                FROM orderdetail od
                JOIN `order` o ON o.id = od.order_id
                WHERE o.isDeleted = 0
                GROUP BY month
                ORDER BY month ASC";
        return $this->conn->query($sql);
    }

    // Biểu đồ số lượng bán theo danh mục
    function getCategorySales()
    {
        $sql = "SELECT c.name AS category_name, SUM(od.num) AS total_sold
                FROM category c
                JOIN product p ON p.category_id = c.id
                JOIN orderdetail od ON od.product_id = p.id
                JOIN `order` o ON od.order_id = o.id
                WHERE c.isDeleted = 0 AND o.isDeleted = 0
                GROUP BY c.id
                ORDER BY total_sold DESC";
        return $this->conn->query($sql);
    }

    // Lấy danh sách đơn hàng (dùng cho View Details)
    function getOrders($limit = 50)
    {
        $sql = "SELECT o.id, o.customer_id, u.name AS customer_name, o.order_date, o.total_money, o.status
                FROM `order` o
                JOIN user u ON o.customer_id = u.id
                WHERE o.isDeleted = 0
                ORDER BY o.order_date DESC
                LIMIT $limit";
        return $this->conn->query($sql);
    }

    // Lấy chi tiết sản phẩm trong đơn hàng
    function getOrderDetails($orderId)
    {
        $sql = "SELECT od.id, p.name AS product_name, od.num, od.total_money
                FROM orderdetail od
                JOIN product p ON od.product_id = p.id
                WHERE od.order_id = $orderId";
        return $this->conn->query($sql);
    }
}
