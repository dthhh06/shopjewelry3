<?php

session_start();

if (!isset($_SESSION["id"]) || !isset($_SESSION["role_id"])) {
    header("Location: ../views/login.php");
    exit();
}

$role = $_SESSION["role_id"];

$allowed_roles = [1, 2, 4];

if (!in_array($role, $allowed_roles)) {
    header("Location: ../index/index.php?error=no_permission");
    exit();
}
?>
