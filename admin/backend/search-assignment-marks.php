<?php
require "../../connection/connection.php";
if (isset($_POST["page"])) {
      $page = $_POST["page"];
      $grade = $_POST["g"];
      $sub = $_POST["s"];
      $pen = $_POST["p"];
      $word = $_POST["word"];

?>
      <div class="table-responsive text-nowrap mb-4 scrollbar" style="min-height: 550px;max-height: 550px;">
            <table class="table table-hover expandable-table">
                  <thead>
                        <tr>
                              <th class="ps-3">#</th>
                              <th class="ps-3">Assignment ID </th>
                              <th class="ps-3">Subject</th>
                              <th class="ps-3">Student Username</th>
                              <th class="ps-3">Grade</th>
                              <th class="ps-3">Submitted Date</th>

                              <th class="ps-3">Marks</th>
                              <th class="ps-3">Status</th>

                              <th class="ps-2">Actions</th>
                        </tr>
                  </thead>
                  <tbody class="table-border-bottom-0 ">
                        <?php
                        // search studetn aswers from stu_assignment_awnser view 

                        $q = "SELECT * FROM `stu_assignment_awnser` WHERE `status`!='3'";

                        if ($pen == "true") {
                              $q = "SELECT * FROM `stu_assignment_awnser` WHERE `status`='1'";
                        }
                        $q1 = "AND `gid`='" . $grade . "'";
                        $q2 = "`sub_id`='" . $sub . "'";

                        if ($grade != "0" && $sub != "0") {
                              $q = $q . $q1 . " AND " . $q2;
                        } else if ($grade != "0") {
                              $q = $q . $q1;
                        } else if ($sub != "0") {
                              $q = $q . " AND " . $q2;
                        }
                        if (!empty($word)) {
                              // search by assignment id student name, title and student username 

                              $q = $q . " AND (`assignment_id` LIKE '" . $word . "%' OR `title` LIKE '" . $word . "%' OR `sub_name` LIKE '" . $word . "%' OR `stu_uname` LIKE '" . $word . "%' OR `stu_fulname` LIKE '%" . $word . "%')";
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


                        $result = DB::search($q . " LIMIT $number_per_page OFFSET $offset");
                        for ($i = 0; $i < $result->num_rows; $i++) {
                              $d = $result->fetch_assoc();
                        ?>
                              <!-- crete table row with details  -->

                              <tr>
                                    <td><?php echo $i + 1 + $offset ?></td>

                                    <td>
                                          <span class="fw-bold text-capitalize"><?php echo $d["assignment_id"] ?></span>
                                    </td>
                                    <td><?php echo $d["sub_name"] ?></td>

                                    <td>
                                          <?php echo $d["stu_uname"] ?>
                                    </td>
                                    <td><?php echo $d["gname"] ?></td>
                                    <td><?php echo $d["submit_date"] ?></td>

                                    <th><?php echo $d["marks"] ?></th>

                                    <td>
                                          <?php
                                          if ($d["status"] == 2) {
                                          ?>
                                                <span class="badge bg-label-success me-1">Released</span>

                                          <?php
                                          } else {
                                          ?>
                                                <span class="badge bg-label-warning me-1">Pending</span>

                                          <?php
                                          }
                                          ?>
                                    </td>

                                    <td>
                                          <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                      <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">

                                                      <a class="dropdown-item" href="../../doc/result-sheet/<?php echo $d["result_sheet_path"] ?>" target="_blank"><i class='bx bx-show-alt'></i> View Result Sheet</a>
                                                      <a class="dropdown-item" href="javascript:void(0);" onclick="releseMarks(<?php echo $d['answr_id'] ?>);"><i class='bx bx-send'></i> Release Marks</a>
                                                </div>
                                          </div>
                                    </td>
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
                              <a class="page-link" href="javascript:void(0);" onclick="searchAssignmentMark(<?php echo $page - 1 ?>);"><i class="tf-icon bx bx-chevrons-left"></i></a>
                        </li>
                        <?php
                  }

                  for ($p = 1; $p <= $no_of_page; $p++) {
                        if ($page == $p) {
                        ?>
                              <li class="page-item active">
                                    <a class="page-link" href="javascript:void(0);" onclick="searchAssignmentMark(<?php echo $p  ?>);"><?php echo $p ?></a>
                              </li>
                        <?php
                        } else {
                        ?>
                              <li class="page-item">
                                    <a class="page-link" href="javascript:void(0);" onclick="searchAssignmentMark(<?php echo $p ?>);"><?php echo $p ?></a>
                              </li>
                        <?php
                        }
                  }
                  if ($no_of_page != $page && $no_of_page != 0) {
                        ?>
                        <li class="page-item next">
                              <a class="page-link" href="javascript:void(0);" onclick="searchAssignmentMark(<?php echo $page + 1 ?>);"><i class="tf-icon bx bx-chevrons-right"></i></a>
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
