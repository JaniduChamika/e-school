<?php
require "../../connection/connection.php";

$fee = DB::search("SELECT * FROM `enrollment_fee` INNER JOIN `grade` ON enrollment_fee.`grade_gid`=`grade`.`gid`");
for ($i = 0; $i < $fee->num_rows; $i++) {
      $d = $fee->fetch_assoc();
      // load enrollment fee table 
?>
      <tr>
            <td><?php echo $i + 1 ?></td>
            <td>Grade <?php echo $d["gname"] ?></td>

            <td>Rs <?php echo $d["fee"] ?>.00</td>

            <td>
                  <div class="dropdown text-center">
                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                              <i class="bx bx-dots-vertical-rounded"></i>
                        </button>
                        <div class="dropdown-menu">
                              <a class="dropdown-item" href="#" onclick="vieweditFee(<?php echo $d['grade_gid'] ?>,'<?php echo $d['fee'] ?>');"><i class="bx bx-edit-alt me-1"></i> Edit</a>
                        </div>
                  </div>
            </td>

      </tr>
<?php
}
?>