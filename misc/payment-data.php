<?php
session_start();
require "../connection/connection.php";

if (isset($_SESSION["student"])) {

      $uid = $_SESSION["student"]["uid"];
      // get student details 
      $stu = DB::search("SELECT * FROM `students` WHERE `uid`='" . $uid . "'");
      if ($stu->num_rows == 1) {
            $data = $stu->fetch_assoc();
            $array["uid"] = $data["uid"];
            $array["fname"] = $data["fname"];
            $array["lname"] = $data["lname"];
            $array["address"] = $data["address_line"];

            $array["city"] = $data["city"];
            $array["email"] = $data["email"];
            $array["contact"] = $data["contact"];
            //   get payment details 
            $fee = DB::search("SELECT * FROM `enrollment_fee` WHERE `grade_gid`='" . $data["gid"] . "'");
            $price = $fee->fetch_assoc();

            $array["price"] = $price["fee"];
            // $array["price"] = "200";
            echo json_encode($array);
      }
} else {
?>
      <script>
            window.location = "misc/pages-404.php";
      </script>
<?php
}
?>