<?php
session_start();
require "../../connection/connection.php";

if (isset($_SESSION["teacher"])) {
    $day = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $day->setTimezone($tz);
    $date = $day->format("Y-m-d");

    $teacherId = $_SESSION["teacher"]["uid"];
?>
    <!DOCTYPE html>


    <!-- beautify ignore:start -->
<html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    
        <title>Teacher | Dashboard</title>

    <?php
    require "headLink.php";
    ?>
    <link rel="stylesheet" href="../../css/eventcalender.css">

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

                    <div class="container-xxl flex-grow-1 container-p-y" >



                        <div class="row" id="contentBox">


                            <!-- event calender -->
                            <div class="col-md-6 col-lg-4 order-1  mb-4">
                                <div class="card h-100">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="card-title m-0 me-2">Event Calender</h5>
                                        <button class="btn p-0" type="button" id="event-btn">
                                                <!-- <i class='bx bx-calendar-plus'></i> Add -->
                                            </button>
                                        <!-- <div class="dropdown"> -->
                                  
                                        <!-- <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                                                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
                                            </div> -->
                                        <!-- </div> -->
                                    </div>
                                    <div class="card-body " style="max-height: 370px;min-height: 370px;">
                                        <?php
                                        require "../../com/calender.php";

                                        ?>
                                    </div>
                                </div>
                            </div>
                            <!--/ event calender -->

                            <!-- notification -->
                            <div class="col-md-6 col-lg-4 order-2 order-lg-3 mb-4">
                                <div class="card h-100">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="card-title m-0 me-2">Notification</h5>
                                        
                                    </div>
                                    <div class="card-body overflow-auto scrollbar" style="max-height: 375px;">
                                        <ul class="p-0 m-0">

                                        <?php
                                        $noti = DB::search("SELECT * FROM `notification` WHERE `user_type` IN (3,6) ORDER BY noti_id DESC LIMIT 5");
                                        if ($noti->num_rows >= 1) {
                                            for ($i = 0; $i < $noti->num_rows; $i++) {
                                                $notiD = $noti->fetch_assoc();
                                        ?>
                                                        <li class="d-flex mb-4 pb-1">
                                                            <div class="avatar flex-shrink-0 me-3">
                                                                <img src="../../assets/img/icons/unicons/notification.png" alt="User" class="rounded" />
                                                            </div>
                                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                <div class="me-2">
                                                                    <small class="text-muted d-block mb-1"><?php echo $notiD["topic"] ?></small>
                                                                    <h6 class="mb-0"><?php echo $notiD["notify"] ?></h6>
                                                                </div>

                                                            </div>
                                                        </li>
                                                    <?php
                                                }
                                            } else {
                                                    ?>
                                                    <div class="text-center mt-5 text-black">No Notification</div>

                                                <?php
                                            }
                                                ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--/ Notification -->





                            <!--start Announcment -->
                            <div class="col-md-6 col-lg-4 order-3 order-lg-2  mb-4">
                                <div class="card h-100">
                                    <div class="card-header d-flex align-items-center justify-content-between">
                                        <h5 class="card-title m-0 me-2">Announcement</h5>
                                       
                                    </div>
                                    <div class="card-body overflow-auto RecentActivity" style="max-height: 375px;">
                                        <ul class="activity-notice pe-2">
                                        <?php
                                        $anno = DB::search("SELECT * FROM `announcement` WHERE `user_type` IN (3,6)");
                                        if ($anno->num_rows >= 1) {
                                            for ($i = 0; $i < $anno->num_rows; $i++) {
                                                $annoD = $anno->fetch_assoc();
                                        ?>
                                                        <li class="notice-item">
                                                            <span class="notice-text text-start"><?php echo $annoD["annouce"] ?></span>
                                                            <span class="notice-date text-end"><?php echo $annoD["date_add"] ?></span>


                                                        </li>
                                                    <?php
                                                }
                                            } else {
                                                    ?>
                                                    <div class="text-center mt-5 text-black">No Announcement</div>

                                                <?php
                                            }
                                                ?>

                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!--end Announcment -->

                            <!-- Active Assignments  -->
                            <div class="col-12 col-lg-8 order-5 order-lg-4 mb-4">
                                <div class="card h-100">
                                    <h5 class="card-header">Active Assignments</h5>
                                    <div class="table-responsive text-nowrap h-100 overflow-auto pendingTeacher" style="min-height: 200px;max-height: 375px;">
                                        <table class="table table-hover">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Assignment Id</th>
                                                    <th>Title</th>

                                                    <th>Status</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody class="table-border-bottom-0">
                                                <?php
                                                $have = true;

                                                $result = DB::search("SELECT * FROM `assingment_view`  WHERE `uid`='" . $teacherId . "'  LIMIT 5");
                                                for ($i = 0; $i < $result->num_rows; $i++) {
                                                    $d = $result->fetch_assoc();
                                                    if ($date >= $d["start_date"] && $date <= $d["end_date"]) {
                                                        $haveActAs = false;

                                                ?>                                                  
                                                   <tr>
                                                        <td><?php echo $i + 1  ?></td>
                                                        <td><?php echo $d["assignment_id"]; ?></td>
                                                        <td><?php echo $d["title"]; ?></td>

                                                        <td><span class="badge bg-label-success me-1">Active</span></td>

                                                     
                                                        <td>
                                                            <div class="dropdown">
                                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                                </button>
                                                                <div class="dropdown-menu">
                                                                <a class="dropdown-item" href="../../doc/assignment/<?php echo $d["file_path"]  ?>" target="_blank"><i class='bx bx-show-alt'></i> View</a>

                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    
                                                <?php
                                                    }
                                                }
                                                if ($have) {
                                                ?>
                                                        <tr>
                                                              <td colspan="5" class="text-center">
                                                                  No Active Assignments
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

                            <!-- Active Assignments  -->

                          
                            
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

    <!-- Vendors JS -->
    <script src="../../assets/vendor/libs/apex-charts/apexcharts.js"></script>

    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>

    
    <!-- Place this tag in your head or just before your close body tag. -->
    <script async defer src="https://buttons.github.io/buttons.js"></script>

    <!-- my java script  -->
    <script src="../js/teacher.js"></script>
    <script src="../../js/script.js"></script>

</body>

</html>
<?php
} else {
?>
<script>
    window.location="../../login/gui/teacher-login.php";
</script>
    <?php
}
    ?>