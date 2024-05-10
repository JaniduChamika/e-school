<?php

require "../../connection/connection.php";

if(isset($_POST["g"])){
$grad=$_POST["g"];
$fee=$_POST["fee"];

$ishave=DB::search("SELECT * FROM `enrollment_fee` WHERE `grade_gid`='".$grad."'");
if($ishave->num_rows>=1){
      // update enrollment fee 
      DB::iud("UPDATE `enrollment_fee` SET `fee`='".$fee."' WHERE `grade_gid`='".$grad."' ");
      echo "success";

}else{
      echo "notexist";

}

}else {
?>
      <script>
            window.location = "../../login/gui/admin-login.php";
      </script>
<?php
}
?>
