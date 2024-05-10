<?php

require "../../connection/connection.php";

if (isset($_POST["id"])) {
      $clzId = (int)$_POST["id"];
      $name = $_POST["n"];
      if (empty($name)) {
            echo "empty";
      } else {
            // check is already have this class name 
            $alreadyHave = DB::search("SELECT * FROM `class` WHERE `clz_id`<> " .  $clzId . " AND `clz_name`='" . $name . "'");
            if ($alreadyHave->num_rows >= 1) {
                  echo "alreadyHave";
            } else {
                  $isHave = DB::search("SELECT * FROM `class` WHERE `clz_id`=" . $clzId . "");
                  if ($isHave->num_rows == 1) {
                        // rename class name 
                        DB::iud("UPDATE `class` SET `clz_name`='" . $name . "' WHERE `clz_id`=" . $clzId . "");
                        echo "success";
                  } else {
                        echo "wrong";
                  }
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