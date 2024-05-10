<?php
session_start();
require "../../connection/connection.php";

if (isset($_SESSION["teacher"])) {
      $teacherId = $_SESSION["teacher"]["uid"];

?>

      <!DOCTYPE html>

      <html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

      <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

            <title>Teacher | Add Assignment</title>

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
                              require "teacherSidebar.php";
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


                                                <div class="col-xxl-6 ">
                                                      <div class="card mb-4">

                                                            <h5 class="card-header ">Add Assignment</h5>

                                                            <div class="card-body">
                                                                  <div class="mb-3">
                                                                        <label for="fileid" class="form-label" onclick="clearfile();viewfile();">Choose File <span class="text-danger">*</span></label>
                                                                        <input class="form-control" accept=".pdf" onchange="view();" onclick="clearfile();viewfile();" type="file" id="fileid">
                                                                        <div class="form-text text-warning">
                                                                              * Accept only PDF File
                                                                        </div>
                                                                  </div>
                                                                  <label class="form-label d-block mt-2" for="grade">Grade <span class="text-danger">*</span></label>

                                                                  <div class="input-group">
                                                                        <select id="grade" class="form-select">
                                                                              <option value="0">Select Grade</option>
                                                                              <!-- load grades from db  -->
                                                                              <?php
                                                                              $result = DB::search("SELECT * FROM `teacher_has_grade` INNER JOIN `grade` ON `teacher_has_grade`.`grade_gid`= `grade`.`gid` WHERE `teacher_has_grade`.`user_uid`='" . $teacherId . "'");
                                                                              for ($i = 0; $i < $result->num_rows; $i++) {
                                                                                    $d = $result->fetch_assoc();
                                                                              ?>
                                                                                    <option value="<?php echo $d["gid"] ?>"><?php echo $d["gname"] ?></option>

                                                                              <?php
                                                                              }
                                                                              ?>

                                                                        </select>
                                                                  </div>
                                                                  <label class="form-label d-block mt-2" for="subject">Select Subject <span class="text-danger">*</span></label>

                                                                  <div class="input-group">
                                                                        <select id="subject" class="form-select">
                                                                              <option value="0">Select Subject</option>
                                                                              <?php
                                                                              $result = DB::search("SELECT * FROM `teacher_has_subject` INNER JOIN `subject` ON `teacher_has_subject`.`subject_id`= `subject`.`sub_id` WHERE `teacher_has_subject`.`user_uid`='" . $teacherId . "'");
                                                                              for ($i = 0; $i < $result->num_rows; $i++) {
                                                                                    $d = $result->fetch_assoc();
                                                                              ?>
                                                                                    <option value="<?php echo $d["sub_id"] ?>"><?php echo $d["sub_name"] ?></option>

                                                                              <?php
                                                                              }
                                                                              ?>
                                                                        </select>
                                                                  </div>
                                                                  <label class="form-label d-block mt-2" for="startdate">Start Date <span class="text-danger">*</span></label>

                                                                  <input type="date" class="form-control" id="startdate">
                                                                  <label class="form-label d-block mt-2" for="enddate">End Date <span class="text-danger">*</span></label>

                                                                  <input type="date" class="form-control" id="enddate">


                                                                  <label class="form-label d-block mt-2" for="title">Assignment Title <span class="text-danger">*</span></label>

                                                                  <div class="input-group">
                                                                        <input type="text" class="form-control" id="title" placeholder="Enter Note Title">
                                                                        <button class="btn btn-info" type="button" onclick="addAssingment();">Add</button>
                                                                  </div>
                                                                  <div class="row pt-3">
                                                                        <div class="alert alert-danger alert-dismissible d-none my-0" id="errormsg" role="alert">


                                                                        </div>
                                                                  </div>
                                                            </div>
                                                      </div>

                                                </div>
                                                <div class="col-xxl-6 ">
                                                      <div class="card mb-4" id="divdocviewer">

                                                            <!-- <iframe id="docviewer" src="" width="100%" height="750px"></iframe> -->
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
            <script src="../js/teacher.js"></script>

      </body>

      </html>
<?php
} else {
?>
      <script>
            window.location = "../../login/gui/teacher-login.php";
      </script>
<?php
}
?>