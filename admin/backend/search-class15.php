<?php
require "../../connection/connection.php";

if (isset($_POST["page"])) {
      $page = $_POST["page"];
      $grade = $_POST["g"];
      $word = $_POST["word"];
?>


      <div class="table-responsive text-nowrap mb-4  overflow-auto scrollbar " style="min-height: 550px; max-height: 560px;">
            <table class="table table-hover">
                  <thead>
                        <tr>
                              <th class="text-xxl-center">Class Name</th>
                              <th>Medium</th>

                              <th>Class Teacher</th>
                              <th class="text-center">No Of Student</th>

                              <th class="text-center">Actions</th>

                        </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                        <?php
                        // search 1-5 class 
                        $q = "SELECT * FROM `allclass` WHERE";
                        if ($grade != "0") {
                              $q = $q . "`grade` = '" . $grade . "'";
                        } else {
                              $q = $q . " `grade` IN (1,2,3,4,5) ";
                        }
                        if (!empty($word)) {
                              // search class by class name or teacher name 
                              $q = $q . " AND (`clz_name` LIKE '" . $word . "%' OR `teacher` LIKE '%" . $word . "%')";
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

                        $reult = DB::search($q . " ORDER BY `clz_name` ASC LIMIT $number_per_page OFFSET $offset");


                        for ($i = 0; $i <  $reult->num_rows; $i++) {
                              $d = $reult->fetch_assoc();
                              // get number of student in class 
                              $nostu = DB::search("SELECT COUNT(`class_id`) AS `no_stu`  FROM student_has_class WHERE `class_id`='" . $d["clz_id"] . "' ");
                              $stud = $nostu->fetch_assoc();
                        ?>
                              <!-- load class details  -->
                              <tr>
                                    <td class="text-xxl-center"><?php echo $d["clz_name"] ?></td>
                                    <th><?php echo $d["medium"] ?></th>

                                    <td><?php echo $d["teacher"] ?></td>
                                    <th class="text-center"><?php echo $stud["no_stu"] ?></th>

                                    <td class="text-center">
                                          <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                      <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">

                                                      <a class="dropdown-item" href="#" onclick="changeModelTitle('Change Teacher (Grade <?php echo $d['clz_name'] ?>)');showModel(<?php echo $d['clz_id'] ?>, 'ch-teacher',<?php echo $d['grade'] ?>);"><i class="bx bx-edit-alt me-1"></i>Change Teacher</a>
                                                      <a class="dropdown-item" href="#" onclick="renameModal(<?php echo $d['clz_id'] ?>,'<?php echo $d['clz_name'] ?>',<?php echo $d['grade'] ?>);"><i class='bx bx-rename'></i> Rename</a>
                                                      <a class="dropdown-item" href="#" onclick="comfirmClzDelete(<?php echo $d['clz_id'] ?>,<?php echo $d['grade'] ?>);"><i class="bx bx-trash me-1"></i> Delete</a>
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
                              <a class="page-link" href="javascript:void(0);" onclick="searchClass15(<?php echo $page - 1 ?>);"><i class="tf-icon bx bx-chevrons-left"></i></a>
                        </li>
                        <?php
                  }

                  for ($p = 1; $p <= $no_of_page; $p++) {
                        if ($page == $p) {
                        ?>
                              <li class="page-item active">
                                    <a class="page-link" href="javascript:void(0);" onclick="searchClass15(<?php echo $p  ?>);"><?php echo $p ?></a>
                              </li>
                        <?php
                        } else {
                        ?>
                              <li class="page-item">
                                    <a class="page-link" href="javascript:void(0);" onclick="searchClass15(<?php echo $p ?>);"><?php echo $p ?></a>
                              </li>
                        <?php
                        }
                  }
                  if ($no_of_page != $page && $no_of_page != 0) {
                        ?>
                        <li class="page-item next">
                              <a class="page-link" href="javascript:void(0);" onclick="searchClass15(<?php echo $page + 1 ?>);"><i class="tf-icon bx bx-chevrons-right"></i></a>
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
