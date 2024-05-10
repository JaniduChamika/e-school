<?php
session_start();
require "../../connection/connection.php";

if (isset($_POST["nid"])) {
      $nid = $_POST["nid"];

      $have = DB::search("SELECT * FROM `note_view` WHERE `nid` ='" . $nid . "' AND `uid`='" . $_SESSION["teacher"]["uid"] . "'");
      if ($have->num_rows == 1) {
            $d = $have->fetch_assoc();
            $file_pointer = "../../doc/note/" . $d["file_path"];
            // delete pdf file  
            unlink($file_pointer);
            // delete note record from table 
            DB::iud("DELETE FROM `note` WHERE `nid`='" . $nid . "' AND `teacher_tuid`='" . $_SESSION["teacher"]["uid"] . "'");
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