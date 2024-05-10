<?php
session_start();
require "../connection/connection.php";
if (isset($_POST["olP"])) {
      $type = $_POST["ty"];
      $uid;
      $oldpw = $_POST["olP"];
      $password = $_POST["newpws"];
      $cpw = $_POST["Cnewpws"];

      if ($type == "admin") {
            $uid = $_SESSION["admin"]["uid"];
      } else if ($type == "teacher") {
            $uid = $_SESSION["teacher"]["uid"];
      } else if ($type == "student") {
            $uid = $_SESSION["student"]["uid"];
      } else if ($type == "officer") {
            $uid = $_SESSION["officer"]["uid"];
      }
      if (empty($oldpw)) {
            echo "Please enter current password";
      } else if (empty($password)) {
            echo "Please enter new password";
      } else if (empty($cpw)) {
            echo "Please comfirm new password";
      } else if ($password != $cpw) {
            echo "Password not same";
      } else if (strlen($password) < 7 || strlen($password) > 20) {
            echo "Password length must between 8 to 20";
      } else if (!preg_match("#[0-9]#", $password)) {
            echo "Password must contains numbers";
      } else {
            $ishave = DB::search("SELECT * FROM `user` WHERE `uid`='" . $uid . "' AND `password` ='" . $oldpw . "'");
            if ($ishave->num_rows == 1) {
                  // update password with new password 
                  DB::iud("UPDATE `user` SET `password`='" . $password . "' WHERE `uid`='" . $uid . "'");
                  echo "success";
            } else {
                  echo "Current password is wrong";
            }
      }
}
