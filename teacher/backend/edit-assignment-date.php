<?php
session_start();
require "../../connection/connection.php";

if (isset($_POST["id"])) {
      $teacherID = $_SESSION["teacher"]["uid"];

      $id = $_POST["id"];
      $start = $_POST["s"];
      $end = $_POST["e"];
      // validate detials 
      if (empty($start)) {
            echo "emptyStartDate";
      } else if (empty($end)) {
            echo "emptyEndDate";
      } else if ($end < $start) {
            echo "invalidEndDate";
      } else {
            $ishave = DB::search("SELECT * FROM `assignment` WHERE `aid`='" . $id . "' AND `teacher_tuid`='" . $teacherID . "'");
            if ($ishave->num_rows == 1) {
                  // update assignment start and end date 
                  DB::iud("UPDATE `assignment` SET `start_date`='" . $start . "',`end_date`='" . $end . "' WHERE `aid`='" . $id . "'");
                  echo "success";
            } else {
                  echo "wrong";
            }
      }
} else {
?>
      <script>
            window.location = "../../misc/pages-404.php";
      </script>
<?php
}


?>