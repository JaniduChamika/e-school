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

            <title>Admin | Add Subject</title>

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



                                                <div class="col-md-6">
                                                      <!-- grade 1-5 -->
                                                      <div class="card mb-4">
                                                            <h5 class="card-header">Add Grade 1-11 Subject</h5>



                                                            <div class="card-body">
                                                                  <div class="row">


                                                                        <label class="form-label d-block mt-2" for="subjectName">Subject Name <span class="text-danger">*</span></label>

                                                                        <div class="input-group">
                                                                              <input type="text" class="form-control" id="subjectName" placeholder="Enter Subject Name">

                                                                        </div>

                                                                        <label class="form-label d-block mt-2" for="sub-category15">Grade Ranges <span class="text-danger">*</span></label>

                                                                        <div class="col-lg-12 d-flex justify-content-between">

                                                                              <div class="form-check form-check-inline ">
                                                                                    <input class="form-check-input" onchange="checkSelectGrade();" type="checkbox" id="grad15" value="15">
                                                                                    <label class="form-check-label" for="grad15">Grade 1-5</label>
                                                                              </div>
                                                                              <div class="form-check form-check-inline ">
                                                                                    <input class="form-check-input" onchange="checkSelectGrade();" type="checkbox" id="grad69" value="69">
                                                                                    <label class="form-check-label" for="grad69">Grade 6-9</label>
                                                                              </div>
                                                                              <div class="form-check form-check-inline ">
                                                                                    <input class="form-check-input" onchange="checkSelectGrade();" type="checkbox" id="grad1011" value="1011">
                                                                                    <label class="form-check-label" for="grad1011">Grade 10-11</label>
                                                                              </div>

                                                                        </div>
                                                                        <div id="error" class="text-danger col-12">

                                                                        </div>
                                                                        <div class="col-12 d-none" id="grade15">

                                                                              <label class="form-label d-block mt-2" for="sub-category15">Category For Grade 1-5 <span class="text-danger">*</span></label>

                                                                              <div class="input-group ">
                                                                                    <select id="sub-category15" class="form-select">
                                                                                          <option value="0">Select Category </option>

                                                                                          <?php
                                                                                          $result = DB::search("SELECT * FROM `subject_category` WHERE `c_id` IN (1,2) ");
                                                                                          for ($i = 0; $i < $result->num_rows; $i++) {
                                                                                                $d = $result->fetch_assoc();
                                                                                          ?>
                                                                                                <option value="<?php echo $d["c_id"] ?>"><?php echo $d["c_name"] ?> Subject</option>

                                                                                          <?php
                                                                                          }
                                                                                          ?>


                                                                                    </select>
                                                                              </div>
                                                                        </div>
                                                                        <div class="col-12 d-none" id="grade69">

                                                                              <label class="form-label d-block mt-2" for="sub-category69">Category For Grade 6-9 <span class="text-danger">*</span></label>

                                                                              <div class="input-group">
                                                                                    <select id="sub-category69" class="form-select">
                                                                                          <option value="0">Select Category</option>
                                                                                          <?php
                                                                                          $result = DB::search("SELECT * FROM `subject_category` WHERE `c_id` IN (1,2,6) ");
                                                                                          for ($i = 0; $i < $result->num_rows; $i++) {
                                                                                                $d = $result->fetch_assoc();
                                                                                          ?>
                                                                                                <option value="<?php echo $d["c_id"] ?>"><?php echo $d["c_name"] ?> Subject</option>

                                                                                          <?php
                                                                                          }
                                                                                          ?>

                                                                                    </select>
                                                                              </div>
                                                                        </div>
                                                                        <div class="col-12 d-none" id="grade1011">

                                                                              <label class="form-label d-block mt-2" for="sub-category1011">Category For Grade 10-11 <span class="text-danger">*</span></label>

                                                                              <div class="input-group">
                                                                                    <select id="sub-category1011" class="form-select">
                                                                                          <option value="0">Select Category</option>
                                                                                          <?php
                                                                                          $result = DB::search("SELECT * FROM `subject_category` WHERE `c_id` IN (1,2,3,4,5) ");
                                                                                          for ($i = 0; $i < $result->num_rows; $i++) {
                                                                                                $d = $result->fetch_assoc();
                                                                                          ?>
                                                                                                <option value="<?php echo $d["c_id"] ?>"><?php echo $d["c_name"] ?> Subject</option>

                                                                                          <?php
                                                                                          }
                                                                                          ?>


                                                                                    </select>

                                                                              </div>
                                                                        </div>
                                                                        <div class="input-group pt-4">

                                                                              <button class="btn btn-info w-100" type="button" onclick="addSubject111();">Add</button>
                                                                        </div>
                                                                  </div>
                                                            </div>
                                                      </div>
                                                      <!-- grade 1-5 -->


                                                </div>

                                                <?php
                                                $result3g = DB::search("SELECT * FROM `grade` WHERE `gname` IN(12,13)");
                                                if ($result3g->num_rows == 2) {
                                                ?>
                                                      <!-- grade 12-13 -->
                                                      <div class="col-md-6 ">
                                                            <div class="card mb-4">
                                                                  <h5 class="card-header">Add Grades 12-13 Subjects</h5>

                                                                  <div class="card-body">

                                                                        <label class="form-label d-block mt-2" for="al-stream">Select A/L Stream <span class="text-danger">*</span></label>

                                                                        <div class="input-group">
                                                                              <select id="al-stream" class="form-select">
                                                                                    <option value="0">Select Stream</option>
                                                                                    <?php
                                                                                    $result = DB::search("SELECT * FROM `al_stream` ");
                                                                                    for ($i = 0; $i < $result->num_rows; $i++) {
                                                                                          $d = $result->fetch_assoc();
                                                                                    ?>
                                                                                          <option value="<?php echo $d["s_id"] ?>"><?php echo $d["stream_name"] ?></option>

                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                              </select>
                                                                        </div>
                                                                        <label class="form-label d-block mt-2" for="subjectName1213">Subject Name <span class="text-danger">*</span></label>

                                                                        <div class="input-group">
                                                                              <input type="text" class="form-control" id="subjectName1213" placeholder="Enter Subject Name">

                                                                        </div>
                                                                        <div class="input-group pt-4">

                                                                              <button class="btn btn-info w-100" type="button" onclick="addSubject1213();">Add</button>
                                                                        </div>
                                                                  </div>
                                                            </div>

                                                      </div>
                                                      <!-- grade 12-13 -->
                                                <?php
                                                }
                                                ?>
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