<?php

require "../../connection/connection.php";

if (isset($_POST["id"])) {
      $clzId = (int)$_POST["id"];


      $isHave = DB::search("SELECT * FROM `class` WHERE `clz_id`=" . $clzId . "");
      if ($isHave->num_rows == 1) {
            // check class have studnets
            $isHaveStu = DB::search("SELECT * FROM `student_has_class` WHERE `class_id`=" . $clzId . "");
            if ($isHaveStu->num_rows >= 1) {
                  echo "can'tDelete";
            } else {
                  // check class  a/l stream class
                  $haveStream = DB::search("SELECT * FROM `al_stream_has_class` WHERE `class_clz_id`=" . $clzId . "");
                  if ($haveStream->num_rows >= 1) {
                        // delete  records connect with class which need to delete in al_stream_has_class
                        DB::iud("DELETE FROM  `al_stream_has_class`  WHERE `class_clz_id`=" . $clzId . "");
                  }
                  // delete class record from database  
                  DB::iud("DELETE FROM  `class`  WHERE `clz_id`=" . $clzId . "");
                  echo "success";
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