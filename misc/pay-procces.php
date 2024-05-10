<?php
session_start();
require "../connection/connection.php";

$day = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$day->setTimezone($tz);
$date = $day->format("Y-m-d H:i:s");
$stuid = $_SESSION["student"]["uid"];
// $uid=$_POST["id"];

$stu = DB::search("SELECT * FROM `students` WHERE `uid`='" . $stuid . "'");
$studata = $stu->fetch_assoc();
$fee = DB::search("SELECT * FROM `enrollment_fee` WHERE `grade_gid`='" . $studata["gid"]  . "'");
$price = $fee->fetch_assoc();
$total = $price["fee"];
// insert student payment details to database 
DB::iud("INSERT INTO `student_payment` (`grade_gid`,`user_uid`,`pay_dtime`,`total`) VALUES ('" . $studata["gid"] . "','" . $stuid . "','" . $date . "','" . $total . "')");
echo "success";
