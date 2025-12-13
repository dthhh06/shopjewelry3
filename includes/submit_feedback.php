<?php
require_once __DIR__ . "/../controllers/feedbackcontr.s.php";

// Chỉ xử lý khi form được submit
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['submit_feedback'])) {
    header("Location: ../templates/feedback.php");
    exit();
}

// Lấy & lọc dữ liệu
$name        = trim($_POST['name'] ?? '');
$email       = trim($_POST['email'] ?? '');
$phonenumber = trim($_POST['phonenumber'] ?? '');
$message     = trim($_POST['message'] ?? '');

// Kiểm tra dữ liệu bắt buộc
if ($name === '' || $email === '' || $phonenumber === '' || $message === '') {
    echo "<script>
        alert('Vui lòng điền đầy đủ thông tin');
        window.location.href = '../templates/feedback.php';
    </script>";
    exit();
}

// (Optional) Validate email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>
        alert('Email không hợp lệ');
        window.location.href = '../templates/feedback.php';
    </script>";
    exit();
}

// Gọi controller
$feedback = new Feedbackcontr();
$isAdded = $feedback->addFeedbackContr($name, $email, $message, $phonenumber);

if ($isAdded) {
    echo "<script>
        alert('Gửi feedback thành công');
        window.location.href = '../templates/feedback.php';
    </script>";
} else {
    echo "<script>
        alert('Gửi feedback thất bại, vui lòng thử lại');
        window.location.href = '../templates/feedback.php';
    </script>";
}
