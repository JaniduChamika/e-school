<?php
require "../connection/connection.php";
session_start();

if (isset($_POST["ty"])) {
      $type = $_POST["ty"];
      $uid;
      $state =  $_POST["s"];

      if ($type == "admin") {
            $uid = $_SESSION["admin"]["uid"];
      } else if ($type == "teacher") {
            $uid = $_SESSION["teacher"]["uid"];
      } else if ($type == "student") {
            $uid = $_SESSION["student"]["uid"];
      } else if ($type == "officer") {
            $uid = $_SESSION["officer"]["uid"];
      }

      if ($state == "true") {
            // enable two step verification 
            DB::iud("UPDATE `user` SET `tsv_status`='1' WHERE `uid`='" . $uid . "' ");
      } else {
            // disable two step verification 

            DB::iud("UPDATE `user` SET `tsv_status`='2' WHERE `uid`='" . $uid . "' ");
      }


      echo "success";
} else {
?>
      <script>
            window.location = "../../misc/pages-404.php";
      </script>
<?php
}


?>