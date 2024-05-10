<?php

require "../../connection/connection.php";

if (isset($_POST["id"])) {
      $sid = $_POST["id"];
      $subname = $_POST["sub"];
      if (empty($subname)) {
            echo "emptySub";
      } else {
            // chech aleady have this subject  
            $isHave = DB::search("SELECT * FROM `subject` WHERE `sub_id`='" . $sid . "'");
            if ($isHave->num_rows == 1) {
                  // update databse with new subject name 
                  DB::iud("UPDATE `subject` SET `sub_name`='" . ucwords($subname) . "' WHERE `sub_id`='" . $sid . "'");
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