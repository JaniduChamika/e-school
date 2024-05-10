<?php
session_start();
require "../../connection/connection.php";

if (isset($_SESSION["officer"])) {

?>
    <!DOCTYPE html>

    <html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

        <title>Officer | Dashboard</title>

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
                    require "officerSidebar.php";
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
                                                $noti = DB::search("SELECT * FROM `notification` WHERE `user_type` IN (4,6) ORDER BY noti_id DESC LIMIT 5");
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
                                                $anno = DB::search("SELECT * FROM `announcement` WHERE `user_type` IN (4,6)");
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

                                <!-- pandeing Student  -->
                                <div class="col-12 col-lg-8 order-5 order-lg-4 mb-4">
                                    <div class="card h-100">
                                        <h5 class="card-header">Pendding Student</h5>
                                        <div class="table-responsive text-nowrap h-100 overflow-auto pendingTeacher" style="min-height: 200px;max-height: 375px;">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Name</th>
                                                        <th>Contact No</th>

                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    <?php
                                                    $pendingS = DB::search("SELECT * FROM `students` WHERE `state`='Pending'");

                                                    if ($pendingS->num_rows > 0) {

                                                        for ($i = 0; $i < $pendingS->num_rows; $i++) {
                                                            $data = $pendingS->fetch_assoc();
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $i + 1 ?></td>
                                                                <td><?php echo $data["fulname"] ?></td>
                                                                <td><?php echo $data["contact"] ?></td>

                                                                <td><span class="badge bg-label-warning me-1">Pending</span></td>



                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item" href="#" onclick="resendInvite(<?php echo $data['uid'] ?>);"><i class='bx bxs-send'></i></i> Resend Invitation</a>

                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td colspan="6" class="text-center" style="height: 280px;">
                                                                No Pending Students
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
                                <!-- /pandeing Student  -->




                                <!-- mark releasd request  -->
                                <div class="col-12 col-lg-8 order-5 order-lg-5 mb-4">
                                    <div class="card h-100">
                                        <h5 class="card-header">Marks Realesd Requests</h5>
                                        <div class="table-responsive text-nowrap h-100 overflow-auto pendingTeacher" style="min-height: 200px;max-height: 375px;">
                                            <table class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Assignment ID</th>
                                                        <th>Student Name</th>

                                                        <th>Status</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-border-bottom-0">
                                                    <?php
                                                    $result = DB::search("SELECT * FROM `stu_assignment_awnser`  WHERE `status`!='3' LIMIT 5");
                                                    if ($result->num_rows >= 1) {

                                                        for ($i = 0; $i < $result->num_rows; $i++) {
                                                            $d = $result->fetch_assoc();
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $i + 1 ?></td>
                                                                <td><?php echo $d["assignment_id"] ?></td>
                                                                <th><?php echo $d["stu_fulname"] ?></th>

                                                                <td><span class="badge bg-label-warning me-1">Pending</span></td>



                                                                <td>
                                                                    <div class="dropdown">
                                                                        <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                                        </button>
                                                                        <div class="dropdown-menu">
                                                                            <a class="dropdown-item" href="javascript:void(0);"><i class='bx bx-show-alt'></i> View Result Sheet</a>
                                                                            <a class="dropdown-item" href="javascript:void(0);"><i class='bx bx-send'></i> Release Marks</a>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                    } else {
                                                        ?>
                                                        <tr>
                                                            <td colspan="6" class="text-center" style="height: 280px;">
                                                                No Pending Assignment Marks
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
                                <!-- /mark releasd request  -->
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
        <script src="../../js/script.js"></script>
        <script src="../js/officer.js"></script>

    </body>

    </html>
<?php
} else {
?>
    <script>
        window.location = "../../login/gui/officer-login.php";
    </script>
<?php
}
?>