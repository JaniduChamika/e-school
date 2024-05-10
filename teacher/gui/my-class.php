<?php
session_start();
require "../../connection/connection.php";

if (isset($_SESSION["teacher"])) {
      $techerId = $_SESSION["teacher"]["uid"];

      $ishaveClass = DB::search("SELECT * FROM `class` WHERE `teacher_tuid`='" . $techerId . "'");
      if ($ishaveClass->num_rows == 1) {
            $data=$ishaveClass->fetch_assoc();
?>
            <!DOCTYPE html>

            <html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

            <head>
                  <meta charset="utf-8" />
                  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

                  <title>Teacher | My Class</title>

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
                                                      <div class="col-12 ">
                                                            <div class="card mb-3">

                                                                  <div class="card-body">
                                                                        <div class="row">
                                                                              <div class="col-8">
                                                                                    <h5 class="card-title">My Class (Grade <?php echo $data["clz_name"] ?>)</h5>

                                                                              </div>
                                                                              <div class="col-4 text-end">
                                                                                    <a class="card-title cursor-pointer text-black" href="#" onclick="refresh();"><i class='bx bx-refresh'></i> Refresh</a>

                                                                              </div>
                                                                        </div>


                                                                        <div class="card shadow-none" id="tableBox">


                                                                              <div class="table-responsive text-nowrap mb-4 scrollbar" style="min-height: 550px;max-height: 550px;">
                                                                                    <table class="table table-hover expandable-table">
                                                                                          <thead>
                                                                                                <tr>
                                                                                                      <th class="ps-3">#</th>
                                                                                                      <th class="ps-3">Student Username </th>
                                                                                                      <th class="ps-3">Student Name</th>
                                                                                                      <th class="ps-3">Email Address</th>

                                                                                                      <th class="ps-3">Contact No</th>

                                                                                                      <th class="ps-2">Actions</th>
                                                                                                </tr>
                                                                                          </thead>
                                                                                          <tbody class="table-border-bottom-0 ">
                                                                                                <?php
                                                                                                 $page = 1;
                                                                                                 $number_per_page = 10;
                                                                                                 $offset = ($page - 1) * $number_per_page;
                                                                                                 $pagination = DB::search("SELECT * FROM `students`  WHERE `clz_id`='".$data["clz_id"]."'");
                                                                                                 $no_rows = $pagination->num_rows;
                                                                                                 $no_of_page = $no_rows / $number_per_page;
                                                                                                 if ($no_rows % $number_per_page != 0) {
                                                                                                       $no_of_page = $no_of_page + 1;
                                                                                                 }
             
                                                                                                 $no_of_page = intval($no_of_page);
             
                                                                                                $studnt=DB::search("SELECT * FROM  `students` WHERE `clz_id`='".$data["clz_id"]."'");
                                                                                                
                                                                                                for ($i = 0; $i < $studnt->num_rows; $i++) {
                                                                                                      $stuD=$studnt->fetch_assoc();
                                                                                                ?>
                                                                                                      <tr>
                                                                                                            <td><?php echo $i+1 + $offset ?></td>

                                                                                                            <td>
                                                                                                                  <span class="fw-bold text-capitalize"><?php echo $stuD["username"] ?></span>
                                                                                                            </td>
                                                                                                            <td><?php echo ucwords($stuD["fname"]." ".$stuD["lname"] ) ?></td>
                                                                                                            <td class="ps-3"><?php echo $stuD["email"] ?></td>
                                                                                                            <td><?php echo $stuD["contact"] ?></td>

                                                                                                            <td>
                                                                                                                  <div class="dropdown">
                                                                                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                                                                              <i class="bx bx-dots-vertical-rounded"></i>
                                                                                                                        </button>
                                                                                                                        <div class="dropdown-menu">

                                                                                                                              <a class="dropdown-item" id="showmorebtn<?php echo $i; ?>" onclick="showMore(<?php echo $i; ?>);"><i class='bx bx-show-alt'></i> See More</a>
                                                                                                                              <!-- <a class="dropdown-item" href="javascript:void(0);"><i class='bx bx-trash'></i> Delete</a> -->

                                                                                                                        </div>
                                                                                                                  </div>
                                                                                                            </td>
                                                                                                      </tr>
                                                                                                      <tr class="d-none advaViewUser" id="advancedetails<?php echo $i; ?>">
                                                                                                            <td colspan="6">
                                                                                                                  <table cellpadding="5" cellspacing="0" style="width:100%;">
                                                                                                                        <tbody>
                                                                                                                              <tr class="expanded-row">
                                                                                                                                    <td colspan="8" class="row-bg">
                                                                                                                                          <div>
                                                                                                                                                <div class="d-flex justify-content-between">
                                                                                                                                                <div class="expanded-table-normal-cell ">
                                                                                                                                                            <div class="">
                                                                                                                                                                  <p>Full Name </p>
                                                                                                                                                                  <h6><?php echo $stuD["fulname"] ?></h6>
                                                                                                                                                            </div>

                                                                                                                                                      </div>
                                                                                                                                                      <div class="expanded-table-normal-cell ">
                                                                                                                                                            <div class="">
                                                                                                                                                                  <p>Guardian Name</p>
                                                                                                                                                                  <h6><?php echo $stuD["guardian_name"] ?></h6>
                                                                                                                                                            </div>

                                                                                                                                                      </div>
                                                                                                                                                      <div class="expanded-table-normal-cell ">
                                                                                                                                                            <div class="">
                                                                                                                                                                  <p>Guardian Contact No</p>
                                                                                                                                                                  <h6><?php echo $stuD["guardian_contact"] ?></h6>
                                                                                                                                                            </div>

                                                                                                                                                      </div>
                                                                                                                                                      <div class="expanded-table-normal-cell">

                                                                                                                                                            <div class="">
                                                                                                                                                                  <p>DOB</p>
                                                                                                                                                                  <h6><?php echo $stuD["dob"] ?></h6>
                                                                                                                                                            </div>
                                                                                                                                                      </div>
                                                                                                                                                      <div class="expanded-table-normal-cell">

                                                                                                                                                            <div class="">
                                                                                                                                                                  <p>Gender</p>
                                                                                                                                                                  <h6><?php echo $stuD["gen"] ?></h6>
                                                                                                                                                            </div>
                                                                                                                                                      </div>
                                                                                                                                                      <div class="expanded-table-normal-cell">
                                                                                                                                                            <div class=" ">
                                                                                                                                                                  <p>Address</p>

                                                                                                                                                                  <h6><?php echo $stuD["address_line"]." ".$stuD["city"] ?></h6>
                                                                                                                                                            </div>
                                                                                                                                                      </div>




                                                                                                                                                </div>
                                                                                                                                          </div>
                                                                                                                                    </td>
                                                                                                                              </tr>
                                                                                                                        </tbody>
                                                                                                                  </table>
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
                                                                                          <a class="page-link" href="javascript:void(0);" onclick="searchMyclass(<?php echo $page - 1 ?>);"><i class="tf-icon bx bx-chevrons-left"></i></a>
                                                                                    </li>
                                                                                    <?php
                                                                              }

                                                                              for ($p = 1; $p <= $no_of_page; $p++) {
                                                                                    if ($page == $p) {
                                                                                    ?>
                                                                                          <li class="page-item active">
                                                                                                <a class="page-link" href="javascript:void(0);" onclick="searchMyclass(<?php echo $p  ?>);"><?php echo $p ?></a>
                                                                                          </li>
                                                                                    <?php
                                                                                    } else {
                                                                                    ?>
                                                                                          <li class="page-item">
                                                                                                <a class="page-link" href="javascript:void(0);" onclick="searchMyclass(<?php echo $p ?>);"><?php echo $p ?></a>
                                                                                          </li>
                                                                                    <?php
                                                                                    }
                                                                              }
                                                                              if ($no_of_page != $page && $no_of_page!=0 && $no_of_page != 0) {
                                                                                    ?>
                                                                                    <li class="page-item next">
                                                                                          <a class="page-link" href="javascript:void(0);" onclick="searchMyclass(<?php echo $page + 1 ?>);"><i class="tf-icon bx bx-chevrons-right"></i></a>
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
      }
} else {
      ?>
      <script>
            window.location = "../../login/gui/teacher-login.php";
      </script>
<?php
}
?>