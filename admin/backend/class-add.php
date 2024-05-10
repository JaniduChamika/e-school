<?php
require "../../connection/connection.php";

if (isset($_POST["ty"])) {
      $type = $_POST["ty"];
      $cname = $_POST["c"];
      $grade = $_POST["g"];
      $techer = $_POST["t"];
      $medium = $_POST["m"];

      $lastid;
      // check which grade own subject and insert them 
      if ($type == "1213") {
            $stream = $_POST["str"];
            if (empty($cname)) {
                  echo "emptyCname";
            } else if (empty($grade)) {
                  echo "emptygrade";
            } else if (empty($medium)) {
                  echo "emptymeduim";
            } else if (empty($stream)) {
                  echo "emptyStream";
            } else {
                  $ishave = DB::search("SELECT * FROM `class` WHERE `clz_name`='" . $cname . "'");
                  if ($ishave->num_rows >= 1) {
                        echo "alreadyHave";
                  } else {
                        if (empty($techer)) {
                              $techer = "0";
                        } else {
                              // assign N/A  for old class
                              DB::iud("UPDATE `class` SET `teacher_tuid`='0' WHERE `teacher_tuid`=" . (int) $techer . "");
                        }

                        // add class details to databas 
                        DB::iud("INSERT INTO `class` (`clz_name`,`grade_gid`,`medium_mid`,`teacher_tuid`) VALUES ('" . $cname . "'," . (int) $grade . "," . (int)$medium . "," . (int) $techer . ")");

                        $lastid = DB::$dbms->insert_id;
                        // add a/l stream of class to database 
                        DB::iud("INSERT INTO `al_stream_has_class` (`al_stream_s_id`,`class_clz_id`) VALUES (" . (int)$stream . "," . (int) $lastid . ")");
                        echo "success";
                  }
            }
      } else {


            if (empty($cname)) {
                  echo "emptyCname";
            } else if (empty($grade)) {
                  echo "emptygrade";
            } else if (empty($medium)) {
                  echo "emptymeduim";
            } else {
                  $ishave = DB::search("SELECT * FROM `class` WHERE `clz_name`='" . $cname . "'");
                  if ($ishave->num_rows >= 1) {
                        echo "alreadyHave";
                  } else {
                        if (empty($techer)) {
                              $techer = "0";
                        } else {
                              // assign N/A  for old class 
                              DB::iud("UPDATE `class` SET `teacher_tuid`='0' WHERE `teacher_tuid`=" . (int) $techer . "");
                        }
                        // insert class details 
                        DB::iud("INSERT INTO `class` (`clz_name`,`grade_gid`,`medium_mid`,`teacher_tuid`) VALUES ('" . $cname . "'," . (int) $grade . "," . (int)$medium . "," . (int) $techer . ")");
                        echo "success";
                  }
            }
      }
} else {
?>
      <script>
            window.location = "../../misc/pages-404.php";
      </script>
<?php
}

?>