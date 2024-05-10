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

            <title>Admin | Set Enrollment Fee</title>

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
                                                <div class="col-12 col-md-6">

                                                      <div class="card mb-3">

                                                            <div class="card-body">

                                                                  <div class="row">
                                                                        <div class="col-8">
                                                                              <h5 class="card-title">Student Enrollment Fee</h5>

                                                                        </div>

                                                                        <div class="card shadow-none">

                                                                              <div class="table-responsive text-nowrap pb-4" style="max-height: 675px;">
                                                                                    <table class="table table-hover table-borderless">
                                                                                          <thead>
                                                                                                <tr>
                                                                                                      <th>#</th>
                                                                                                      <th>Grade</th>

                                                                                                      <th>Fee</th>
                                                                                                      <th class="text-center">Action</th>


                                                                                                </tr>
                                                                                          </thead>
                                                                                          <tbody id="tablbox">
                                                                                                <?php
                                                                                                $fee = DB::search("SELECT * FROM `enrollment_fee` INNER JOIN `grade` ON enrollment_fee.`grade_gid`=`grade`.`gid`");
                                                                                                for ($i = 0; $i < $fee->num_rows; $i++) {
                                                                                                      $d = $fee->fetch_assoc();
                                                                                                ?>
                                                                                                      <tr>
                                                                                                            <td><?php echo $i + 1 ?></td>
                                                                                                            <td>Grade <?php echo $d["gname"] ?></td>

                                                                                                            <td>Rs <?php echo $d["fee"] ?>.00</td>

                                                                                                            <td>
                                                                                                                  <div class="dropdown text-center">
                                                                                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                                                                              <i class="bx bx-dots-vertical-rounded"></i>
                                                                                                                        </button>
                                                                                                                        <div class="dropdown-menu">
                                                                                                                              <a class="dropdown-item" href="#" onclick="vieweditFee(<?php echo $d['grade_gid'] ?>,'<?php echo $d['fee'] ?>');"><i class="bx bx-edit-alt me-1"></i> Edit</a>
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

                                                                        </div>


                                                                  </div>


                                                            </div>
                                                      </div>

                                                </div>

                                                <div class="col-12 col-md-6">

                                                      <div class="card mb-3">

                                                            <div class="card-body">

                                                                  <div class="row">
                                                                        <div class="col-8">
                                                                              <h5 class="card-title" id="feeheder">Add Enrollment Fee</h5>

                                                                        </div>

                                                                        <div class="card shadow-none">

                                                                              <div class="mb-3">
                                                                                    <label for="grade" class="form-label">Grade</label>
                                                                                    <select id="grade" class="form-select">
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
                                                                              <div class="input-group">
                                                                                    <span class="input-group-text">Rs</span>
                                                                                    <input type="text" class="form-control" id="enfeeid" placeholder="Fee">
                                                                                    <span class="input-group-text">.00</span>

                                                                                    <button class="btn btn-outline-info" type="button" id="feeadd-btn" onclick="addFee();">Save</button>
                                                                              </div>
                                                                              <button class="btn btn-secondary mt-2 me-0 ms-auto d-none" style="width: fit-content;" id="clearbtn" type="button"  onclick="clearfee();">Clear</button>

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