<?php
session_start();

$_SESSION["fullname"] = $_POST["fullname"];
$_SESSION["useremail"] = $_POST["email"];
$_SESSION["phone_number"] = $_POST["phonenumber"];

$_SESSION["address"] = $_POST["address"] . ", " . $_POST["district"] . ", " . $_POST["province"];
$_SESSION["note"] = $_POST["note"];

echo "OK";
