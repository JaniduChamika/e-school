<?php
require "../connection/connection.php";

session_start();
if (isset($_SESSION["student"])) {
      $uid = $_SESSION["student"]["uid"];

      $day = new DateTime();
      $tz = new DateTimeZone("Asia/Colombo");
      $day->setTimezone($tz);
      $date = $day->format("Y-m-d");

      $istrial = DB::search("SELECT * FROM `trial_period` WHERE `user_uid`='" . $uid . "'");
      if ($istrial->num_rows == 0) {
            // saved record with trail start date 
            DB::iud("INSERT INTO `trial_period` (`user_uid`,`start_date`) VALUES ('" . $uid . "','" . $date . "')");
            echo "triaStart";
      } else {
            echo "alradyUse";
      }
} else {
?>
      <script>
            window.location = "misc/pages-404.php";
      </script>
<?php
}
?>