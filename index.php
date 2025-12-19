<?php
session_start();

/* Nếu CHƯA đăng nhập → chuyển sang login */
if (!isset($_SESSION["id"]) || !isset($_SESSION["useremail"])) {
    header("Location: ./templates/login.php");
    exit();
}

/* Nếu ĐÃ đăng nhập → cho vào trang chủ */
header("Location: ./templates/trangchu.php");
exit();
