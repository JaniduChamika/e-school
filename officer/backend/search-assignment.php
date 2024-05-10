<?php
session_start();
require "../../connection/connection.php";
if (isset($_POST["page"])) {
      $page = $_POST["page"];
      $day = new DateTime();
      $tz = new DateTimeZone("Asia/Colombo");
      $day->setTimezone($tz);
      $date = $day->format("Y-m-d");
      $grade = $_POST["g"];
      $sub = $_POST["s"];
      $act = $_POST["a"];
      $word = $_POST["word"];
?>

      <div class="table-responsive text-nowrap mb-4 scrollbar" style="min-height: 550px;max-height: 550px;">
            <table class="table table-hover expandable-table">
                  <thead>
                        <tr>
                              <th class="ps-3">#</th>
                              <th class="ps-3">Assignment ID </th>
                              <th class="ps-3">Assignment Title</th>
                              <th class="ps-3">Subject</th>
                              <th class="ps-3">Grade</th>
                              <th class="ps-3">Teacher Name</th>

                              <th class="ps-3">Start Date</th>
                              <th class="ps-3">End Date</th>
                              <th class="ps-3">Status</th>

                              <th class="ps-2">Actions</th>
                        </tr>
                  </thead>
                  <tbody class="table-border-bottom-0 ">
                        <?php
                        // search assignment from assingment_view 
                        $q = "SELECT * FROM `assingment_view`";
                        $q1 = "`gid` ='" . $grade . "'";
                        $q2 = "`sub_id`='" . $sub . "'";
                        $q3 = "`start_date`<='" . $date . "' and `end_date`>='" . $date . "'";
                        // search assignment by assignmnet id, title,subject name or teacher name 
                        if (!empty($word)) {
                              $q = $q . " WHERE (`assignment_id` LIKE '" . $word . "%' OR `title` LIKE '" . $word . "%' OR `sub_name` LIKE '" . $word . "%' OR `fulname` LIKE '%" . $word . "%')";
                              if ($grade != "0" || $sub != "0" || $act == "true") {
                                    $q = $q . "AND";
                              }
                        } else {
                              if ($grade != "0" || $sub != "0" || $act == "true") {
                                    $q = $q . "WHERE";
                              }
                        }
                        // fileter part with grade,subject or active assignment 
                        if ($grade != "0" && $sub != "0" && $act == "true") {
                              $q = $q . $q1 . " AND " . $q2 . " AND " . $q3;
                        } else if ($grade == "0" && $sub != "0" && $act == "true") {
                              $q = $q  . $q2 . " AND " . $q3;
                        } else if ($grade != "0" && $sub == "0" && $act == "true") {
                              $q = $q . $q1 . " AND " . $q3;
                        } else if ($grade != "0" && $sub != "0" && $act != "true") {
                              $q = $q . $q1 . " AND " . $q2;
                        } elseif ($grade != "0") {
                              $q = $q . $q1;
                        } elseif ($sub != "0") {
                              $q = $q . $q2;
                        } elseif ($act == "true") {
                              $q = $q . $q3;
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
                              <!-- load data to table  -->
                              <tr>
                                    <td><?php echo $i + 1 + $offset ?></td>

                                    <td>
                                          <span class="fw-bold text-capitalize"><?php echo $d["assignment_id"]; ?></span>
                                    </td>
                                    <td><?php echo $d["title"]; ?></td>
                                    <td class="ps-3"><?php echo $d["sub_name"]; ?></td>
                                    <td class="ps-3"><?php echo $d["gname"]; ?></td>
                                    <td class="ps-3"><?php
                                                      if ($d["gender_gid"] == 1) {
                                                            echo "Mr. " . $d["fulname"];
                                                      } else {
                                                            echo "Mrs. " . $d["fulname"];
                                                      }
                                                      ?></td>
                                    <td><?php echo $d["start_date"]; ?></td>
                                    <td><?php echo $d["end_date"]; ?></td>
                                    <td class="ps-3">
                                          <?php
                                          if ($date < $d["start_date"]) {
                                          ?>
                                                <span class="badge bg-label-warning me-1">Pending</span>

                                          <?php
                                          } else if ($date >= $d["start_date"] && $date <= $d["end_date"]) {

                                          ?>
                                                <span class="badge bg-label-success me-1">Active</span>
                                          <?php
                                          } else {
                                          ?>
                                                <span class="badge bg-label-secondary me-1">End</span>

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

                                                      <a class="dropdown-item" href="../../doc/assignment/<?php echo $d["file_path"]  ?>" target="_blank"><i class='bx bx-show-alt'></i> View</a>


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
                              <a class="page-link" href="javascript:void(0);" onclick="searchAssignment(<?php echo $page - 1 ?>);"><i class="tf-icon bx bx-chevrons-left"></i></a>
                        </li>
                        <?php
                  }

                  for ($p = 1; $p <= $no_of_page; $p++) {
                        if ($page == $p) {
                        ?>
                              <li class="page-item active">
                                    <a class="page-link" href="javascript:void(0);" onclick="searchAssignment(<?php echo $p  ?>);"><?php echo $p ?></a>
                              </li>
                        <?php
                        } else {
                        ?>
                              <li class="page-item">
                                    <a class="page-link" href="javascript:void(0);" onclick="searchAssignment(<?php echo $p ?>);"><?php echo $p ?></a>
                              </li>
                        <?php
                        }
                  }
                  if ($no_of_page != $page && $no_of_page != 0) {
                        ?>
                        <li class="page-item next">
                              <a class="page-link" href="javascript:void(0);" onclick="searchAssignment(<?php echo $page + 1 ?>);"><i class="tf-icon bx bx-chevrons-right"></i></a>
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
