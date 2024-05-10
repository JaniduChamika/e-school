<?php
require "../../connection/connection.php";
if (isset($_POST["id"])) {

      $id = $_POST["id"];

      if (empty($id)) {
            echo "somthingWrong";
      } else {
            // delete announcement from database 
            DB::iud("DELETE FROM `announcement` WHERE `an_id`='" . $id . "'");
            echo "success";
      }
} else {
?>
      <script>
            window.location = "../../misc/pages-404.php";
      </script>
<?php
}


?>