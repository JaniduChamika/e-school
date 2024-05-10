<?php
require "../../connection/connection.php";

if (isset($_POST["g"])) {
      $grade = $_POST["g"];

?>
      <!-- load teachers according to selected grade  -->
      <option value="0">Select Teacher</option>
      <?php
      $result = DB::search("SELECT * FROM `user` INNER JOIN `teacher_has_grade` ON user.`uid`=teacher_has_grade.`user_uid` INNER JOIN `grade` ON teacher_has_grade.`grade_gid`=grade.`gid` WHERE user.`user_type`='3' AND grade.`gid` ='" . $grade . "' ");
      for ($i = 0; $i < $result->num_rows; $i++) {
            $d = $result->fetch_assoc();
            $ishaveClz = DB::search("SELECT * FROM `class` WHERE `teacher_tuid`='" . $d["uid"] . "'");
            if ($ishaveClz->num_rows == 0) {
      ?>
                  <option value="<?php echo $d["uid"] ?>"><?php echo $d["fulname"] ?></option>

            <?php
            } else {
            ?>
                  <option value="<?php echo $d["uid"] ?>"><?php echo $d["fulname"] ?> (Assigned)</option>

      <?php
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