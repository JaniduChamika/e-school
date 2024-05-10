<?php
session_start();
require "../../connection/connection.php";

if (isset($_POST["t"])) {
      $teacherID = $_SESSION["teacher"]["uid"];

      $sub = $_POST["s"];
      $grade = $_POST["g"];
      $title = $_POST["t"];
      $medium = $_POST["m"];
      if (isset($_FILES["f"])) {
            $pdf = $_FILES["f"];
            // validate details 

            if (empty($grade)) {
                  echo "emptyGrade";
            } else if (empty($sub)) {
                  echo "emptySubject";
            } else if (empty($medium)) {
                  echo "emptyMedium";
            } else if (empty($title)) {
                  echo "emptyTitle";
            } else if ($pdf["type"] != "application/pdf") {
                  echo "notPDF";
            } else {
                  $gresult = DB::search("SELECT * FROM `grade` WHERE `gid`='" . $grade . "'");
                  $gd = $gresult->fetch_assoc();

                  $nresult = DB::search("SELECT MAX(`nid`) AS `lastid` FROM `note`");
                  $nd = $nresult->fetch_assoc();
                  // addin 0 to before text 
                  $length = 4;
                  $string = $nd["lastid"];
                  $end = str_pad($string, $length, "0", STR_PAD_LEFT);
                  // addin 0 to before text 
                  // create note id 
                  $note = "NG" . $gd["gname"] . "/S" . $sub . "/" . $end;
                  // create file name 

                  $name = microtime(true) . ".pdf";
                  // create file path 

                  $path = "../../doc/note/" . $name;
                  // upload file 

                  move_uploaded_file($pdf["tmp_name"], $path);
                  DB::iud("INSERT INTO `note` (`note_id`,`title`,`grade_gid`,`sub_id`,`medium_mid`,`teacher_tuid`,`file_path`) VALUES ('" . $note . "','" . $title . "','" . $grade . "','" . $sub . "','" . $medium . "','" . $teacherID . "','" . $name . "')");


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