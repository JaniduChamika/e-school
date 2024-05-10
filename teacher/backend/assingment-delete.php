<?php
session_start();
require "../../connection/connection.php";

if (isset($_POST["id"])) {
      $id = $_POST["id"];

      $have = DB::search("SELECT * FROM `assingment_view` WHERE `aid` ='" . $id . "' AND `uid`='" . $_SESSION["teacher"]["uid"] . "'");
      if ($have->num_rows == 1) {
            // check is assignmet have answers 
            $haveAnswe = DB::search("SELECT * FROM `student_assignment_awnser` WHERE `assignment_aid`='" . $d['aid'] . "'");
            if ($haveAnswe->num_rows == 0) {
                  $d = $have->fetch_assoc();
                  $file_pointer = "../../doc/assignment/" . $d["file_path"];
                  // delete pdf file 
                  unlink($file_pointer);
                  // delete record from assignment tabel 
                  DB::iud("DELETE FROM `assignment` WHERE `aid`='" . $id . "' AND `teacher_tuid`='" . $_SESSION["teacher"]["uid"] . "'");
                  echo "success";
            } else {
                  echo "can't";
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