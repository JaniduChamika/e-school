<?php
require "../../connection/connection.php";
if (isset($_POST["p"])) {
      $p =  $_POST["p"];
      $c = $_POST["c"];
      $a = $_POST["a"];
      $b = $_POST["b"];
      $t = $_POST["t"];

      if ($p == "true") {

            // search al stream is have alrady 
            $result = DB::search("SELECT * FROM `al_stream` WHERE `stream_name`='Physical-Science'");
            if ($result->num_rows == 0) {
                  // insert in not have al stream 
                  DB::iud("INSERT INTO `al_stream` (`stream_name`) VALUES ('Physical-Science')");
            }
      }
      if ($c == "true") {


            $result = DB::search("SELECT * FROM `al_stream` WHERE `stream_name`='Commerce'");
            if ($result->num_rows == 0) {

                  DB::iud("INSERT INTO `al_stream` (`stream_name`) VALUES ('Commerce')");
            }
      }
      if ($a == "true") {


            $result = DB::search("SELECT * FROM `al_stream` WHERE `stream_name`='Arts'");
            if ($result->num_rows == 0) {

                  DB::iud("INSERT INTO `al_stream` (`stream_name`) VALUES ('Arts')");
            }
      }
      if ($b == "true") {



            $result = DB::search("SELECT * FROM `al_stream` WHERE `stream_name`='Bio-Science'");
            if ($result->num_rows == 0) {

                  DB::iud("INSERT INTO `al_stream` (`stream_name`) VALUES ('Bio-Science')");
            }
      }
      if ($t == "true") {

            $result = DB::search("SELECT * FROM `al_stream` WHERE `stream_name`='Technology'");
            if ($result->num_rows == 0) {

                  DB::iud("INSERT INTO `al_stream` (`stream_name`) VALUES ('Technology')");
            }
      }
      echo "success";
} else {
?>
      <script>
            window.location = "../../misc/pages-404.php";
      </script>
<?php
}
