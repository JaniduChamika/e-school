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

            <title>Admin | Notes</title>

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
                                                <div class="col-12 ">
                                                      <div class="card mb-3">

                                                            <div class="card-body">
                                                                  <div class="row">
                                                                        <div class="col-8">
                                                                              <h5 class="card-title">Notes</h5>

                                                                        </div>
                                                                        <div class="col-4 text-end">
                                                                              <a class="card-title cursor-pointer text-black" href="#" onclick="refresh();"><i class='bx bx-refresh'></i> Refresh</a>

                                                                        </div>
                                                                  </div>
                                                                  <div class="row">

                                                                        <div class="col-6  col-md-4 col-lg-3  ms-auto me-0">
                                                                              <select id="selectgrade" onchange="searchNote(1);" class="form-select">
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
                                                                        <div class="col-6  col-md-4 col-lg-3">

                                                                              <select id="selectsub" onchange="searchNote(1);" class="form-select">
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
                                                                                                <th class="ps-3">Note ID </th>
                                                                                                <th class="ps-3">Note Title</th>
                                                                                                <th class="ps-3">Grade</th>

                                                                                                <th class="ps-3">Subject</th>
                                                                                                <th class="ps-3">Teacher</th>

                                                                                                <th class="ps-2">Actions</th>
                                                                                          </tr>
                                                                                    </thead>
                                                                                    <tbody class="table-border-bottom-0 ">
                                                                                          <?php
                                                                                          $page = 1;
                                                                                          $number_per_page = 10;
                                                                                          $offset = ($page - 1) * $number_per_page;
                                                                                          $pagination = DB::search("SELECT * FROM `note_view` ");
                                                                                          $no_rows = $pagination->num_rows;
                                                                                          $no_of_page = $no_rows / $number_per_page;
                                                                                          if ($no_rows % $number_per_page != 0) {
                                                                                                $no_of_page = $no_of_page + 1;
                                                                                          }

                                                                                          $no_of_page = intval($no_of_page);


                                                                                          $result = DB::search("SELECT * FROM `note_view`  LIMIT $number_per_page OFFSET $offset");
                                                                                          for ($i = 0; $i < $result->num_rows; $i++) {
                                                                                                $d = $result->fetch_assoc();
                                                                                          ?>
                                                                                                <tr>
                                                                                                      <td><?php echo $i + 1 + $offset  ?></td>

                                                                                                      <td>


                                                                                                            <span class="fw-bold text-capitalize"><?php echo $d["note_id"] ?></span>
                                                                                                      </td>
                                                                                                      <td><?php echo $d["title"] ?></td>
                                                                                                      <td><?php echo $d["gname"] ?></td>
                                                                                                      <td class="ps-3"><?php echo $d["sub_name"] ?></td>
                                                                                                      <td class="ps-3">
                                                                                                            <?php if ($d["gender_gid"] == 1) {
                                                                                                                  echo "Mr. " . $d["fname"] . " " . $d["lname"];
                                                                                                            } else {
                                                                                                                  echo "Mrs. " . $d["fname"] . " " . $d["lname"];
                                                                                                            }
                                                                                                            ?>
                                                                                                      </td>

                                                                                                      <td>
                                                                                                            <div class="dropdown">
                                                                                                                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                                                                                  </button>
                                                                                                                  <div class="dropdown-menu">

                                                                                                                        <a class="dropdown-item" href="../../doc/note/<?php echo $d["file_path"]  ?>" target="_blank"><i class='bx bx-show-alt'></i> View</a>
                                                                                                                        <a class="dropdown-item" href="../../doc/note/<?php echo $d["file_path"]  ?>" download=""><i class='bx bxs-download'></i> Download</a>

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
                                                                                                <a class="page-link" href="javascript:void(0);" onclick="searchNote(<?php echo $page - 1 ?>);"><i class="tf-icon bx bx-chevrons-left"></i></a>
                                                                                          </li>
                                                                                          <?php
                                                                                    }

                                                                                    for ($p = 1; $p <= $no_of_page; $p++) {
                                                                                          if ($page == $p) {
                                                                                          ?>
                                                                                                <li class="page-item active">
                                                                                                      <a class="page-link" href="javascript:void(0);" onclick="searchNote(<?php echo $p  ?>);"><?php echo $p ?></a>
                                                                                                </li>
                                                                                          <?php
                                                                                          } else {
                                                                                          ?>
                                                                                                <li class="page-item">
                                                                                                      <a class="page-link" href="javascript:void(0);" onclick="searchNote(<?php echo $p ?>);"><?php echo $p ?></a>
                                                                                                </li>
                                                                                          <?php
                                                                                          }
                                                                                    }
                                                                                    if ($no_of_page != $page && $no_of_page!=0) {
                                                                                          ?>
                                                                                          <li class="page-item next">
                                                                                                <a class="page-link" href="javascript:void(0);" onclick="searchNote(<?php echo $page + 1 ?>);"><i class="tf-icon bx bx-chevrons-right"></i></a>
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