<?php
session_start();
require "../../connection/connection.php";
$day = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$day->setTimezone($tz);
$date = $day->format("Y-m-d");
if (isset($_POST["id"])) {
      if (!empty($_POST["id"])) {
            $aid = $_POST["id"];
            $marks = $_POST["m"];
            $teacherID = $_SESSION["teacher"]["uid"];

            if (isset($_FILES["f"])) {
                  $pdf = $_FILES["f"];

                  if ($pdf["type"] != "application/pdf") {
                        echo "notPDF";
                  } else if (empty($marks)) {
                        echo "emptyMarks";
                  } else {

                        $ishave = DB::search("SELECT * FROM `stu_assignment_awnser` WHERE `answr_id`='" . $aid . "' AND `teacher_tuid`='" . $teacherID . "'");


                        if ($ishave->num_rows == 1) {
                              $exis = $ishave->fetch_assoc();
                              $file_pointer = "../../doc/result-sheet/" . $exis["result_sheet_path"];
                              // delete old result sheet 
                              if (unlink($file_pointer)) {
                              }
                              $name = microtime(true) . ".pdf";
                              $path = "../../doc/result-sheet/" . $name;
                              // upload new result sheet 
                              move_uploaded_file($pdf["tmp_name"], $path);
                              // update file name an marks in student_assignment_awnser table 
                              DB::iud("UPDATE `student_assignment_awnser` SET `result_sheet_path`='" . $name . "',`marks`='" . $marks . "',`status`='1' WHERE `answr_id`='" . $aid . "'");
                        }
                        echo "success";
                  }
            } else {
                  echo "emptyFile";
            }
      } else {
            echo "somthingWrong";
      }
} else {
?>
      <script>
            window.location = "../../misc/pages-404.php";
      </script>
<?php
}


?>