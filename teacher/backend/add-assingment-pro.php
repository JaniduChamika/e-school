<?php
session_start();
require "../../connection/connection.php";

if (isset($_POST["t"])) {
      $teacherID = $_SESSION["teacher"]["uid"];
      $day = new DateTime();
      $tz = new DateTimeZone("Asia/Colombo");
      $day->setTimezone($tz);
      $date = $day->format("Y-m-d");

      $sub = $_POST["s"];
      $grade = $_POST["g"];
      $title = $_POST["t"];

      $startdate = $_POST["sd"];
      $enddate = $_POST["ed"];
      if (isset($_FILES["f"])) {
            $pdf = $_FILES["f"];
            // validate details 
            if (empty($grade)) {
                  echo "emptyGrade";
            } else if (empty($sub)) {
                  echo "emptySubject";
            } else if (empty($startdate)) {
                  echo "emptySdate";
            } else if ($startdate < $date) {
                  echo "invalidStart";
            } else if (empty($enddate)) {
                  echo "emptyEdate";
            } else if ($enddate < $startdate) {
                  echo "invalidEndDate";
            } else if (empty($title)) {
                  echo "emptyTitle";
            } else if ($pdf["type"] != "application/pdf") {
                  echo "notPDF";
            } else {
                  $gresult = DB::search("SELECT * FROM `grade` WHERE `gid`='" . $grade . "'");
                  $gd = $gresult->fetch_assoc();

                  $nresult = DB::search("SELECT MAX(`aid`) AS `lastid` FROM `assignment`");
                  $nd = $nresult->fetch_assoc();
                  // addin 0 to before text 
                  $length = 4;
                  $string = $nd["lastid"];
                  $end = str_pad($string, $length, "0", STR_PAD_LEFT);
                  // addin 0 to before text 
                  // create assignment id 
                  $note = "AG" . $gd["gname"] . "/S" . $sub . "/" . $end;
                  // create file name 
                  $name = microtime(true) . ".pdf";
                  // create file path 
                  $path = "../../doc/assignment/" . $name;
                  // upload file 
                  move_uploaded_file($pdf["tmp_name"], $path);
                  // insert assignment table 
                  DB::iud("INSERT INTO `assignment` (`assignment_id`,`title`,`grade_gid`,`sub_id`,`teacher_tuid`,`file_path`,`start_date`,`end_date`) VALUES ('" . $note . "','" . $title . "','" . $grade . "','" . $sub . "','" . $teacherID . "','" . $name . "','" . $startdate . "','" . $enddate . "')");


                  echo "success";
            }
      } else {
            echo "emptyFile";
      }
} else {
?>
      <script>
            window.location = "../../misc/pages-404.php";
      </script>
<?php
}


?>