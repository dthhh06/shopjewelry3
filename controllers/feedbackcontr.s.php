<?php
require_once __DIR__ . '/../models/feedbackmodel.s.php';

class Feedbackcontr extends FeedbackModel
{
    // Thêm feedback (gọi từ form submit)
    public function addFeedbackContr($name, $email, $message, $phonenumber)
    {
        return $this->addFeedback($name, $email, $message, $phonenumber);
    }

    // Lấy 3 feedback mới nhất hiển thị trang chủ
    public function getFeedbackHomeContr()
    {
        return $this->getFeedbackHome();
    }
}
