<?php
require "../../connection/connection.php";
if (isset($_POST["s"])) {
      $s =  $_POST["s"];
      $e = $_POST["e"];
      $t = $_POST["t"];

      if ($s == "true") {

            // search medium is have alrady 
            $result = DB::search("SELECT * FROM `medium` WHERE `mname`='Sinhala'");
            if ($result->num_rows == 0) {
                  // insert medium to database if not have alrady 
                  DB::iud("INSERT INTO `medium` (`mname`) VALUES ('Sinhala')");
            }
      }
      if ($e == "true") {

            // search medium is have alrady 

            $result = DB::search("SELECT * FROM `medium` WHERE `mname`='English'");
            if ($result->num_rows == 0) {
                  // insert medium to database if not have alrady 

                  DB::iud("INSERT INTO `medium` (`mname`) VALUES ('English')");
            }
      }
      if ($t == "true") {

            // search medium have is alrady 

            $result = DB::search("SELECT * FROM `medium` WHERE `mname`='Tamil'");
            if ($result->num_rows == 0) {
                  // insert medium to database if not have alrady 

                  DB::iud("INSERT INTO `medium` (`mname`) VALUES ('Tamil')");
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
