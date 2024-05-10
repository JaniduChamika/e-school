<?php
session_start();
require "../connection/connection.php";




if (isset($_GET["ty"])) {
      $ty = $_GET["ty"];
      $uid;
      if ($ty == "admin") {
            $uid = $_SESSION["admin"]["uid"];
      } else if ($ty == "student") {
            $uid = $_SESSION["student"]["uid"];
      } else if ($ty == "teacher") {
            $uid = $_SESSION["teacher"]["uid"];
      } else if ($ty == "officer") {
            $uid = $_SESSION["officer"]["uid"];
      }
      DB::iud("INSERT INTO `dark_theam` (`user_uid`) VALUES ('" . $uid . "')");
      echo "success";
}
