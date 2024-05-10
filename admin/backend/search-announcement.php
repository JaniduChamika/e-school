<?php
require "../../connection/connection.php";

$anno = DB::search("SELECT * FROM `announcement` INNER JOIN `user_type` ON `announcement`.`user_type`=`user_type`.`utid` ORDER BY `an_id` DESC");
if ($anno->num_rows >= 1) {
      for ($i = 0; $i < $anno->num_rows; $i++) {
            $annoD = $anno->fetch_assoc();
            // load announcement 
?>
            <li class="notice-item">
                  <table class="w-100">
                        <tr>
                              <td>
                                    <h6 class="notice-text text-start mb-0 fw-bold"><?php echo $annoD["type"] ?> </h6>
                                    <span class="notice-text text-start"><?php echo $annoD["annouce"] ?> </span>
                                    <span class="notice-date text-start"><?php echo $annoD["date_add"] ?></span>

                              </td>
                              <td class="text-end">
                                    <button class="btn btn-sm btn-danger" onclick="deleteAnnoce(<?php echo $annoD['an_id'] ?>);"><i class='bx bxs-trash'></i></button>

                              </td>
                        </tr>
                  </table>

            </li>

      <?php
      }
} else {
      ?>
      <div class="text-center mt-5 text-black">No Announcement</div>

<?php
}
?>