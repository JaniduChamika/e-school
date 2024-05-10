<?php
require "../../connection/connection.php";

if (isset($_POST["page"])) {
      $page = $_POST["page"];
      $grade = $_POST["g"];
      $word = $_POST["word"];
?>
      <div class="table-responsive text-nowrap pb-4" style="max-height: 675px;min-height: 460px;">
            <table class="table table-borderless">
                  <thead>
                        <tr>
                              <th>Student Username</th>
                              <th>Name</th>
                              <th>Title</th>

                              <th>Paid Date</th>
                              <th>Fee</th>

                              <th>Status</th>

                        </tr>
                  </thead>
                  <tbody>
                        <?php
                        // search student payments 
                        $q = "SELECT `student_payment`.`total`,`student_payment`.`pay_dtime`,`grade`.`gname`,`students`.`username`,`students`.`fulname` FROM `student_payment` INNER JOIN `grade` ON `student_payment`.`grade_gid`=`grade`.`gid` INNER JOIN `students` ON `student_payment`.`user_uid`=`students`.`uid`";

                        if ($grade != "0") {
                              $q = $q . " WHERE `grade_gid`='" . $grade . "'";
                              if (!empty($word)) {
                                    $q = $q . " AND (`username` LIKE '" . $word . "%' OR `fulname` LIKE '%" . $word . "%')";
                              }
                        } else {
                              if (!empty($word)) {
                                    $q = $q . " WHERE (`username` LIKE '" . $word . "%' OR `fulname` LIKE '%" . $word . "%')";
                              }
                        }
                        // for pagination 
                        $number_per_page = 10;
                        $offset = ($page - 1) * $number_per_page;
                        $pagination = DB::search($q);
                        $no_rows = $pagination->num_rows;
                        $no_of_page = $no_rows / $number_per_page;
                        if ($no_rows % $number_per_page != 0) {
                              $no_of_page = $no_of_page + 1;
                        }

                        $no_of_page = intval($no_of_page);

                        $stuFee = DB::search($q . " LIMIT $number_per_page OFFSET $offset");
                        for ($i = 0; $i < $stuFee->num_rows; $i++) {
                              $d = $stuFee->fetch_assoc();
                        ?>
                              <!-- load payment details  -->

                              <tr>
                                    <td><?php echo $d["username"] ?></td>
                                    <td><?php echo $d["fulname"] ?></td>
                                    <td>Grade <?php echo $d["gname"] ?> Fee</td>
                                    <td><?php echo $d["pay_dtime"] ?></td>
                                    <td><?php echo $d["total"] ?></td>

                                    <td><span class="badge bg-label-success me-1">Paid</span></td>

                              </tr>
                        <?php
                        }
                        ?>



                  </tbody>
            </table>
      </div>
      <!-- pagination  button  -->
      <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                  <?php
                  if ($page != 1) {
                  ?>
                        <li class="page-item prev">
                              <a class="page-link" href="javascript:void(0);" onclick="searchStudentEnrolment(<?php echo $page - 1 ?>);"><i class="tf-icon bx bx-chevrons-left"></i></a>
                        </li>
                        <?php
                  }

                  for ($p = 1; $p <= $no_of_page; $p++) {
                        if ($page == $p) {
                        ?>
                              <li class="page-item active">
                                    <a class="page-link" href="javascript:void(0);" onclick="searchStudentEnrolment(<?php echo $p  ?>);"><?php echo $p ?></a>
                              </li>
                        <?php
                        } else {
                        ?>
                              <li class="page-item">
                                    <a class="page-link" href="javascript:void(0);" onclick="searchStudentEnrolment(<?php echo $p ?>);"><?php echo $p ?></a>
                              </li>
                        <?php
                        }
                  }
                  if ($no_of_page != $page && $no_of_page != 0) {
                        ?>
                        <li class="page-item next">
                              <a class="page-link" href="javascript:void(0);" onclick="searchStudentEnrolment(<?php echo $page + 1 ?>);"><i class="tf-icon bx bx-chevrons-right"></i></a>
                        </li>
                  <?php
                  }
                  ?>
            </ul>
      </nav>

<?php
} else {
?>
      <script>
            window.location = "../../misc/pages-404.php";
      </script>
<?php
}
