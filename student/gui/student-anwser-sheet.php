<?php
session_start();
require "../../connection/connection.php";

if (isset($_SESSION["student"])) {
      $day = new DateTime();
      $tz = new DateTimeZone("Asia/Colombo");
      $day->setTimezone($tz);
      $date = $day->format("Y-m-d");
      // search student is paid his enrollment fee for his latest grade start
      $stu = DB::search("SELECT * FROM `students` WHERE `uid`='" . $_SESSION["student"]["uid"] . "'");
      $stuD = $stu->fetch_assoc();
      $ispaid = DB::search("SELECT * FROM `student_payment` WHERE `user_uid`='" . $_SESSION["student"]["uid"] . "' AND `grade_gid`='" . $stuD["gid"] . "'");
      if ($ispaid->num_rows == 1) {

            $_SESSION["pay_status"] = "paid";
      } else {
            $istrial = DB::search("SELECT * FROM `trial_period` WHERE `user_uid`='" . $_SESSION["student"]["uid"] . "'");
            if ($istrial->num_rows == 1) {
                  $tirald = $istrial->fetch_assoc();
                  // check different trail start date and today 
                  $date1 = date_create($date);
                  $date2 = date_create($tirald["start_date"]);
                  $diff = date_diff($date1, $date2);
                  $duration = $diff->format("%a");
                  if ($duration > 30) {
                        $_SESSION["pay_status"] = "notPaid";
                  } else {
                        $_SESSION["pay_status"] = "trial";
                  }
            } else {
                  $_SESSION["pay_status"] = "selectTrial";
            }
      }
      // search student is paid his enrollment fee for his latest grade end

      if ($_SESSION["pay_status"] == "paid" || $_SESSION["pay_status"] == "trial") {

?>
            <!DOCTYPE html>

            <html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

            <head>
                  <meta charset="utf-8" />
                  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

                  <title>Student | Student Answer Sheets </title>

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
                                    require "studentSidebar.php";
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
                                                                                    <h5 class="card-title">Student Answer Sheets (Not Checked)</h5>

                                                                              </div>
                                                                              <div class="col-4 text-end">
                                                                                    <a class="card-title cursor-pointer text-black" href="#" onclick="refresh();"><i class='bx bx-refresh'></i> Refresh</a>

                                                                              </div>
                                                                        </div>
                                                                        <div class="row">
                                                                              <!-- <div class="d-none d-md-block col-md-4 col-lg-2">
                                                                        <label class="btn btn-outline-warning " id="previewchecked" for="pendingbtn">Not Checked</label>
                                                                        <input type="checkbox" class="btn-check " onchange="checkedinput();" id="pendingbtn">
                                                                  </div> -->
                                                                              <div class="col-6  col-md-4 col-lg-3  ms-auto me-0">
                                                                                    <select id="selectgrade" class="form-select">
                                                                                          <option>Select Grade</option>
                                                                                          <option value="12">Twelve</option>
                                                                                          <option value="13">Thirteen</option>

                                                                                    </select>
                                                                              </div>
                                                                              <div class="col-6  col-md-4 col-lg-3">

                                                                                    <select id="selectAL" class="form-select">
                                                                                          <option>Select Subject</option>
                                                                                          <option value="1">One</option>
                                                                                          <option value="2">Two</option>
                                                                                          <option value="3">Three</option>
                                                                                    </select>
                                                                              </div>
                                                                        </div>

                                                                        <div class="card shadow-none">
                                                                              <!-- <h5 class="card-header">Teachers Database</h5> -->


                                                                              <div class="table-responsive text-nowrap mb-4 scrollbar" style="min-height: 550px;max-height: 550px;">
                                                                                    <table class="table table-hover expandable-table">
                                                                                          <thead>
                                                                                                <tr>
                                                                                                      <th class="ps-3">#</th>
                                                                                                      <th class="ps-3">Assignment ID </th>
                                                                                                      <th class="ps-3">Subject</th>
                                                                                                      <th class="ps-3">Student Username</th>

                                                                                                      <th class="ps-3">Submitted Date</th>



                                                                                                      <th class="ps-2">Actions</th>
                                                                                                </tr>
                                                                                          </thead>
                                                                                          <tbody class="table-border-bottom-0 ">
                                                                                                <?php
                                                                                                for ($i = 0; $i < 4; $i++) {
                                                                                                ?>
                                                                                                      <tr>
                                                                                                            <td>1</td>

                                                                                                            <td>
                                                                                                                  <span class="fw-bold text-capitalize">MA/13/0001</span>
                                                                                                            </td>
                                                                                                            <td>Combine maths</td>

                                                                                                            <td>
                                                                                                                  Janiduc hami
                                                                                                            </td>

                                                                                                            <td>20022/09/01</td>




                                                                                                            <td>
                                                                                                                  <div class="dropdown">
                                                                                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                                                                              <i class="bx bx-dots-vertical-rounded"></i>
                                                                                                                        </button>
                                                                                                                        <div class="dropdown-menu">

                                                                                                                              <a class="dropdown-item" href="javascript:void(0);"><i class='bx bx-show-alt'></i> View Answer Sheet</a>
                                                                                                                              <a class="dropdown-item" href="javascript:void(0);"><i class='bx bx-plus'></i> Add Marks</a>
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
                                                                                          <li class="page-item prev">
                                                                                                <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-left"></i></a>
                                                                                          </li>
                                                                                          <li class="page-item">
                                                                                                <a class="page-link" href="javascript:void(0);">1</a>
                                                                                          </li>
                                                                                          <li class="page-item">
                                                                                                <a class="page-link" href="javascript:void(0);">2</a>
                                                                                          </li>
                                                                                          <li class="page-item active">
                                                                                                <a class="page-link" href="javascript:void(0);">3</a>
                                                                                          </li>
                                                                                          <li class="page-item">
                                                                                                <a class="page-link" href="javascript:void(0);">4</a>
                                                                                          </li>
                                                                                          <li class="page-item">
                                                                                                <a class="page-link" href="javascript:void(0);">5</a>
                                                                                          </li>
                                                                                          <li class="page-item next">
                                                                                                <a class="page-link" href="javascript:void(0);"><i class="tf-icon bx bx-chevrons-right"></i></a>
                                                                                          </li>
                                                                                    </ul>
                                                                              </nav>
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

            </body>

            </html>
      <?php
      } else if ($_SESSION["pay_status"] == "notPaid") {
      ?>
            <script>
                  window.location = "../../misc/payment.php";
            </script>
      <?php
      } else if ($_SESSION["pay_status"] == "selectTrial") {
      ?>
            <script>
                  window.location = "../../misc/trial.php";
            </script>
      <?php
      }
} else {
      ?>
      <script>
            window.location = "../../login/gui/student-login.php";
      </script>
<?php
}
?>