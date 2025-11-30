<?php

include_once("../database/connection.php");
include_once("../models/customerorders.s.php");
include_once("../controllers/customerorderscontr.s.php");
session_start();

$userid = $_SESSION["id"];
$customerOrdersObj = new CustomerOrdersContr();
echo json_encode($customerOrdersObj->getOrdersById($userid));
