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

            $studentId = $_SESSION["student"]["uid"];
            $stuname = $_SESSION["student"]["username"];

            if (isset($_FILES["f"])) {
                  $pdf = $_FILES["f"];

                  if ($pdf["type"] != "application/pdf") {
                        echo "notPDF";
                  } else {

                        $ishave = DB::search("SELECT * FROM `student_assignment_awnser` WHERE `assignment_aid`='" . $aid . "' AND `user_uid`='" . $studentId . "'");
                        // create name for pdf 
                        $name = microtime(true) . ".pdf";
                        // create path 
                        $path = "../../doc/stu-answer/" . $name;
                        $exispdf;
                        // move file acroding to path 
                        move_uploaded_file($pdf["tmp_name"], $path);
                        // cheack is stdent already submited answers 
                        if ($ishave->num_rows == 1) {
                              // if already submited delete previous pdf and update student_assignment_awnser table  
                              $exispdf = $ishave->fetch_assoc();
                              $file_pointer = "../../doc/stu-answer/" . $exispdf["awnser_sheet_path"];
                              if (unlink($file_pointer)) {
                              }
                              DB::iud("UPDATE `student_assignment_awnser` SET `awnser_sheet_path`='" . $name . "',`submit_date`='" . $date . "' WHERE `assignment_aid`='" . $aid . "' AND `user_uid`='" . $studentId . "'");
                        } else {
                              DB::iud("INSERT INTO `student_assignment_awnser` (`assignment_aid`,`user_uid`,`awnser_sheet_path`,`status`,`submit_date`) VALUES ('" . $aid . "','" . $studentId . "','" . $name . "','3','" . $date . "')");
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