<?php
session_start();
require "../../connection/connection.php";

// check admin is loged 
if (isset($_SESSION["admin"])) {

?>
      <!DOCTYPE html>

      <html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

      <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

            <title>Admin | A/L Class List</title>

            <?php
            require "headLink.php";
            ?>

      </head>

      <body>
            <!-- Layout wrapper -->
            <div class="layout-wrapper layout-content-navbar">
                  <div class="layout-container">
                        <!-- Menu -->

                        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

                              <?php
                              require "adminSidebar.php";
                              ?>

                        </aside>
                        <!-- / Menu -->

                        <!-- Layout container -->
                        <div class="layout-page">
                              <!-- Navbar -->

                              <?php
                              require "navbar.php";
                              ?>
                              <!-- / Navbar -->

                              <!-- Content wrapper -->
                              <div class="content-wrapper">
                                    <!-- Content -->

                                    <div class="container-xxl flex-grow-1 container-p-y">
                                          <div class="row">









                                                <!-- grade 12-13 -->
                                                <div class="col-12 ">
                                                      <div class="card mb-4">
                                                            <h5 class="card-header pb-2">Grades 12-13 Classes (A/L)</h5>
                                                            <div class="row px-4">

                                                                  <div class="col-6  col-md-4 col-lg-3  ms-auto me-0">
                                                                        <select id="selectgrade" onchange="searchClass1213(1);" class="form-select">
                                                                              <option value="0">Select Grade</option>
                                                                              <!-- load grades from db  -->
                                                                              <?php

                                                                              $reult = DB::search("SELECT * FROM `grade` WHERE `gname` IN (12,13)");

                                                                              for ($i = 0; $i < $reult->num_rows; $i++) {
                                                                                    $d = $reult->fetch_assoc();
                                                                              ?>
                                                                                    <option value="<?php echo $d["gname"] ?>"><?php echo $d["gname"] ?></option>
                                                                              <?php
                                                                              }
                                                                              ?>
                                                                        </select>
                                                                  </div>
                                                                  <div class="col-6  col-md-4 col-lg-3  ">
                                                                        <select id="selectAlstream" onchange="searchClass1213(1);" class="form-select">
                                                                        <option value="0">Select A/L Stream</option>
                                                                              <?php

                                                                              $reult = DB::search("SELECT * FROM `al_stream`");

                                                                              for ($i = 0; $i < $reult->num_rows; $i++) {
                                                                                    $d = $reult->fetch_assoc();
                                                                              ?>
                                                                                    <option value="<?php echo $d["stream_name"] ?>"><?php echo $d["stream_name"] ?></option>
                                                                              <?php
                                                                              }
                                                                              ?>
                                                                        </select>
                                                                  </div>
                                                            </div>
                                                            <div class="card-body  pt-1" id="tableBox">

                                                                  <div class="table-responsive text-nowrap overflow-auto scrollbar mb-4" style="min-height: 550px; max-height: 560px;">
                                                                        <table class="table table-hover">
                                                                              <thead>
                                                                                    <tr>
                                                                                          <th class="text-xxl-center">Class Name</th>
                                                                                          <th>A/L Stream</th>
                                                                                          <th>Medium</th>

                                                                                          <th>Class Teacher</th>
                                                                                          <th class="text-center">No Of Student</th>

                                                                                          <th class="text-center">Actions</th>

                                                                                    </tr>
                                                                              </thead>
                                                                              <tbody class="table-border-bottom-0">
                                                                                    <?php


                                                                                    $page = 1;
                                                                                    $number_per_page = 10;
                                                                                    $offset = ($page - 1) * $number_per_page;
                                                                                    $pagination = DB::search("SELECT * FROM `allclass` WHERE `grade` IN (12,13)");
                                                                                    $no_rows = $pagination->num_rows;
                                                                                    $no_of_page = $no_rows / $number_per_page;
                                                                                    if ($no_rows % $number_per_page != 0) {
                                                                                          $no_of_page = $no_of_page + 1;
                                                                                    }

                                                                                    $no_of_page = intval($no_of_page);

                                                                                    $reult = DB::search("SELECT * FROM `allclass` WHERE `grade` IN (12,13) ORDER BY `clz_name` ASC LIMIT $number_per_page OFFSET $offset");

                                                                                    for ($i = 0; $i <  $reult->num_rows; $i++) {
                                                                                          $d = $reult->fetch_assoc();
                                                                                          // get number of student in class 
                                                                                          $nostu = DB::search("SELECT COUNT(`class_id`) AS `no_stu`  FROM student_has_class WHERE `class_id`='" . $d["clz_id"] . "' ");
                                                                                          $stud = $nostu->fetch_assoc();
                                                                                    ?>
                                                                                          <tr>
                                                                                                <td class="text-xxl-center"><?php echo $d["clz_name"] ?></td>
                                                                                                <td><?php echo $d["al_stream"] ?></td>
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
                                                                                          <a class="page-link" href="javascript:void(0);" onclick="searchClass1213(<?php echo $page - 1 ?>);"><i class="tf-icon bx bx-chevrons-left"></i></a>
                                                                                    </li>
                                                                                    <?php
                                                                              }

                                                                              for ($p = 1; $p <= $no_of_page; $p++) {
                                                                                    if ($page == $p) {
                                                                                    ?>
                                                                                          <li class="page-item active">
                                                                                                <a class="page-link" href="javascript:void(0);" onclick="searchClass1213(<?php echo $p  ?>);"><?php echo $p ?></a>
                                                                                          </li>
                                                                                    <?php
                                                                                    } else {
                                                                                    ?>
                                                                                          <li class="page-item">
                                                                                                <a class="page-link" href="javascript:void(0);" onclick="searchClass1213(<?php echo $p ?>);"><?php echo $p ?></a>
                                                                                          </li>
                                                                                    <?php
                                                                                    }
                                                                              }
                                                                              if ($no_of_page != $page && $no_of_page!=0 && $no_of_page != 0) {
                                                                                    ?>
                                                                                    <li class="page-item next">
                                                                                          <a class="page-link" href="javascript:void(0);" onclick="searchClass1213(<?php echo $page + 1 ?>);"><i class="tf-icon bx bx-chevrons-right"></i></a>
                                                                                    </li>
                                                                              <?php
                                                                              }
                                                                              ?>
                                                                        </ul>
                                                                  </nav>
                                                            </div>




                                                      </div>

                                                </div>
                                                <!-- grade 12-13 -->

                                          </div>
                                          <div class="modal fade" id="myModelID" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog">
                                                <div class="modal-dialog">
                                                      <form class="modal-content">
                                                            <div class="modal-header">
                                                                  <h5 class="modal-title" id="backDropModalTitle">Change Teacher</h5>
                                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                  <div class="row">
                                                                        <div class="col mb-3">
                                                                              <label for="editdate" class="form-label">Assign Teacher</label>
                                                                              <div class="input-group">
                                                                                    <select id="Assigntecher" class="form-select">
                                                                                          <option value="0">Select Teacher</option>
                                                                                          <?php
                                                                                          $result = DB::search("SELECT * FROM `user`  WHERE user.uid IN ( SELECT DISTINCT `user_uid` FROM  teacher_has_grade  INNER JOIN grade ON teacher_has_grade.grade_gid= grade.gid WHERE grade.gname IN (12,13)) ");
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
                                                                                          ?>
                                                                                    </select>
                                                                              </div>
                                                                        </div>
                                                                  </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                        Close
                                                                  </button>
                                                                  <button type="button" class="btn btn-info" id="submitBtn">Assign</button>
                                                            </div>
                                                      </form>
                                                </div>
                                          </div>
                                          <div class="modal fade" id="renameModelID" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog">
                                                <div class="modal-dialog">
                                                      <form class="modal-content">
                                                            <div class="modal-header">
                                                                  <h5 class="modal-title" id="renametitle" >Rename Class</h5>
                                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                  <div class="row">
                                                                        <div class="col mb-3">
                                                                              <label for="renameclass" class="form-label">Class Name</label>
                                                                              <div class="input-group">
                                                                                   <input type="text" id="renameclass" placeholder="Enter new class name" class="form-control"/>
                                                                              </div>
                                                                        </div>
                                                                  </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                        Close
                                                                  </button>
                                                                  <button type="button" class="btn btn-info" id="renameBtn">Rename</button>
                                                            </div>
                                                      </form>
                                                </div>
                                          </div>
                                          <div class="modal fade " id="delteMod" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered">
                                                      <div class="modal-content">
                                                            <div class="modal-header">
                                                                  <h5 class="modal-title" id="modalToggleLabel">Confirmation</h5>
                                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body"> Are your sure you want to delete this class?</div>
                                                            <div class="modal-footer">
                                                                  <button class="btn btn-secondary" data-bs-target="#modalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">
                                                                        No
                                                                  </button>
                                                                  <button class="btn btn-danger" id="deletebtn">
                                                                        Yes
                                                                  </button>
                                                            </div>
                                                      </div>
                                                </div>
                                          </div>
                                    </div>
                                    <!-- / Content -->

                                    <!-- Footer -->
                                    <footer class="content-footer footer bg-footer-theme">
                                          <?php
                                          require "footer.php";
                                          ?>
                                    </footer>
                                    <!-- / Footer -->

                                    <div class="content-backdrop fade"></div>
                              </div>
                              <!-- Content wrapper -->
                        </div>
                        <!-- / Layout page -->
                  </div>

                  <!-- Overlay -->
                  <div class="layout-overlay layout-menu-toggle"></div>
            </div>
            <!-- / Layout wrapper -->



            <!-- Core JS -->
            <!-- build:js assets/vendor/js/core.js -->
            <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
            <script src="../../assets/vendor/libs/popper/popper.js"></script>
            <script src="../../assets/vendor/js/bootstrap.js"></script>
            <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>

            <script src="../../assets/vendor/js/menu.js"></script>
            <!-- endbuild -->


            <!-- Main JS -->
            <script src="../../assets/js/main.js"></script>


            <!-- Place this tag in your head or just before your close body tag. -->
            <script async defer src="https://buttons.github.io/buttons.js"></script>

            <!-- my java script  -->
            <script src="../../js/script.js"></script>
            <script src="../js/admin.js"></script>

      </body>

      </html>
<?php
} else {
?>
      <script>
            window.location = "../../login/gui/admin-login.php";
      </script>
<?php
}
?>