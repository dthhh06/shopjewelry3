<?php

if ($_GET["type"] && $_GET["type"] === "getCustomerOrderDetails") {
include_once("../database/connection.php");
      include_once("../models/customerorders.s.php");
      include_once("../controllers/customerorderscontr.s.php");
      session_start();

      $orderid = $_GET["orderid"];
      $userid = $_SESSION["id"];

      $customerOrdersObj = new CustomerOrdersContr();

      echo json_encode($customerOrdersObj->getOrderDetailsById($orderid, $userid));
}
