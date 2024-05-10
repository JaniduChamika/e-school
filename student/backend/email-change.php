<?php
require "../../connection/connection.php";
session_start();

if (isset($_POST["e"])) {
      $uname = $_SESSION["student"]["username"];
      $email =  $_POST["e"];

      if (empty($email)) {
            echo "emtyemail";
      } else {
            // insert new email and and topic to notification table with admin type id 
            DB::iud("INSERT INTO `notification` (`topic`,`notify`,`user_type`) VALUES ('Email Changing','" . $uname . " requested to change email as " . $email . "','5')");
            echo "success";
      }
} else {
?>
      <script>
            window.location = "../../misc/pages-404.php";
      </script>
<?php
}


?>