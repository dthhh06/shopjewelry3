<?php
session_start();
header("Content-Type: application/json");

// Bắt buộc phải login theo loginmodel của bạn (bạn dùng $_SESSION['id'])
if (!isset($_SESSION['id']) || empty($_SESSION['id'])) {
    echo json_encode(["status" => "not_logged_in"]);
    exit;
}

if (!isset($_POST['product_id']) || !isset($_POST['rating']) || !isset($_POST['comment'])) {
    echo json_encode(["status" => "error", "message" => "Missing data"]);
    exit;
}

$product_id = intval($_POST['product_id']);
$rating     = intval($_POST['rating']);
$comment    = trim($_POST['comment']);
$user_id    = intval($_SESSION['id']);
$fullname   = trim($_SESSION['fullname'] ?? "Người dùng");

// Nếu user_id không hợp lệ -> từ chối (tránh insert 0)
if ($user_id <= 0) {
    echo json_encode(["status" => "not_logged_in"]);
    exit;
}

// Giới hạn rating
if ($rating < 1 || $rating > 5) $rating = 5;

require_once($_SERVER['DOCUMENT_ROOT'] . "/shopjewelry3/database/connection.php");

try {
    $db = new Database();
    $conn = $db->connect();

    // 1) CHECK duplicate: nếu cùng user/product cùng nội dung trong vòng 5s thì block
    $sqlCheck = "SELECT id, created_at FROM comments
                 WHERE user_id = :user_id AND product_id = :product_id AND comment = :comment
                 ORDER BY created_at DESC LIMIT 1";
    $stmtc = $conn->prepare($sqlCheck);
    $stmtc->execute([
        ":user_id" => $user_id,
        ":product_id" => $product_id,
        ":comment" => $comment
    ]);
    $last = $stmtc->fetch(PDO::FETCH_ASSOC);
    if ($last) {
        $lastTime = strtotime($last['created_at']);
        if (time() - $lastTime <= 5) { // 5 seconds window
            echo json_encode(["status" => "duplicate", "message" => "Duplicate comment detected"]);
            exit;
        }
    }

    // 2) Insert
    $sql = "INSERT INTO comments (product_id, user_id, fullname, comment, rating, created_at)
            VALUES (:product_id, :user_id, :fullname, :comment, :rating, NOW())";
    $stmt = $conn->prepare($sql);
    $ok = $stmt->execute([
        ":product_id" => $product_id,
        ":user_id"    => $user_id,
        ":fullname"   => $fullname,
        ":comment"    => $comment,
        ":rating"     => $rating
    ]);

    if ($ok) {
        echo json_encode(["status" => "success"]);
    } else {
        echo json_encode(["status" => "error", "message" => "Insert failed"]);
    }

} catch (PDOException $e) {
    // Ghi log (tuỳ chọn) — không in lỗi chi tiết ra client
    error_log("add_comment error: " . $e->getMessage());
    echo json_encode(["status" => "error", "message" => "Server error"]);
}
