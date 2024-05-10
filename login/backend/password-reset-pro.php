<?php
require "../../connection/connection.php";
if (isset($_POST["e"])) {

      $email = $_POST["e"];
      $codeen = $_POST["c"];
      $password = $_POST["p"];
      $cpw = $_POST["cp"];
      if (empty($password)) {
            echo "Please enter a password";
      } else if (empty($codeen)) {
            echo "Please enter verification code";
      } else if ($password != $cpw) {
            echo "Password not same";
      } else if (strlen($password) < 7 || strlen($password) > 20) {
            echo "Password length must between 8 to 20";
      } else if (!preg_match("#[0-9]#", $password)) {
            echo "Password must contains numbers";
      } else {
         
            $ishave = DB::search("SELECT * FROM `user` WHERE `email`='" . $email . "' AND `v_code` ='" . $codeen . "'");
            if ($ishave->num_rows == 1) {

                  DB::iud("UPDATE `user` SET `password`='" . $password . "' WHERE `email`='" . $email . "' AND `v_code` ='" . $codeen . "'");
                  DB::iud("UPDATE `user` SET `v_code`='' WHERE `email`='" . $email . "' AND `v_code` ='" . $codeen . "'");
                  echo "success";
            } else {
                  echo "Somthing Wrong! try again later";
            }
      }
}
