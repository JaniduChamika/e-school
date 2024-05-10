<?php
require "../../connection/connection.php";

if (isset($_POST["g15"])) {

      $g15 = $_POST["g15"];
      $g69 = $_POST["g69"];
      $g1011 = $_POST["g1011"];
      $g1213 = $_POST["g1213"];
      $grade = "0";
      if ($g15 == "true") {
            $grade = $grade . ",15";
      }
      if ($g69 == "true") {
            $grade = $grade . ",69";
      }
      if ($g1011 == "true") {
            $grade = $grade . ",1011";
      }
      if ($g1213 == "true") {
            $grade = $grade . ",1213";
      }
     
      // get subject related for each grade 
      $subject = DB::search("SELECT * FROM `allsubject` WHERE `sub_grade_type` IN ($grade) GROUP BY  `sub_id`");
      for ($i = 0; $i < $subject->num_rows; $i++) {
            $d = $subject->fetch_assoc();
 ?>
            <div class="form-check form-check-inline">
                   <input class="form-check-input subjectTec"  value="<?php echo $d["sub_id"] ?>" type="checkbox" id="subject<?php echo $i + 1 ?>">
                  <label class="form-check-label" for="subject<?php echo $i + 1 ?>"><?php echo $d["sub_name"] ?></label>
             </div>
      <?php
      }
} else {
      ?>
      <script>
            window.location = "../../misc/pages-404.php";
      </script>
<?php
}
