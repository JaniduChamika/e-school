<?php
require "../../connection/connection.php";
if (isset($_POST["c"])) {

      $type =  $_POST["c"];
   
      $anno = $_POST["a"];
     
      $d = new DateTime();
      $tz = new DateTimeZone("Asia/Colombo");
      $d->setTimezone($tz);
      $date = $d->format("Y-m-d");
      if (empty($anno)) {
            echo "emptyContent";
      } else if (empty($type)) {
            echo "selectCrowd";
      } else {
            // add announcement with selected users 
            DB::iud("INSERT INTO `announcement` (`annouce`,`user_type`,`date_add`) VALUES ('" . $anno . "','" . $type . "','" . $date . "')");
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