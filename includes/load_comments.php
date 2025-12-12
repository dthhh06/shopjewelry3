<?php
header("Content-Type: application/json");

if (!isset($_GET['product_id'])) {
    echo json_encode([]);
    exit;
}
$product_id = intval($_GET['product_id']);

require_once($_SERVER['DOCUMENT_ROOT'] . "/shopjewelry3/database/connection.php");

try {
    $db = new Database();
    $conn = $db->connect();

    $sql = "SELECT 
                c.fullname,
                c.comment,
                c.rating,
                c.created_at,
                u.avatar
            FROM comments c
            LEFT JOIN user u ON u.id = c.user_id
            WHERE c.product_id = :product_id
            ORDER BY c.id DESC";

    $stmt = $conn->prepare($sql);
    $stmt->execute([":product_id" => $product_id]);
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

    foreach ($rows as &$c) {
        if (!empty($c['avatar'])) {
            $clean = ltrim(str_replace("../", "", $c['avatar']), "/");
            $c['avatar'] = "/shopjewelry3/" . $clean;
        } else {
            $c['avatar'] = "/shopjewelry3/assets/imgs/avatars/user.jpg";
        }
        if (!empty($c['created_at'])) {
            $c['created_at'] = date("d/m/Y H:i", strtotime($c['created_at']));
        }
    }
    echo json_encode($rows);
} catch (PDOException $e) {
    error_log("load_comments error: " . $e->getMessage());
    echo json_encode([]);
}
