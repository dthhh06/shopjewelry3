<?php
require_once __DIR__ . '/../database/connection.php';

class FeedbackModel extends Database
{
    // Thêm feedback vào bảng contact
    protected function addFeedback($name, $email, $message, $phonenumber)
    {
        try {
            $sql = "INSERT INTO contact (fullname, email, content, phone_number)
                    VALUES (?, ?, ?, ?)";
            $stmt = $this->connect()->prepare($sql);
            $stmt->execute([$name, $email, $message, $phonenumber]);
            return true;
        } catch (PDOException $e) {
            error_log("FeedbackModel addFeedback Error: " . $e->getMessage());
            return false;
        }
    }

    // Lấy 3 feedback mới nhất hiển thị trang chủ
    public function getFeedbackHome($limit = 3)
    {
        try {
            $limit = (int)$limit;

            $sql = "
                SELECT 
                    c.content,
                    COALESCE(u.fullname, c.fullname) AS fullname,
                    u.avatar
                FROM contact c
                LEFT JOIN `user` u ON c.email = u.email
                WHERE c.isDeleted = 0
                ORDER BY c.id DESC
                LIMIT $limit
            ";

            $stmt = $this->connect()->prepare($sql);
            $stmt->execute();

            return $stmt->fetchAll(PDO::FETCH_ASSOC);

        } catch (PDOException $e) {
            error_log('FeedbackModel ERROR: ' . $e->getMessage());
            return [];
        }
    }
}
