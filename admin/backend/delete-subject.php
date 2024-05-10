<?php

require "../../connection/connection.php";

if (isset($_POST["id"])) {
      $sid = $_POST["id"];

      $isHave = DB::search("SELECT * FROM `subject` WHERE `sub_id`='" . $sid . "'");
      if ($isHave->num_rows == 1) {
            // check is have any assignment, note for this subject or is assigned subject to teachers 
            $subUsed = DB::search(" SELECT assignment.sub_id FROM assignment WHERE `sub_id`=" . $sid . " UNION SELECT note.sub_id  FROM  note WHERE `sub_id`=" . $sid . " UNION SELECT teacher_has_subject.subject_id FROM teacher_has_subject  WHERE `subject_id`=" . $sid . "");
            if ($subUsed->num_rows == 0) {
                  $isHaveGrade = DB::search("SELECT * FROM `subject_has_grade_type` WHERE `subject_sub_id`='" . $sid . "'");
                  if ($isHaveGrade->num_rows >= 1) {
                        // delete records from subject_has_grade_type table which are conect with this subject 
                        DB::iud("DELETE FROM `subject_has_grade_type`  WHERE `subject_sub_id`='" . $sid . "'");
                  }
                  $isHaveStream = DB::search("SELECT * FROM `al_stream_has_subject` WHERE `subject_sid`='" . $sid . "'");
                  if ($isHaveStream->num_rows >= 1) {
                        // delete records from al_stream_has_subject table which are connect with this subject 
                        DB::iud("DELETE FROM `al_stream_has_subject`  WHERE `subject_sid`='" . $sid . "'");
                        // delete subject 
                        DB::iud("DELETE FROM `subject`  WHERE `sub_id`='" . $sid . "'");
                        echo "successal";
                  } else {
                        // delete subject 
                        DB::iud("DELETE FROM `subject`  WHERE `sub_id`='" . $sid . "'");
                        echo "success";
                  }
            } else {
                  echo "wrong";
            }
      } else {
            echo "wrong";
      }
} else {
?>
      <script>
            window.location = "../../misc/pages-404.php";
      </script>
<?php
}


?>