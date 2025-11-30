<?php

include_once("../database/connection.php");
include_once("../models/changepwd.s.php");
include_once("../controllers/chanepwdcontr.s.php");

if (isset($_POST["type"]) && $_POST["type"] === "changepwd") {
      session_start();

      $changePwdObj = new PwdChangingContr();

      $id = $_SESSION["id"];
      $oldPwd = $_POST["oldPwd"];
      $newPwd = $_POST["newPwd"];

      $isChanged = $changePwdObj->changePwd($oldPwd, $newPwd, $id);

      echo $isChanged;
}
