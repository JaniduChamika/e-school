<?php
require "../../connection/connection.php";
if (isset($_POST["g15"])) {
      $g15 =  $_POST["g15"];
      $g611 = $_POST["g611"];
      $g1213 = $_POST["g1213"];

      if ($g15 == "true") {
            for ($i = 1; $i <= 5; $i++) {
                  // search grade is have alrady 
                  $result = DB::search("SELECT * FROM `grade` WHERE `gname`='" . $i . "'");
                  if ($result->num_rows == 0) {
                        // insert grades to database if not have alrady 
                        DB::iud("INSERT INTO `grade` (`gname`) VALUES ('" . $i . "')");
                  }
            }
      }
      if ($g611 == "true") {
            for ($i = 6; $i <= 11; $i++) {
                  // search grade have is alrady 

                  $result = DB::search("SELECT * FROM `grade` WHERE `gname`='" . $i . "'");
                  if ($result->num_rows == 0) {
                        // insert grades to database if not have alrady 

                        DB::iud("INSERT INTO `grade` (`gname`) VALUES ('" . $i . "')");
                  }
            }
      }
      if ($g1213 == "true") {
            for ($i = 12; $i <= 13; $i++) {
                  // search grade is have alrady 

                  $result = DB::search("SELECT * FROM `grade` WHERE `gname`='" . $i . "'");
                  if ($result->num_rows == 0) {
                        // insert grades to database if not have alrady 

                        DB::iud("INSERT INTO `grade` (`gname`) VALUES ('" . $i . "')");
                  }
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
