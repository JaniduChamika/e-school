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

            $studentID = $_SESSION["student"]["uid"];
            $stu = DB::search("SELECT * FROM `students` WHERE `uid`='" . $studentID . "'");
            $student = $stu->fetch_assoc();


?>
            <!DOCTYPE html>

            <html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

            <head>
                  <meta charset="utf-8" />
                  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

                  <title>Student | Assignments List</title>

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
                                                                                    <h5 class="card-title">Assignments</h5>

                                                                              </div>
                                                                              <div class="col-4 text-end">
                                                                                    <a class="card-title cursor-pointer text-black" href="#" onclick="refresh();"><i class='bx bx-refresh'></i> Refresh</a>

                                                                              </div>
                                                                        </div>
                                                                        <div class="row">

                                                                              <div class="d-none d-md-block col-md-4 col-lg-2">
                                                                                    <label class="btn btn-outline-success " id="previewchecked" for="activetag">Active</label>
                                                                                    <input type="checkbox" class="btn-check " onchange="checkedinputact();searchAssignment(1);" id="activetag">
                                                                              </div>
                                                                              <div class="col-6  col-md-4 col-lg-3 me-0 ms-auto">

                                                                                    <select id="selectsub" onchange="searchAssignment(1);" class="form-select">
                                                                                          <option value="0">Select Subject</option>
                                                                                          <?php

                                                                                          $reult = DB::search("SELECT * FROM `subject`");

                                                                                          for ($i = 0; $i < $reult->num_rows; $i++) {
                                                                                                $d = $reult->fetch_assoc();
                                                                                          ?>
                                                                                                <option value="<?php echo $d["sub_id"] ?>"><?php echo $d["sub_name"] ?></option>
                                                                                          <?php
                                                                                          }
                                                                                          ?>
                                                                                    </select>
                                                                              </div>
                                                                        </div>

                                                                        <div class="card shadow-none" id="tableBox">


                                                                              <div class="table-responsive text-nowrap mb-4 scrollbar" style="min-height: 550px;max-height: 550px;">
                                                                                    <table class="table table-hover expandable-table">
                                                                                          <thead>
                                                                                                <tr>
                                                                                                      <th class="ps-3">#</th>
                                                                                                      <th class="ps-3">Assignment ID </th>
                                                                                                      <th class="ps-3">Assignment Title</th>
                                                                                                      <th class="ps-3">Subject</th>

                                                                                                      <th class="ps-3">Start Date</th>
                                                                                                      <th class="ps-3">End Date</th>
                                                                                                      <th class="ps-3">Status</th>
                                                                                                      <th class="ps-3">Marks</th>

                                                                                                      <th class="ps-2">Actions</th>
                                                                                                </tr>
                                                                                          </thead>
                                                                                          <tbody class="table-border-bottom-0 ">
                                                                                                <?php
                                                                                                $page = 1;
                                                                                                $number_per_page = 10;
                                                                                                $offset = ($page - 1) * $number_per_page;
                                                                                                $pagination = DB::search("SELECT * FROM `assingment_view` WHERE `gid`='" . $student["gid"] . "'");
                                                                                                $no_rows = $pagination->num_rows;
                                                                                                $no_of_page = $no_rows / $number_per_page;
                                                                                                if ($no_rows % $number_per_page != 0) {
                                                                                                      $no_of_page = $no_of_page + 1;
                                                                                                }

                                                                                                $no_of_page = intval($no_of_page);


                                                                                                $result = DB::search("SELECT * FROM `assingment_view`  WHERE `gid`='" . $student["gid"] . "' LIMIT $number_per_page OFFSET $offset");
                                                                                                for ($i = 0; $i < $result->num_rows; $i++) {
                                                                                                      $d = $result->fetch_assoc();
                                                                                                      $isupload = DB::search("SELECT * FROM `student_assignment_awnser` WHERE `assignment_aid`='" . $d["aid"] . "' AND `user_uid`='" . $student["uid"] . "'");
                                                                                                      $mark;
                                                                                                ?>
                                                                                                      <tr>
                                                                                                            <td><?php echo $i + 1 + $offset ?></td>

                                                                                                            <td>
                                                                                                                  <span class="fw-bold text-capitalize"><?php echo $d["assignment_id"]; ?></span>
                                                                                                            </td>
                                                                                                            <td><?php echo $d["title"]; ?></td>
                                                                                                            <td class="ps-3"><?php echo $d["sub_name"]; ?></td>
                                                                                                            <td><?php echo $d["start_date"]; ?></td>
                                                                                                            <td><?php echo $d["end_date"]; ?></td>
                                                                                                            <td class="ps-3">
                                                                                                                  <?php
                                                                                                                  if ($date < $d["start_date"]) {
                                                                                                                  ?>
                                                                                                                        <span class="badge bg-label-warning me-1">Pending</span>

                                                                                                                        <?php
                                                                                                                  } else if ($date >= $d["start_date"] && $date <= $d["end_date"]) {
                                                                                                                        if ($isupload->num_rows == 1) {

                                                                                                                        ?>
                                                                                                                              <span class="badge bg-label-info me-1">Submitted</span>

                                                                                                                        <?php
                                                                                                                        } else {
                                                                                                                        ?>
                                                                                                                              <span class="badge bg-label-success me-1">Active</span>

                                                                                                                        <?php
                                                                                                                        }
                                                                                                                  } else {
                                                                                                                        if ($isupload->num_rows == 1) {
                                                                                                                        ?>
                                                                                                                              <span class="badge bg-label-info me-1">Submitted</span>

                                                                                                                        <?php
                                                                                                                        } else {
                                                                                                                        ?>
                                                                                                                              <span class="badge bg-label-danger me-1">Not Submitted</span>

                                                                                                                  <?php
                                                                                                                        }
                                                                                                                  }
                                                                                                                  ?>
                                                                                                            </td>
                                                                                                            <td>
                                                                                                                  <?php if ($isupload->num_rows == 1) {
                                                                                                                        $mark = $isupload->fetch_assoc();
                                                                                                                        if ($mark["status"] == 2) {
                                                                                                                              echo $mark["marks"];
                                                                                                                        } else {
                                                                                                                  ?>
                                                                                                                              <span class="badge bg-label-warning">Pending</span>

                                                                                                                  <?php
                                                                                                                        }
                                                                                                                  }
                                                                                                                  ?>
                                                                                                            </td>


                                                                                                            <td>
                                                                                                                  <?php
                                                                                                                  if ($date >= $d["start_date"] && $date <= $d["end_date"]) {
                                                                                                                  ?>
                                                                                                                        <div class="dropdown">
                                                                                                                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                                                                              </button>
                                                                                                                              <div class="dropdown-menu">

                                                                                                                                    <a class="dropdown-item" href="../../doc/assignment/<?php echo $d["file_path"]  ?>" target="_blank"><i class='bx bx-show-alt'></i> View</a>
                                                                                                                                    <a class="dropdown-item" href="../../doc/assignment/<?php echo $d["file_path"]  ?>" download=""><i class='bx bxs-download'></i> Download</a>
                                                                                                                                    <?php

                                                                                                                                    if ($isupload->num_rows == 1) {
                                                                                                                                    ?>
                                                                                                                                          <a class="dropdown-item" href="javascript:void(0);" onclick="showUploadMod(<?php echo $d['aid']; ?>);"><i class='bx bx-cloud-upload'></i> Reupload Anwser</a>

                                                                                                                                    <?php
                                                                                                                                    } else {
                                                                                                                                    ?>
                                                                                                                                          <a class="dropdown-item" href="javascript:void(0);" onclick="showUploadMod(<?php echo $d['aid']; ?>);"><i class='bx bx-cloud-upload'></i> Upload Anwser</a>

                                                                                                                                    <?php
                                                                                                                                    }
                                                                                                                                    ?>

                                                                                                                              </div>
                                                                                                                        </div>

                                                                                                                  <?php
                                                                                                                  } else if (!empty($mark["marks"]) && ($mark["status"] == 2)) {
                                                                                                                  ?>
                                                                                                                        <div class="dropdown">
                                                                                                                              <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                                                                              </button>
                                                                                                                              <div class="dropdown-menu">

                                                                                                                                    <a class="dropdown-item" href="../../doc/result-sheet/<?php echo $d["result_sheet_path"]  ?>" target="_blank"><i class='bx bx-show-alt'></i> View Result Sheet</a>





                                                                                                                              </div>
                                                                                                                        </div>

                                                                                                                  <?php
                                                                                                                  }

                                                                                                                  ?>

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
                                                                                                      <a class="page-link" href="javascript:void(0);" onclick="searchAssignment(<?php echo $page - 1 ?>);"><i class="tf-icon bx bx-chevrons-left"></i></a>
                                                                                                </li>
                                                                                                <?php
                                                                                          }

                                                                                          for ($p = 1; $p <= $no_of_page; $p++) {
                                                                                                if ($page == $p) {
                                                                                                ?>
                                                                                                      <li class="page-item active">
                                                                                                            <a class="page-link" href="javascript:void(0);" onclick="searchAssignment(<?php echo $p  ?>);"><?php echo $p ?></a>
                                                                                                      </li>
                                                                                                <?php
                                                                                                } else {
                                                                                                ?>
                                                                                                      <li class="page-item">
                                                                                                            <a class="page-link" href="javascript:void(0);" onclick="searchAssignment(<?php echo $p ?>);"><?php echo $p ?></a>
                                                                                                      </li>
                                                                                                <?php
                                                                                                }
                                                                                          }
                                                                                          if ($no_of_page != $page && $no_of_page!=0) {
                                                                                                ?>
                                                                                                <li class="page-item next">
                                                                                                      <a class="page-link" href="javascript:void(0);" onclick="searchAssignment(<?php echo $page + 1 ?>);"><i class="tf-icon bx bx-chevrons-right"></i></a>
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



                                                <div class="modal fade" id="myModelID" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog">
                                                      <div class="modal-dialog modal-dialog-scrollable">
                                                            <form class="modal-content">
                                                                  <div class="modal-header">
                                                                        <h5 class="modal-title">Uploade your answer sheet</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                  </div>
                                                                  <div class="modal-body">
                                                                        <div class="row">
                                                                              <div class="col mb-3">
                                                                                    <label for="fileid" class="form-label" onclick="clearfile();viewfile();">Choose File</label>
                                                                                    <input class="form-control" accept=".pdf" onclick="clearfile();viewfile();" type="file" id="fileid">
                                                                                    <div class="form-text text-warning">
                                                                                          * Accept only PDF File
                                                                                    </div>
                                                                                    <div class="form-text text-danger" id="error2">

                                                                                    </div>
                                                                              </div>
                                                                        </div>
                                                                        <div class="row">
                                                                              <div class="col-xxl-12 ">
                                                                                    <div class="card " id="divdocviewer">

                                                                                          <!-- <iframe id="docviewer" src="" width="100%" height="750px"></iframe> -->
                                                                                    </div>
                                                                              </div>
                                                                        </div>

                                                                  </div>
                                                                  <div class="modal-footer">
                                                                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                              Close
                                                                        </button>
                                                                        <button type="button" class="btn btn-info" id="submitBtn">Submit</button>
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
                  <script src="../js/student.js"></script>

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