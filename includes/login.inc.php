<?php
session_start();

if (isset($_POST["login"])) {

    include_once("../database/connection.php");
    include_once("../models/loginmodel.s.php");
    include_once("../controllers/logincontr.s.php");

    $useremail = $_POST["useremail"];
    $password = $_POST["password"];

    $login = new LoginController($useremail, $password);
    $login->loginUser();

    // ROLE_ID: 1 = admin, 3 = user (theo database của bạn)
    if ($_SESSION["role_id"] == 3) {
        echo "2";  // Cho login.js
    } else {
        echo "1";  // Admin
    }
    exit();
}

echo "invalid";
exit();
