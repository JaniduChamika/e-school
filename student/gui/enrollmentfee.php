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

                  <title>Student | Enrollment Fee</title>

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
                                                                                    <h5 class="card-title">Enrollment Fee</h5>

                                                                              </div>

                                                                              <div class="table-responsive text-nowrap" style="max-height: 675px;">
                                                                                    <table class="table table-borderless">
                                                                                          <thead>
                                                                                                <tr>
                                                                                                     
                                                                                                      <th>Title</th>

                                                                                                      <th>Paid Date</th>
                                                                                                      <th>Fee</th>

                                                                                                      <th>Status</th>

                                                                                                </tr>
                                                                                          </thead>
                                                                                          <tbody>
                                                                                                <?php
                                                                                              
                                                                                                $stuFee = DB::search("SELECT `student_payment`.`total`,`student_payment`.`pay_dtime`,`grade`.`gname`,`students`.`username`,`students`.`fulname` FROM `student_payment` INNER JOIN `grade` ON `student_payment`.`grade_gid`=`grade`.`gid` INNER JOIN `students` ON `student_payment`.`user_uid`=`students`.`uid` WHERE `user_uid`='".$_SESSION["student"]["uid"]."'");
                                                                                                for ($i = 0; $i < $stuFee->num_rows; $i++) {
                                                                                                      $payd = $stuFee->fetch_assoc();
                                                                                                ?>

                                                                                                      <tr>
                                                                                                            
                                                                                                            <td>Grade <?php echo $payd["gname"] ?> Fee</td>
                                                                                                            <td><?php echo $payd["pay_dtime"] ?></td>
                                                                                                            <td><?php echo $payd["total"] ?></td>

                                                                                                            <td><span class="badge bg-label-success me-1">Paid</span></td>

                                                                                                      </tr>
                                                                                                <?php
                                                                                                }
                                                                                                ?>



                                                                                          </tbody>
                                                                                    </table>
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