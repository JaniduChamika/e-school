<?php
require "../../connection/connection.php";

if (isset($_POST["date"])) {
      $date = $_POST["date"];
      $time = $_POST["time"];
      $info = $_POST["info"];
      if (empty($date)) {
            echo "emptyDate";
      } else if (empty($time)) {
            echo "emtytime";
      } else if (empty($info)) {
            echo "emtytopic";
      } else {
            // add event
            DB::iud("INSERT INTO `event` (`e_date`,`e_time`,`ev_info`) VALUES ('" . $date . "','" . $time . ":00" . "','" . $info . "') ");
         
            echo "success";
      }
}
