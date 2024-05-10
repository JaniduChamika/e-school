<?php
require "../../connection/connection.php";

if (isset($_POST["g"])) {
      $grade = $_POST["g"];
      // load class relavent selected grade
?>

      <option value="0">Select Class</option>
      <?php
      $result = DB::search("SELECT * FROM `class`  WHERE  `grade_gid` ='" . $grade . "' ");
      for ($i = 0; $i < $result->num_rows; $i++) {
            $d = $result->fetch_assoc();
      ?>
            <option value="<?php echo $d["clz_id"] ?>"><?php echo $d["clz_name"] ?></option>

      <?php
      }
} else {
      ?>
      <script>
            window.location = "../../misc/pages-404.php";
      </script>
<?php
}




?>