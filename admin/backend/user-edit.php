<?php
require "../../connection/connection.php";




if (isset($_POST["userType"])) {
      $Allow_image_type = array("image/jpeg", "image/jpg", "image/png", "image/svg+xml");
      $uid = $_POST["uid"];
      $fname = $_POST["fn"];
      $lname = $_POST["ln"];
      $fullname = $_POST["fulln"];
      $uname = $_POST["uname"];
      $email = $_POST["emailt"];
      $contact = $_POST["contact"];

      $gen = $_POST["gen"];
      $dob = $_POST["dob"];
      $religion = $_POST["religion"];
      $address = $_POST["add"];
      // $province = $_POST["province"];
      // $district = $_POST["dis"];
      $city = $_POST["city"];
      $image = $_POST["image"];
      $userType = $_POST["userType"];
      $UT;
      $nic = "";
      $gname = "";
      $gcontact = "";
      $stuclass = "";
      $nicvalidation = "";
      if ($userType == "student") {
            // give default data to skip validation 
            $nic = "20011113323";
            $gname = $_POST["gname"];
            $gcontact = $_POST["gcontact"];
            $stuclass = $_POST["stuclass"];
      } else {

            $nic = $_POST["nic"];
            // validate nic 
            if (!empty($nic)) {
                  $nic_9 = substr($nic, 0, 9);
                  if (!is_numeric($nic_9)) {
                        $nicvalidation = "invalidNic";
                  } else if (strlen($nic) < 10) {
                        $nicvalidation = "invalidNic";
                  };
            }
            // give default data to skip validation 
            $gname = "defult name";
            $gcontact = "0712222222";
            $stuclass = "1";
      }


      $gender = 1;
      if ($gen != "true") {
            $gender = 2;
      }
      // validate details 
      if (empty($fname)) {
            echo "emptyFname";
      } else if (empty($lname)) {
            echo "emptyLname";
      } else if (empty($fullname)) {
            echo "emptyFullname";
      } else if (empty($uname)) {
            echo "emptyUname";
      } else if (empty($email)) {
            echo "emptyEmail";
      } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "invalidEmail";
      } else if (empty($contact)) {
            echo "emptyContact";
      } else if (strlen($contact) != 10) {
            echo "invalidContact";
      } else if (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $contact) == 0) {
            echo "invalidContact";
      } else if (empty($nic)) {
            echo "emptyNic";
      } else if ($nicvalidation == "invalidNic") {
            echo "invalidNic";
      } else if (preg_match("/[0-9][0-9,v]+/", $nic) == 0) {
            echo "invalidNic";
      } else if (empty($dob)) {
            echo "emptyBOD";
      } else if (empty($stuclass)) {
            echo "emptyClass";
      } else if (empty($religion)) {
            echo "emptyReligion";
      } else if (empty($gname)) {
            echo "emptyGaurdianName";
      } else if (empty($gcontact)) {
            echo "emptyemptyContact";
      } else if (strlen($gcontact) != 10) {
            echo "invalidGardianContact";
      } else if (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $gcontact) == 0) {
            echo "invalidGardianContact";
      } else if (empty($address)) {
            echo "emptyAddress";
      } else if (empty($city)) {
            echo "emptyCity";
      } else if (empty($userType)) {
            echo "Somthing worng try again later";
      } else {

            $ishave = DB::search("SELECT * FROM `user` WHERE `username`='" . $uname . "'");
            if ($ishave->num_rows == 1) {

                  if ($userType == "admin") {

                        // update admin details to user table 

                        DB::iud("UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`fulname`='" . $fullname . "',
                      `contact`='" . $contact . "',`email`='" . $email . "',`dob`='" . $dob . "',`gender_gid`='" . $gender . "',`religion_rid`='" . $religion . "'
                       WHERE `uid`='" . $uid . "' ");

                        // update admin nic 
                        DB::iud("UPDATE `nic` SET `nic_no`='" . $nic . "' WHERE `user_uid`='" . $uid . "'");
                  } else if ($userType == "teacher") {
                        $UT = "3";
                        $sublen = $_POST["sublen"];
                        // update teacher details to user table 
                        DB::iud("UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`fulname`='" . $fullname . "',
                        `contact`='" . $contact . "',`email`='" . $email . "',`dob`='" . $dob . "',`gender_gid`='" . $gender . "',`religion_rid`='" . $religion . "'
                         WHERE `uid`='" . $uid . "'  ");


                        // update teacher nic 
                        DB::iud("UPDATE `nic` SET `nic_no`='" . $nic . "' WHERE `user_uid`='" . $uid . "'");


                        $gradeno = DB::search("SELECT * FROM `grade`");
                        DB::iud("DELETE FROM `teacher_has_grade` WHERE `user_uid`='" . $uid . "'");

                        for ($i = 0; $i < $gradeno->num_rows; $i++) {
                              $grade = $_POST["g" . $i];
                              $gradeid = $_POST["gid" . $i];

                              if ($grade == "true") {
                                    DB::iud("INSERT INTO `teacher_has_grade` (`user_uid`,`grade_gid`) VALUES ('" . $uid . "','" . $gradeid . "')");
                              }
                        }
                        DB::iud("DELETE FROM `teacher_has_subject` WHERE `user_uid`='" . $uid . "'");

                        for ($i = 0; $i < $sublen; $i++) {
                              $sub = $_POST["sub" . $i];
                              $subid = $_POST["subid" . $i];

                              if ($sub == "true") {
                                    DB::iud("INSERT INTO `teacher_has_subject` (`user_uid`,`subject_id`) VALUES ('" . $uid . "','" . $subid . "')");
                              }
                        }
                  } else if ($userType == "student") {
                        $UT = "2";
                        // update student details to user table 
                        DB::iud("UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`fulname`='" . $fullname . "',
                        `contact`='" . $contact . "',`email`='" . $email . "',`dob`='" . $dob . "',`gender_gid`='" . $gender . "',`religion_rid`='" . $religion . "'
                         WHERE `uid`='" . $uid . "' ");

                        // update student guardian details 
                        DB::iud("UPDATE `guardian_info` SET `name`='" . $gname . "',`contact_no`='" . $gcontact . "' WHERE `user_uid`='" . $uid . "'");
                        DB::iud("UPDATE `student_has_class` SET `class_id`='" . $stuclass . "' WHERE `user_uid`='" . $uid . "'");
                  } else if ($userType == "officer") {
                        $UT = "4";
                        // update officer details to user table 
                        DB::iud("UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`fulname`='" . $fullname . "',
                        `contact`='" . $contact . "',`email`='" . $email . "',`dob`='" . $dob . "',`gender_gid`='" . $gender . "',`religion_rid`='" . $religion . "'
                         WHERE `uid`='" . $uid . "' ");

                        // update officer nic 
                        DB::iud("UPDATE `nic` SET `nic_no`='" . $nic . "' WHERE `user_uid`='" . $uid . "'");
                  }


                  $haveAdd = DB::search("SELECT * FROM `address` WHERE `user_uid`='" . $uid . "'");
                  if ($haveAdd->num_rows == 1) {
                        DB::iud("UPDATE `address` SET `address_line`='" . $address . "',`city_cid`='" . $city . "' WHERE `user_uid`='" . $uid . "'");
                  } else {
                        DB::iud("INSERT INTO `address` (`address_line`,`user_uid`,`city_cid`) VALUES ('" . $address . "','" . $uid . "','" . $city . "')");
                  }


                  if (!empty($image)) {
                        // start image upload and rename 
                        // get image type 
                        $type1 = (explode(';', $image, -1))[0];
                        $imgType = (explode(':', $type1, 2))[1];
                        // get image type 

                        if (!in_array($imgType, $Allow_image_type)) {
                              // echo "Please Select An SVG,JPEG,JPG or PNG Image";
                        } else {
                              $t = microtime(true);
                              $extenstion;
                              if ($imgType == "image/jpeg") {
                                    $extenstion = "jpeg";
                              } else if ($imgType == "image/jpg") {
                                    $extenstion = "jpg";
                              } else if ($imgType == "image/png") {
                                    $extenstion = "png";
                              } else if ($imgType == "image/svg+xml") {
                                    $extenstion = "svg";
                              }
                              // create name for image 
                              $imgName = $t . "." . $extenstion;
                              // create path.
                              $path = "../../image/profile/" . $imgName;
                              // upload image  
                              file_put_contents($path, file_get_contents($image));

                              $existImg = DB::search("SELECT * FROM `profile_image` WHERE `user_uid`='" . $uid . "'");
                              if ($existImg->num_rows == 1) {
                                    $eimg = $existImg->fetch_assoc();
                                    $file_pointer = "../../image/profile/" . $eimg["path"];
                                    // delete old image 
                                    unlink($file_pointer);
                                    // update profile image  
                                    DB::iud("UPDATE `profile_image` SET `path`='" . $imgName . "' WHERE `user_uid`='" . $uid . "'");
                              } else {
                                    DB::iud("INSERT INTO `profile_image` (`user_uid`,`path`) VALUES ('" . $uid . "','" . $imgName . "')");
                              }
                        }
                  }

                  echo "success";
            }
      }
} else {
?>
      <script>
            window.location = "../../misc/pages-404.php";
      </script>
<?php
}
