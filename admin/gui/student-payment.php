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

            <title>Admin | Student Payment</title>

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
                                                <div class="col-12 ">
                                                      <div class="card mb-3">

                                                            <div class="card-body">

                                                                  <div class="row">
                                                                        <div class="col-8">
                                                                              <h5 class="card-title">Student Enrollment Fee</h5>

                                                                        </div>
                                                                        <div class="col-6  col-md-4 col-lg-3  ms-auto me-0">
                                                                              <select id="selectgrade" onchange="searchStudentEnrolment(1);" class="form-select">
                                                                                    <option value="0">Select Grade</option>
                                                                              <!-- load grades from db  -->
                                                                                    <?php

                                                                                    $reult = DB::search("SELECT * FROM `grade`");

                                                                                    for ($i = 0; $i < $reult->num_rows; $i++) {
                                                                                          $d = $reult->fetch_assoc();
                                                                                    ?>
                                                                                          <option value="<?php echo $d["gid"] ?>"><?php echo $d["gname"] ?></option>
                                                                                    <?php
                                                                                    }
                                                                                    ?>

                                                                              </select>
                                                                        </div>
                                                                        <div class="card shadow-none" id="tableBox">

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
                                                                                                $page = 1;
                                                                                                $number_per_page = 10;
                                                                                                $offset = ($page - 1) * $number_per_page;
                                                                                                $pagination = DB::search("SELECT `student_payment`.`total`,`student_payment`.`pay_dtime`,`grade`.`gname`,`students`.`username`,`students`.`fulname` FROM `student_payment` INNER JOIN `grade` ON `student_payment`.`grade_gid`=`grade`.`gid` INNER JOIN `students` ON `student_payment`.`user_uid`=`students`.`uid`");
                                                                                                $no_rows = $pagination->num_rows;
                                                                                                $no_of_page = $no_rows / $number_per_page;
                                                                                                if ($no_rows % $number_per_page != 0) {
                                                                                                      $no_of_page = $no_of_page + 1;
                                                                                                }

                                                                                                $no_of_page = intval($no_of_page);
                                                                                                $stuFee = DB::search("SELECT `student_payment`.`total`,`student_payment`.`pay_dtime`,`grade`.`gname`,`students`.`username`,`students`.`fulname` FROM `student_payment` INNER JOIN `grade` ON `student_payment`.`grade_gid`=`grade`.`gid` INNER JOIN `students` ON `student_payment`.`user_uid`=`students`.`uid` LIMIT $number_per_page OFFSET $offset");
                                                                                                for ($i = 0; $i < $stuFee->num_rows; $i++) {
                                                                                                      $d = $stuFee->fetch_assoc();
                                                                                                ?>

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
                                                                                          if ($no_of_page != $page && $no_of_page!=0) {
                                                                                                ?>
                                                                                                <li class="page-item next">
                                                                                                      <a class="page-link" href="javascript:void(0);" onclick="searchStudentEnrolment(<?php echo $page + 1 ?>);"><i class="tf-icon bx bx-chevrons-right"></i></a>
                                                                                                </li>
                                                                                          <?php
                                                                                          }
                                                                                          ?>
                                                                                    </ul>
                                                                              </nav>
                                                                        </div>
                                                                  </div>


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