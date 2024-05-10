<?php

require "../../connection/connection.php";

if(isset($_POST["g"])){
$grad=$_POST["g"];
$fee=$_POST["fee"];

$ishave=DB::search("SELECT * FROM `enrollment_fee` WHERE `grade_gid`='".$grad."'");
if($ishave->num_rows>=1){
      echo "alradyHave";
}else{
      // add enrollment fee acroding to grade 
      DB::iud("INSERT INTO `enrollment_fee` (`grade_gid`,`fee`) VALUES ('".$grad."','".$fee."') ");
      echo "success";
}

}else {
?>
      <script>
            window.location = "../../login/gui/admin-login.php";
      </script>
<?php
}
?>
