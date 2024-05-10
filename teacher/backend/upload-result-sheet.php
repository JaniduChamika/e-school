<?php
session_start();
require "../../connection/connection.php";

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
                              // create file name 
                              $name = microtime(true) . ".pdf";
                              // create path 
                              $path = "../../doc/result-sheet/" . $name;
                              // upload file 
                              move_uploaded_file($pdf["tmp_name"], $path);
                              // add marks and resultsheet name 
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