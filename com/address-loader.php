<?php
require "../connection/connection.php";

$type = $_POST["ty"];
if ($type == "district") {
      $province = $_POST["p"];
      // load district acroding to province 
      $result = DB::search("SELECT * FROM `district` WHERE `province_pid`='" . $province . "'");
?>
      <option value="0">Select District</option>
      <?php
      for ($i = 0; $i < $result->num_rows; $i++) {
            $d = $result->fetch_assoc();
      ?>
            <option value="<?php echo $d["did"] ?>"><?php echo $d["dname_en"] ?></option>
      <?php
      }
} elseif ($type == "city") {
      $district = $_POST["d"];
      // load cities acroding to district 
      $result = DB::search("SELECT * FROM `city` WHERE `district_did`='" . $district . "'");
      ?>
      <option value="0">Select City</option>
      <?php
      for ($i = 0; $i < $result->num_rows; $i++) {
            $d = $result->fetch_assoc();
      ?>
            <option value="<?php echo $d["cid"] ?>"><?php echo $d["cname_en"] ?></option>
<?php
      }
} elseif ($type == "postal") {
      // load postal code acording to city 
      $city = $_POST["c"];
      $result = DB::search("SELECT * FROM `city` WHERE `cid`='" . $city . "'");
      if ($result->num_rows == 1) {
            $d = $result->fetch_assoc();
            echo $d["postcode"];
      }
}
