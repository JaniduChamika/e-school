<?php
require "../../connection/connection.php";




if (isset($_POST["uid"])) {
      $Allow_image_type = array("image/jpeg", "image/jpg", "image/png", "image/svg+xml");
      // get student details 
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

      $city = $_POST["city"];
      $image = $_POST["image"];

      $gname = "";
      $gcontact = "";
      $stuclass = "";

      $gname = $_POST["gname"];
      $gcontact = $_POST["gcontact"];
      $stuclass = $_POST["stuclass"];



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
      } else {

            $ishave = DB::search("SELECT * FROM `user` WHERE `username`='" . $uname . "'");
            if ($ishave->num_rows >= 1) {



                  // update student details to user table 
                  DB::iud("UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`fulname`='" . $fullname . "',
                        `contact`='" . $contact . "',`email`='" . $email . "',`dob`='" . $dob . "',`gender_gid`='" . $gender . "',`religion_rid`='" . $religion . "'
                         WHERE `uid`='" . $uid . "' ");

                  // update student guardian details 
                  DB::iud("UPDATE `guardian_info` SET `name`='" . $gname . "',`contact_no`='" . $gcontact . "' WHERE `user_uid`='" . $uid . "'");

                  // update student class 
                  DB::iud("UPDATE `student_has_class` SET `class_id`='" . $stuclass . "' WHERE `user_uid`='" . $uid . "'");

                  $haveAdd = DB::search("SELECT * FROM `address` WHERE `user_uid`='" . $uid . "'");
                  // update or insert student address 
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
                        // validate image type 
                        if (!in_array($imgType, $Allow_image_type)) {
                              echo "Please Select An SVG,JPEG,JPG or PNG Image";
                        } else {
                              $t = microtime(true);
                              $extenstion;
                              // validate image type 
                              if ($imgType == "image/jpeg") {
                                    $extenstion = "jpeg";
                              } else if ($imgType == "image/jpg") {
                                    $extenstion = "jpg";
                              } else if ($imgType == "image/png") {
                                    $extenstion = "png";
                              } else if ($imgType == "image/svg+xml") {
                                    $extenstion = "svg";
                              }
                              // create image name 
                              $imgName = $t . "." . $extenstion;
                              // create path 
                              $path = "../../image/profile/" . $imgName;
                              // save image 
                              file_put_contents($path, file_get_contents($image));

                              $existImg = DB::search("SELECT * FROM `profile_image` WHERE `user_uid`='" . $uid . "'");
                              if ($existImg->num_rows == 1) {
                                    $eimg = $existImg->fetch_assoc();
                                    $file_pointer = "../../image/profile/" . $eimg["path"];
                                    // delete older profile image 
                                    unlink($file_pointer);
                                    // update profile image table with new image name 
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
