<?php

require "../../connection/connection.php";

if (isset($_POST["clz"])) {
      $clzId = $_POST["clz"];
      $teacher = $_POST["t"];
      if (empty($teacher)) {
            echo "emptyTeacher";
      } else {
            $isHave = DB::search("SELECT * FROM `class` WHERE `clz_id`='" . $clzId . "'");
            if ($isHave->num_rows == 1) {
                  // assign N/A  to old class 
                  DB::iud("UPDATE `class` SET `teacher_tuid`='0' WHERE `teacher_tuid`='" . $teacher . "'");
                  // assign teacher for class 
                  DB::iud("UPDATE `class` SET `teacher_tuid`='" . $teacher . "' WHERE `clz_id`='" . $clzId . "'");
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