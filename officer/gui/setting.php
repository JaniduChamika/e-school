<?php
session_start();
require "../../connection/connection.php";

if (isset($_SESSION["officer"])) {

?>
      <!DOCTYPE html>

      <html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

      <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

            <title>Officer | Setting</title>

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
                              require "officerSidebar.php";
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
                                          <div class="row px-3">


                                                <div class="card mb-4">
                                                      <h5 class="card-header">Account Settings</h5>
                                                      <!-- Account -->
                                                      <div class="card-body">
                                                            <div class="row">
                                                                  <div class="col-12">
                                                                        <div class="row">
                                                                              <div class="col-6 col-lg-3">
                                                                                    Application Theam

                                                                              </div>
                                                                              <?php
                                                                              $isdark = DB::search("SELECT * FROM `dark_theam` WHERE `user_uid`='" . $_SESSION["officer"]["uid"] . "'");
                                                                              if ($isdark->num_rows == 1) {
                                                                              ?>
                                                                                    <div class="col-3 col-lg-2 form-check">
                                                                                          <input class="form-check-input" name="theam" onchange="Lighttheam('officer');" type="radio" id="lighttheam">
                                                                                          <label class="form-check-label" for="lighttheam"> Light </label>

                                                                                    </div>
                                                                                    <div class="col form-check">
                                                                                          <input class="form-check-input" name="theam" onchange="darktheam('officer');" type="radio" id="darktheam" checked>
                                                                                          <label class="form-check-label" for="darktheam"> Dark </label>

                                                                                    </div>
                                                                              <?php
                                                                              } else {
                                                                              ?>
                                                                                    <div class="col-3 col-lg-2 form-check">
                                                                                          <input class="form-check-input" name="theam" onchange="Lighttheam('officer');" type="radio" id="lighttheam" checked>
                                                                                          <label class="form-check-label" for="lighttheam"> Light </label>

                                                                                    </div>
                                                                                    <div class="col form-check">
                                                                                          <input class="form-check-input" name="theam" onchange="darktheam('officer');" type="radio" id="darktheam">
                                                                                          <label class="form-check-label" for="darktheam"> Dark </label>

                                                                                    </div>
                                                                              <?php
                                                                              }
                                                                              ?>
                                                                        </div>
                                                                        <div class="row pt-2">
                                                                              <div class="col-6 col-lg-3">
                                                                                    Two step verification

                                                                              </div>

                                                                              <div class="col form-check form-switch mb-2">
                                                                                    <?php
                                                                                    $user = DB::search("SELECT * FROM `user` WHERE `uid`='" . $_SESSION["officer"]["uid"] . "'");
                                                                                    if ($user->num_rows == 1) {
                                                                                          $userD = $user->fetch_assoc();
                                                                                          if ($userD["tsv_status"] == 1) {
                                                                                    ?>

                                                                                                <input class="form-check-input" type="checkbox" onchange="twoStepVerify('officer');" id="verifiyid" checked="">
                                                                                                <label class="form-check-label" for="verifiyid">ON</label>
                                                                                          <?php
                                                                                          } else {
                                                                                          ?>

                                                                                                <input class="form-check-input" type="checkbox" onchange="twoStepVerify('officer');" id="verifiyid">
                                                                                                <label class="form-check-label" for="verifiyid">OFF</label>
                                                                                    <?php
                                                                                          }
                                                                                    }
                                                                                    ?>
                                                                              </div>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                      </div>

                                                </div>
                                                <div class="card">
                                                      <h5 class="card-header">Change Password</h5>
                                                      <div class="card-body">
                                                            <div class="row">
                                                                  <div class="mb-0 col-md-6">
                                                                        <label for="currpasswod" class="form-label">Current Password</label>
                                                                        <input class="form-control" type="password" id="currpasswod" placeholder="Enter you current password">
                                                                        <div class="form-text text-danger" id="errorid1">
                                                                        </div>
                                                                  </div>
                                                                  <div class="mb-0  col-md-6">
                                                                        <label for="newpws" class="form-label">New Password</label>
                                                                        <input class="form-control" type="password" id="newpws" placeholder="Enter you new password">
                                                                        <div class="form-text text-danger" id="errorid2">
                                                                        </div>
                                                                  </div>
                                                                  <div class="mb-0  col-md-6">
                                                                        <label for="Cnewpws" class="form-label">Comfirm New Password</label>
                                                                        <input class="form-control" type="password" id="Cnewpws" placeholder="Enter you comfirm password">
                                                                        <div class="form-text text-danger" id="errorview">
                                                                        </div>
                                                                  </div>
                                                                  <div class="col-12 text-end">
                                                                        <button type="submit" class="btn btn-info " onclick="resetPws('officer');">Save</button>

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
} else {
?>
      <script>
            window.location = "../../login/gui/officer-login.php";
      </script>
<?php
}
?>