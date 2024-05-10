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

            <title>Admin | Add Class</title>

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



                                                <div class="col-xxl-6">
                                                      <!-- grade 1-5 -->
                                                      <div class="card mb-4">

                                                            <h5 class="card-header pb-0 py-3">Add Grades 1-11 Class </h5>

                                                            <div class="card-body">
                                                                  <label class="form-label d-block mt-2" for="grade">Grade <span class="text-danger">*</span></label>

                                                                  <div class="input-group">
                                                                        <select id="grade" onchange="getGradeTeacher();" class="form-select">
                                                                              <option value="0">Select Grade</option>
                                                                              <!-- load grades from db  -->
                                                                              <?php
                                                                              $reult = DB::search("SELECT * FROM `grade` WHERE `gname` NOT IN (12,13)");

                                                                              for ($i = 0; $i < $reult->num_rows; $i++) {
                                                                                    $d = $reult->fetch_assoc();
                                                                              ?>
                                                                                    <option value="<?php echo $d["gid"] ?>"><?php echo $d["gname"] ?></option>
                                                                              <?php
                                                                              }
                                                                              ?>
                                                                        </select>
                                                                  </div>
                                                                  <label class="form-label d-block mt-2" for="grade">Medium <span class="text-danger">*</span></label>

                                                                  <div class="input-group">
                                                                        <select id="mediumid" class="form-select">
                                                                              <option value="0">Select Medium</option>
                                                                              <?php
                                                                              $result = DB::search("SELECT * FROM `medium` ");
                                                                              for ($i = 0; $i < $result->num_rows; $i++) {
                                                                                    $d = $result->fetch_assoc();
                                                                              ?>
                                                                                    <option value="<?php echo $d["mid"] ?>"><?php echo $d["mname"] ?></option>

                                                                              <?php
                                                                              }
                                                                              ?>
                                                                        </select>
                                                                  </div>
                                                                  <label class="form-label d-block mt-2" for="Assigntecher">Assign Class Teacher </label>

                                                                  <div class="input-group">
                                                                        <select id="Assigntecher" class="form-select">
                                                                              <option value="0">Select Teacher</option>
                                                                              <?php
                                                                              $result = DB::search("SELECT * FROM `user`  WHERE `user`.`uid` IN ( SELECT DISTINCT `user_uid` FROM  `teacher_has_grade`  INNER JOIN `grade` ON `teacher_has_grade`.`grade_gid`= `grade`.`gid` WHERE `grade`.`gname` BETWEEN 1 AND 11 ) ");
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
                                                                  <label class="form-label d-block mt-2" for="classname">Class Name <span class="text-danger">*</span></label>

                                                                  <div class="input-group">
                                                                        <input type="text" class="form-control" id="classname" placeholder="ex :- 10-A">
                                                                        <button class="btn btn-info" type="button" onclick="addClass();">Add</button>
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
                                                      <div class="col-xxl-6 ">
                                                            <div class="card mb-4">




                                                                  <h5 class="card-header pb-0 py-3">Add Grade 12-13 Class (A/L) </h5>

                                                                  <div class="card-body">
                                                                        <label class="form-label d-block mt-2" for="gradeal">Grade <span class="text-danger">*</span></label>

                                                                        <div class="input-group">
                                                                              <select id="gradeal" onchange="getGradeTeacherAL();" class="form-select">
                                                                                    <option value="0">Select Grade</option>
                                                                              <!-- load grades from db  -->
                                                                                    <?php
                                                                                    $reult = DB::search("SELECT * FROM `grade` WHERE `gname` IN (12,13)");

                                                                                    for ($i = 0; $i < $reult->num_rows; $i++) {
                                                                                          $d = $reult->fetch_assoc();
                                                                                    ?>
                                                                                          <option value="<?php echo $d["gid"] ?>"><?php echo $d["gname"] ?></option>
                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                              </select>
                                                                        </div>
                                                                        <label class="form-label d-block mt-2" for="alstream">Select A/L Stream <span class="text-danger">*</span></label>

                                                                        <div class="input-group">
                                                                              <select id="alstream" class="form-select">
                                                                                    <option value="0">Select Stream</option>
                                                                                    <?php
                                                                                    $result = DB::search("SELECT * FROM `al_stream` WHERE `stream_name`<>'Common'");
                                                                                    for ($i = 0; $i < $result->num_rows; $i++) {
                                                                                          $d = $result->fetch_assoc();
                                                                                    ?>
                                                                                          <option value="<?php echo $d["s_id"] ?>"><?php echo $d["stream_name"] ?></option>

                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                              </select>
                                                                        </div>
                                                                        <label class="form-label d-block mt-2" for="mediumidal">Medium <span class="text-danger">*</span></label>

                                                                        <div class="input-group">
                                                                              <select id="mediumidal" class="form-select">
                                                                                    <option value="0">Select Medium</option>
                                                                                    <?php
                                                                                    $result = DB::search("SELECT * FROM `medium` ");
                                                                                    for ($i = 0; $i < $result->num_rows; $i++) {
                                                                                          $d = $result->fetch_assoc();
                                                                                    ?>
                                                                                          <option value="<?php echo $d["mid"] ?>"><?php echo $d["mname"] ?></option>

                                                                                    <?php
                                                                                    }
                                                                                    ?>
                                                                              </select>
                                                                        </div>
                                                                        <label class="form-label d-block mt-2" for="Assigntecheral">Assign Class Teacher</label>

                                                                        <div class="input-group">
                                                                              <select id="Assigntecheral" class="form-select">
                                                                                    <option value="0">Select Teacher</option>
                                                                                    <?php
                                                                                    $result = DB::search("SELECT * FROM `user`  WHERE `user`.`uid` IN ( SELECT DISTINCT `user_uid` FROM  `teacher_has_grade`  INNER JOIN `grade` ON `teacher_has_grade`.`grade_gid`= `grade`.`gid` WHERE `grade`.`gname` BETWEEN 12 AND 13 ) ");
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
                                                                        <label class="form-label d-block mt-2" for="classnameal">Classs Name <span class="text-danger">*</span></label>

                                                                        <div class="input-group">
                                                                              <input type="text" class="form-control" id="classnameal" placeholder="ex :- 12-M3">
                                                                              <button class="btn btn-info" type="button" onclick="addClassAL();">Add</button>
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