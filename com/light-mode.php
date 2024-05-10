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
      // turn off dark mood 
      DB::iud("DELETE FROM `dark_theam` WHERE `user_uid`='" . $uid . "'");
      echo "success";
}
