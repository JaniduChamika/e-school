<?php
session_start();
require "../../connection/connection.php";

if (isset($_POST["id"])) {
      if (isset($_SESSION["officer"])) {

            $anserid = $_POST["id"];
            // update status as a released marks 
            DB::iud("UPDATE `student_assignment_awnser` SET `status`='2' WHERE `answr_id`='" . $anserid . "'");
            echo "success";
      }
} else {
?>
      <script>
            window.location = "../../misc/pages-404.php";
      </script>
<?php
}
