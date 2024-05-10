<?php

require "../../connection/connection.php";
if (isset($_POST["id"])) {


      $id = $_POST["id"];


      $ishave = DB::search("SELECT * FROM `user` WHERE `uid`='" . $id . "'");
      if ($ishave->num_rows == 1) {
            // update status as block 
            DB::iud("UPDATE `user` SET `status_sid`='3' WHERE `uid`='" . $id . "'");
            echo "success";
      }
} else {
?>
      <script>
            window.location = "../../misc/pages-404.php";
      </script>
<?php
}
