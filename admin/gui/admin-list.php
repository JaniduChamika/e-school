<?php
session_start();
require "../../connection/connection.php";

if (isset($_SESSION["admin"]) && $_SESSION["admin"]["user_type"] == 1) {

?>
      <!DOCTYPE html>

      <html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

      <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

            <title>Admin | Admin List</title>
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
                                                                              <h5 class="card-title">Admin List</h5>

                                                                        </div>
                                                                        <div class="col-4 text-end">
                                                                              <a class="card-title cursor-pointer text-black" href="#" onclick="refresh();"><i class='bx bx-refresh'></i> Refresh</a>

                                                                        </div>
                                                                  </div>

                                                                  <div class="row">
                                                                        <div class="d-none d-md-block col-md-4 col-lg-2">
                                                                              <label class="btn btn-outline-warning " id="previewchecked" for="pendingbtn">Pendding</label>
                                                                              <input type="checkbox" class="btn-check " onchange="checkedinput();searchAdmin(1);" id="pendingbtn">
                                                                        </div>
                                                                  </div>
                                                                  <div class="card shadow-none" id="tableBox">
                                                                        <!-- <h5 class="card-header">Teachers Database</h5> -->

                                                                        <div class="table-responsive text-nowrap mb-4 scrollbar" style="min-height: 550px;max-height: 550px;">
                                                                              <table class="table table-hover expandable-table">
                                                                                    <thead>
                                                                                          <tr>
                                                                                                <th class="ps-3">#</th>
                                                                                                <th class="ps-3">Username</th>
                                                                                                <th class="ps-3">Name</th>
                                                                                                <th class="ps-3">Email Address</th>
                                                                                                <th class="ps-3">Contact No</th>
                                                                                                <th class="ps-3">Status</th>
                                                                                                <th class="ps-2">Actions</th>
                                                                                          </tr>
                                                                                    </thead>
                                                                                    <tbody class="table-border-bottom-0 ">
                                                                                          <?php
                                                                                          $page = 1;
                                                                                          $number_per_page = 10;
                                                                                          $offset = ($page - 1) * $number_per_page;
                                                                                          $pagination = DB::search("SELECT * FROM `students`");
                                                                                          $no_rows = $pagination->num_rows;
                                                                                          $no_of_page = $no_rows / $number_per_page;
                                                                                          if ($no_rows % $number_per_page != 0) {
                                                                                                $no_of_page = $no_of_page + 1;
                                                                                          }

                                                                                          $no_of_page = intval($no_of_page);

                                                                                          $reult = DB::search("SELECT * FROM `admins` LIMIT $number_per_page OFFSET $offset");


                                                                                          for ($i = 0; $i < $reult->num_rows; $i++) {
                                                                                                $d = $reult->fetch_assoc();
                                                                                          ?>
                                                                                                <tr>
                                                                                                      <td><?php echo $i + 1 + $offset ?></td>

                                                                                                      <td>
                                                                                                            <span>
                                                                                                                  <?php
                                                                                                                  if (empty($d["path"])) {
                                                                                                                  ?>
                                                                                                                        <img src="../../image/profile/admin-default.png" alt="Avatar" class="rounded-circle" style="width: 40px;">

                                                                                                                  <?php
                                                                                                                  } else {
                                                                                                                  ?>
                                                                                                                        <img src="../../image/profile/<?php echo $d["path"] ?>" alt="Avatar" class="rounded-circle" style="width: 40px;">

                                                                                                                  <?php
                                                                                                                  }
                                                                                                                  ?>
                                                                                                            </span>
                                                                                                            &nbsp;
                                                                                                            <span class="fw-bold text-capitalize"><?php echo $d["username"] ?></span>
                                                                                                      </td>
                                                                                                      <td><?php echo ucwords($d["fname"] . " " . $d["lname"]) ?></td>
                                                                                                      <td><?php echo $d["email"] ?></td>
                                                                                                      <td>
                                                                                                            <?php echo $d["contact"] ?>
                                                                                                      </td>
                                                                                                      <td>
                                                                                                            <?php
                                                                                                            if ($d["state"] == "Pending") {
                                                                                                            ?>
                                                                                                                  <span class="badge bg-label-warning me-1">Pending</span>

                                                                                                            <?php
                                                                                                            } else if ($d["state"] == "Verified") {
                                                                                                            ?>
                                                                                                                  <span class="badge bg-label-success me-1">Verified</span>

                                                                                                            <?php
                                                                                                            } else if ($d["state"] == "Blocked") {
                                                                                                            ?>
                                                                                                                  <span class="badge bg-label-danger me-1">Blocked</span>

                                                                                                            <?php
                                                                                                            }
                                                                                                            ?>
                                                                                                      </td>
                                                                                                      <td>
                                                                                                            <div class="dropdown">
                                                                                                                  <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                                                                        <i class="bx bx-dots-vertical-rounded"></i>
                                                                                                                  </button>
                                                                                                                  <div class="dropdown-menu">
                                                                                                                        <a class="dropdown-item" id="showmorebtn<?php echo $i; ?>" onclick="showMore(<?php echo $i; ?>);"><i class='bx bx-show-alt'></i></i> See More</a>

                                                                                                                        <a class="dropdown-item" href="admin-edit.php?uid=<?php echo $d["uid"] ?>&title=admin"><i class="bx bx-edit-alt me-1"></i> Edit</a>

                                                                                                                  </div>
                                                                                                            </div>
                                                                                                      </td>
                                                                                                </tr>
                                                                                                <tr class="d-none advaViewUser" id="advancedetails<?php echo $i; ?>">
                                                                                                      <td colspan="7">
                                                                                                            <table cellpadding="5" cellspacing="0" style="width:100%;">
                                                                                                                  <tbody>
                                                                                                                        <tr class="expanded-row">
                                                                                                                              <td colspan="8" class="row-bg">
                                                                                                                                    <div>
                                                                                                                                          <div class="d-flex justify-content-between">
                                                                                                                                                <div class="expanded-table-normal-cell ">
                                                                                                                                                      <div class="">
                                                                                                                                                            <p>Name</p>
                                                                                                                                                            <h6> <?php if ($d["gen"] == "Male") {
                                                                                                                                                                        echo "Mr.";
                                                                                                                                                                  } else {
                                                                                                                                                                        echo "Mrs.";
                                                                                                                                                                  }
                                                                                                                                                                  echo $d["fulname"] ?></h6>
                                                                                                                                                      </div>

                                                                                                                                                </div>
                                                                                                                                                <div class="expanded-table-normal-cell ">
                                                                                                                                                      <div class="">
                                                                                                                                                            <p>NIC</p>
                                                                                                                                                            <h6><?php echo $d["nic_no"] ?></h6>
                                                                                                                                                      </div>

                                                                                                                                                </div>
                                                                                                                                                <div class="expanded-table-normal-cell">

                                                                                                                                                      <div class="">
                                                                                                                                                            <p>Reg Date</p>
                                                                                                                                                            <h6><?php echo $d["reg_date"] ?></h6>
                                                                                                                                                      </div>
                                                                                                                                                </div>
                                                                                                                                                <div class="expanded-table-normal-cell">

                                                                                                                                                      <div class="">
                                                                                                                                                            <p>Gender</p>

                                                                                                                                                            <h6>
                                                                                                                                                                  <?php if ($d["gen"] == "Male") {
                                                                                                                                                                        echo "Male";
                                                                                                                                                                  } else {
                                                                                                                                                                        echo "Female.";
                                                                                                                                                                  }
                                                                                                                                                                  ?></h6>
                                                                                                                                                      </div>
                                                                                                                                                </div>
                                                                                                                                                <div class="expanded-table-normal-cell">
                                                                                                                                                      <div class=" ">
                                                                                                                                                            <p>Address</p>

                                                                                                                                                            <h6><?php if (empty($d["address_line"])) {
                                                                                                                                                                        echo "None";
                                                                                                                                                                  } else {
                                                                                                                                                                        echo $d["address_line"] . ", " . $d["city"] . " " . $d["district"];
                                                                                                                                                                  } ?></h6>
                                                                                                                                                      </div>
                                                                                                                                                </div>
                                                                                                                                                <?php
                                                                                                                                                if ($d["uid"] != $_SESSION["admin"]["uid"]) {

                                                                                                                                                ?>
                                                                                                                                                      <div class="expanded-table-normal-cell">
                                                                                                                                                            <?php
                                                                                                                                                            if ($d["state"] == "Blocked") {
                                                                                                                                                            ?>
                                                                                                                                                                  <button class="btn btn-rounded rounded-circle  btn-icon p-2 text-white unloackbtn" id="lock" onclick="unblockA(<?php echo $d['uid']; ?>,<?php echo $page ?>);">
                                                                                                                                                                        <i class='bx bx-lock-open-alt'></i>
                                                                                                                                                                  </button>
                                                                                                                                                            <?php
                                                                                                                                                            } else {
                                                                                                                                                            ?>
                                                                                                                                                                  <button class="btn btn-rounded rounded-circle  btn-icon p-2 text-white" id="lock" onclick="openBlockCom(<?php echo $d['uid']; ?>,<?php echo $page ?>,'a');" style="background-color: #EC255A;">
                                                                                                                                                                        <i class=' bx bxs-lock-alt'></i>

                                                                                                                                                                  </button>
                                                                                                                                                            <?php
                                                                                                                                                            }
                                                                                                                                                            ?>
                                                                                                                                                      </div>
                                                                                                                                                <?php
                                                                                                                                                }
                                                                                                                                                ?>

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
                                                                                                <a class="page-link" href="javascript:void(0);" onclick="searchAdmin(<?php echo $page - 1 ?>);"><i class="tf-icon bx bx-chevrons-left"></i></a>
                                                                                          </li>
                                                                                          <?php
                                                                                    }

                                                                                    for ($p = 1; $p <= $no_of_page; $p++) {
                                                                                          if ($page == $p) {
                                                                                          ?>
                                                                                                <li class="page-item active">
                                                                                                      <a class="page-link" href="javascript:void(0);" onclick="searchAdmin(<?php echo $p  ?>);"><?php echo $p ?></a>
                                                                                                </li>
                                                                                          <?php
                                                                                          } else {
                                                                                          ?>
                                                                                                <li class="page-item">
                                                                                                      <a class="page-link" href="javascript:void(0);" onclick="searchAdmin(<?php echo $p ?>);"><?php echo $p ?></a>
                                                                                                </li>
                                                                                          <?php
                                                                                          }
                                                                                    }
                                                                                    if ($no_of_page != $page && $no_of_page != 0) {
                                                                                          ?>
                                                                                          <li class="page-item next">
                                                                                                <a class="page-link" href="javascript:void(0);" onclick="searchAdmin(<?php echo $page + 1 ?>);"><i class="tf-icon bx bx-chevrons-right"></i></a>
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


                                          <div class="modal fade " id="blockMod" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog">
                                                <div class="modal-dialog modal-dialog-centered">
                                                      <div class="modal-content">
                                                            <div class="modal-header">
                                                                  <h5 class="modal-title" id="modalToggleLabel">Confirmation</h5>
                                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body"> Are your sure you want to block this teacher?</div>
                                                            <div class="modal-footer">
                                                                  <button class="btn btn-secondary" data-bs-target="#modalToggle2" data-bs-toggle="modal" data-bs-dismiss="modal">
                                                                        No
                                                                  </button>
                                                                  <button class="btn btn-danger" id="blockbtn">
                                                                        Yes
                                                                  </button>
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