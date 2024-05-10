<?php
session_start();
require "../connection/connection.php";

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

      if ($_SESSION["pay_status"] == "notPaid") {
?>
            <!DOCTYPE html>


            <html lang="en">

            <head>
                  <meta charset="utf-8" />
                  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

                  <title>Enrollment Fee</title>

                  <meta name="description" content="" />

                  <!-- Favicon -->
                  <link rel="icon" type="image/x-icon" href="../assets/img/favicon/favicon.ico" />


                  <!-- Core CSS -->
                  <link rel="stylesheet" href="../assets/vendor/css/core.css" class="template-customizer-core-css" />
                  <link rel="stylesheet" href="../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />

                  <link rel="stylesheet" href="../assets/vendor/fonts/boxicons.css" />

                  <link rel="stylesheet" href="../css/trial.css" />


            </head>

            <body>

                  <div class="card free-trial-popup d-flex justify-content-center align-items-center">

                        <div class="trial-popup-section bg-white col-10 col-sm-8 col-md-7 col-lg-5 d-flex flex-column justify-content-center align-items-center " id="viewbox">
                              <a href="index.html" class="app-brand-link gap-2">
                                    <span class="app-brand-logo demo">
                                          <img src="../image/logo/logo.png" width="38" />
                                          <!-- logo  -->
                                    </span>
                                    <span class="app-brand-text demo text-body fw-bolder fs-3">E-School </span>
                              </a>
                              <i class="fas fa-times align-self-end cross-icon"></i>

                              <h3 class="trial-popup-heading font-weight-bold text-center">Enrollment Fee payment</h3>
                              <p class="trial-text text-center">The 1 month trial period is ended. if your hope to login your portal you have to pay the student enrollment fee according to your grade. Thank You! </p>

                              <button class="btn btn-warning mt-2" onclick="payEnrollmentFee();">Pay Enrollment Fee</button>

                        </div>

                        <div id="card_container"></div>
                        <div class="container d-none" id="paysuccesBox">
                              <div class="row">
                                    <div class="col-md-6 mx-auto mt-5">
                                          <div class="payment">
                                                <div class="payment_header">
                                                      <div class="check "><i class='bx bx-check fw-bold fs-1'></i></div>
                                                </div>
                                                <div class="content">
                                                      <h1>Payment Success !</h1>
                                                      <a href="../student/gui/dashboard.php">Go to Portal</a>
                                                </div>

                                          </div>
                                    </div>
                              </div>
                        </div>
                  </div>

            </body>
            <script src="https://cdn.directpay.lk/dev/v1/directpayCardPayment.js?v=1"></script>
            <script src="../js/payment.js"></script>

            </html>
      <?php
      } else if ($_SESSION["pay_status"] == "selectTrial") {
      ?>
            <script>
                  window.location = "trial.php";
            </script>
      <?php
      } else if ($_SESSION["pay_status"] == "paid" || $_SESSION["pay_status"] == "trial") {
      ?>
            <script>
                  window.location = "../student/gui/dashboard.php";
            </script>
      <?php
      }
} else {
      ?>
      <script>
            window.location = "../login/gui/student-login.php";
      </script>
<?php
}
?>