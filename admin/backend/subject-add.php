<?php
require "../../connection/connection.php";

if (isset($_POST["ty"])) {
      $type = (int)$_POST["ty"];
      $sub = $_POST["s"];

      $lastid;
      // check which grade own subject and insert them 
      if ($type == "1213") {
            // add a/l subject 
            $stream = (int)$_POST["str"];
            if (empty($sub)) {
                  echo "emptySubname";
            } else if (empty($stream)) {
                  echo "nostream";
            } else {
                  // check is subject already exist 

                  $ishaveSub = DB::search("SELECT * FROM `subject` WHERE `sub_name`='" . ucwords($sub) . "'");
                  if ($ishaveSub->num_rows >= 1) {
                        $d = $ishaveSub->fetch_assoc();
                        $subid = $d["sub_id"];
                        // check is a/l stream has same subject 
                        $alreadyHaveStream = DB::search("SELECT * FROM `al_stream_has_subject` WHERE `subject_sid`=" . $subid . " AND `al_stream_id`=" . $stream . "");
                        if ($alreadyHaveStream->num_rows == 1) {
                              echo "alreadyExist";
                        } else {
                              // check is already have grade type  
                              $alreadyHavegradetype = DB::search("SELECT * FROM `al_stream_has_subject` WHERE `subject_sid`=" . $subid . " AND `al_stream_id`=" . $stream . "");
                              if ($alreadyHavegradetype->num_rows == 0) {
                                    // add grade type for subject 
                                    DB::iud("INSERT INTO `subject_has_grade_type` (`subject_sub_id`,`sub_grade_type_sg_id`,`subject_category_c_id`) VALUES ('" . $subid . "'," . $type . ",1)");
                              }
                              // add subject to a/l stream 
                              DB::iud("INSERT INTO `al_stream_has_subject` (`al_stream_id`,`subject_sid`) VALUES (" . $stream . "," . $subid . ")");
                              echo "success";
                        }
                  } else {
                        // add subject 
                        DB::iud("INSERT INTO `subject` (`sub_name`) VALUES ('" . ucwords($sub) . "')");

                        $lastid = DB::$dbms->insert_id;
                        // add grade type for subject 
                        DB::iud("INSERT INTO `subject_has_grade_type` (`subject_sub_id`,`sub_grade_type_sg_id`,`subject_category_c_id`) VALUES ('" . $lastid . "'," . $type . ",1)");
                        // add a/l stream 

                        DB::iud("INSERT INTO `al_stream_has_subject` (`al_stream_id`,`subject_sid`) VALUES ('" . $stream . "','" . $lastid . "')");
                        echo "success";
                  }
            }
      } else {
            // add grade 1-11 subjects 
            $cstate15 = $_POST["c15state"];
            $cstate69 = $_POST["c69state"];
            $cstate1011 = $_POST["c1011state"];




            if (empty($sub)) {
                  echo "emptySubname";
            } else if ($cstate15 == "false" && $cstate69 == "false" && $cstate1011 == "false") {
                  echo "selectGrandRange";
            } else if ($cstate15 == "true" && $_POST["c15"] == "0") {
                  echo "selectC15";
            } else if ($cstate69 == "true" && $_POST["c69"] == "0") {
                  echo "selectC69";
            } else if ($cstate1011 == "true" && $_POST["c1011"] == "0") {
                  echo "selectC1011";
            } else {
                  $ishaveSub = DB::search("SELECT * FROM `subject` WHERE `sub_name`='" . ucwords($sub) . "'");
                  if ($ishaveSub->num_rows >= 1) {

                        echo "alreadyExist";
                  } else {
                        // add subject 
                        DB::iud("INSERT INTO `subject` (`sub_name`) VALUES ('" . ucwords($sub) . "')");
                        $lastid = DB::$dbms->insert_id;
                        // add grade types for subject 
                        if ($cstate15 == "true") {
                              DB::iud("INSERT INTO `subject_has_grade_type` (`subject_sub_id`,`sub_grade_type_sg_id`,`subject_category_c_id`) VALUES (" . $lastid . ",15," . (int)$_POST["c15"] . ")");
                        }
                        if ($cstate69 == "true") {
                              DB::iud("INSERT INTO `subject_has_grade_type` (`subject_sub_id`,`sub_grade_type_sg_id`,`subject_category_c_id`) VALUES (" . $lastid . ",69," . (int)$_POST["c69"] . ")");
                        }
                        if ($cstate1011 == "true") {
                              DB::iud("INSERT INTO `subject_has_grade_type` (`subject_sub_id`,`sub_grade_type_sg_id`,`subject_category_c_id`) VALUES (" . $lastid . ",1011," . (int)$_POST["c1011"] . ")");
                        }

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