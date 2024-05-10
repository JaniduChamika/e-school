<?php
session_start();
require "../../connection/connection.php";


if (isset($_SESSION["teacher"]) && isset($_POST["fn"])) {

      $uid = $_SESSION["teacher"]["uid"];
      $fname = $_POST["fn"];
      $lname = $_POST["ln"];
      $fullname = $_POST["fulln"];


      $contact = $_POST["contact"];

      $gen = $_POST["gen"];
      $dob = $_POST["dob"];
      $religion = $_POST["religion"];
      $address = $_POST["add"];

      $city = $_POST["city"];

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
      } else if (empty($contact)) {
            echo "emptyContact";
      } else if (strlen($contact) != 10) {
            echo "invalidContact";
      } else if (preg_match("/07[0,1,2,4,5,6,7,8][0-9]+/", $contact) == 0) {
            echo "invalidContact";
      } else if (empty($dob)) {
            echo "emptyBOD";
      } else if (empty($religion)) {
            echo "emptyReligion";
      } else if (empty($address)) {
            echo "emptyAddress";
      } else if (empty($city)) {
            echo "emptyCity";
      } else {

            $ishave = DB::search("SELECT * FROM `user` WHERE `uid`='" . $uid . "'");
            if ($ishave->num_rows >= 1) {


                  // update  user table 

                  DB::iud("UPDATE `user` SET `fname`='" . $fname . "',`lname`='" . $lname . "',`fulname`='" . $fullname . "',
                      `contact`='" . $contact . "',`dob`='" . $dob . "',`gender_gid`='" . $gender . "',`religion_rid`='" . $religion . "'
                       WHERE `uid`='" . $uid . "' ");



                  $haveAdd = DB::search("SELECT * FROM `address` WHERE `user_uid`='" . $uid . "'");
                  // update or insert address 
                  if ($haveAdd->num_rows == 1) {
                        DB::iud("UPDATE `address` SET `address_line`='" . $address . "',`city_cid`='" . $city . "' WHERE `user_uid`='" . $uid . "'");
                  } else {
                        DB::iud("INSERT INTO `address` (`address_line`,`user_uid`,`city_cid`) VALUES ('" . $address . "','" . $uid . "','" . $city . "')");
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
