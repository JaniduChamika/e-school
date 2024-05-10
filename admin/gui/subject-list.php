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

            <title>Admin | Subject List</title>
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
                                                <div class="col-md-12">
                                                      <!-- grade 1-11 -->
                                                      <div class="card mb-4 ">
                                                            <h5 class="card-header pb-0">Subjects List</h5>
                                                            <div class="card-body  pb-0 pt-2" id="tableBox">

                                                                  <div class="table-responsive text-nowrap overflow-auto scrollbar" style="min-height: 600px;max-height: 680px;">
                                                                        <table class="table table-hover">
                                                                              <thead>
                                                                                    <tr>
                                                                                          <th>#</th>

                                                                                          <th>Subject Name</th>
                                                                                          <th>Grade Range & Subject Type</th>

                                                                                          <th class="text-center">Actions</th>

                                                                                    </tr>
                                                                              </thead>
                                                                              <tbody class="table-border-bottom-0">
                                                                                    <?php
                                                                                    $page = 1;
                                                                                    $number_per_page = 10;
                                                                                    $offset = ($page - 1) * $number_per_page;
                                                                                    $pagination = DB::search("SELECT * FROM `allsubject` WHERE `sub_grade_type`<>1213 GROUP BY `sub_name`");
                                                                                    $no_rows = $pagination->num_rows;
                                                                                    $no_of_page = $no_rows / $number_per_page;
                                                                                    if ($no_rows % $number_per_page != 0) {
                                                                                          $no_of_page = $no_of_page + 1;
                                                                                    }

                                                                                    $no_of_page = intval($no_of_page);

                                                                                    $reult = DB::search("SELECT * FROM `allsubject` WHERE `sub_grade_type`<>1213 GROUP BY `sub_name` ORDER BY `sub_name` ASC LIMIT $number_per_page OFFSET $offset");


                                                                                    for ($i = 0; $i < $reult->num_rows; $i++) {
                                                                                          $d = $reult->fetch_assoc();

                                                                                    ?>
                                                                                          <tr>
                                                                                                <td><?php echo $i + 1 + $offset ?></td>
                                                                                                <td><?php
                                                                                                      echo $d["sub_name"];
                                                                                                      ?>
                                                                                                </td>
                                                                                                <td>
                                                                                                      <?php
                                                                                                      $gradeRange = DB::search("SELECT * FROM `allsubject` WHERE `sub_grade_type`<>1213 AND `sub_id`=" . $d["sub_id"] . "");


                                                                                                      for ($g = 0; $g < $gradeRange->num_rows; $g++) {
                                                                                                            $gd = $gradeRange->fetch_assoc();


                                                                                                            if ($gd["sub_grade_type"] == 15) {

                                                                                                                  echo "Grade <b>1-5</b> " . " :- " . $gd["c_name"] . " | ";
                                                                                                            } else if ($gd["sub_grade_type"] == 69) {
                                                                                                                  echo "Grade <b>6-9</b>" . " :- " . $gd["c_name"] . " | ";
                                                                                                            } else if ($gd["sub_grade_type"] == 1011) {
                                                                                                                  echo "Grade <b>10-11</b>" . " :- " . $gd["c_name"];
                                                                                                            }
                                                                                                      }


                                                                                                      ?>
                                                                                                </td>


                                                                                                <td class="text-center">
                                                                                                      <div class="dropdown">
                                                                                                            <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                                                                  <i class="bx bx-dots-vertical-rounded"></i>
                                                                                                            </button>
                                                                                                            <div class="dropdown-menu">

                                                                                                                  <a class="dropdown-item" href="#" onclick="showModel(<?php echo $d['sub_id'] ?>, 'ed-subject','<?php echo $d['sub_name'] ?>');"><i class='bx bx-rename'></i> Rename</a>

                                                                                                                  <?php
                                                                                                                  $subUsed = DB::search(" SELECT assignment.sub_id FROM assignment WHERE `sub_id`=" . $d['sub_id'] . " UNION SELECT note.sub_id  FROM  note WHERE `sub_id`=" . $d['sub_id'] . " UNION SELECT teacher_has_subject.subject_id FROM teacher_has_subject  WHERE `subject_id`=" . $d['sub_id'] . "");
                                                                                                                  if ($subUsed->num_rows == 0) {
                                                                                                                  ?>
                                                                                                                        <a class="dropdown-item" href="#" onclick="showDelModel(<?php echo $d['sub_id'] ?>);"><i class="bx bx-trash me-1"></i> Delete</a>

                                                                                                                  <?php
                                                                                                                  }
                                                                                                                  ?>
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
                                                                                          <a class="page-link" href="javascript:void(0);" onclick="searchSubject(<?php echo $page - 1 ?>);"><i class="tf-icon bx bx-chevrons-left"></i></a>
                                                                                    </li>
                                                                                    <?php
                                                                              }

                                                                              for ($p = 1; $p <= $no_of_page; $p++) {
                                                                                    if ($page == $p) {
                                                                                    ?>
                                                                                          <li class="page-item active">
                                                                                                <a class="page-link" href="javascript:void(0);" onclick="searchSubject(<?php echo $p  ?>);"><?php echo $p ?></a>
                                                                                          </li>
                                                                                    <?php
                                                                                    } else {
                                                                                    ?>
                                                                                          <li class="page-item">
                                                                                                <a class="page-link" href="javascript:void(0);" onclick="searchSubject(<?php echo $p ?>);"><?php echo $p ?></a>
                                                                                          </li>
                                                                                    <?php
                                                                                    }
                                                                              }
                                                                              if ($no_of_page != $page && $no_of_page != 0) {
                                                                                    ?>
                                                                                    <li class="page-item next">
                                                                                          <a class="page-link" href="javascript:void(0);" onclick="searchSubject(<?php echo $page + 1 ?>);"><i class="tf-icon bx bx-chevrons-right"></i></a>
                                                                                    </li>
                                                                              <?php
                                                                              }
                                                                              ?>
                                                                        </ul>
                                                                  </nav>
                                                            </div>

                                                      </div>
                                                      <!-- grade 1-5 -->



                                                </div>



                                          </div>
                                          <div class="modal fade" id="myModelID" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog">
                                                <div class="modal-dialog">
                                                      <form class="modal-content">
                                                            <div class="modal-header">
                                                                  <h5 class="modal-title" id="backDropModalTitle">Rename Subject</h5>
                                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                  <div class="row">
                                                                        <div class="col mb-3">
                                                                              <label for="editsubname" class="form-label">Subject Name</label>
                                                                              <input type="text" class="form-control" placeholder="Enter Subject Name" id="editsubname" />
                                                                        </div>
                                                                  </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                        Close
                                                                  </button>
                                                                  <button type="button" class="btn btn-info" id="submitBtn">Rename</button>
                                                            </div>
                                                      </form>
                                                </div>
                                          </div>
                                          <div class="modal fade" id="subDelModal" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered">
                                                      <form class="modal-content" >
                                                            <div class="modal-header">
                                                                  <h5 class="modal-title" id="backDropModalTitle">Comfirmation</h5>
                                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body"> Are your sure you want to delete this subject?</div>
                                                            <div class="modal-footer">
                                                                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                        No
                                                                  </button>
                                                                  <button type="button" class="btn btn-danger" id="delbtn">Yes</button>
                                                            </div>
                                                      </form>
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