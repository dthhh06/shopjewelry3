<?php
session_start();
require_once "../database/connection.php";

if (!isset($_SESSION["id"])) {
    die("Bạn chưa đăng nhập!");
}

if (!isset($_FILES["avatar"])) {
    die("Không tìm thấy file upload");
}

$uploadDir = "../assets/imgs/avatars/";
if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$filename = time() . "_" . basename($_FILES["avatar"]["name"]);
$targetFile = $uploadDir . $filename;

if (move_uploaded_file($_FILES["avatar"]["tmp_name"], $targetFile)) {
    
    // Lưu vào database
    $db = new Database();
    $conn = $db->connect();

    $avatarDBPath = "../assets/imgs/avatars/" . $filename;

    $stmt = $conn->prepare("UPDATE user SET avatar = ? WHERE id = ?");
    $stmt->execute([$avatarDBPath, $_SESSION["id"]]);

    // Cập nhật session
    $_SESSION["avatar"] = $avatarDBPath;

    header("Location: ../templates/customerinfo.php?updated_avatar=1");
    exit;
} else {
    die("Upload ảnh thất bại!");
}
