<?php
session_start();
require "../../connection/connection.php";

// check admin is loged 
if (isset($_SESSION["admin"])) {

    $day = new DateTime();
    $tz = new DateTimeZone("Asia/Colombo");
    $day->setTimezone($tz);
    $date = $day->format("Y-m-d H:i:s");
    $year = $day->format("Y");
?>
    <!DOCTYPE html>


    <html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

        <title>Admin | Dashboard</title>

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

                                <div class="col-lg-4 col-md-12 col-lg-6 order-1">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-6 mb-4">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-start justify-content-between">
                                                        <div class="avatar flex-shrink-0">

                                                            <img src="../../assets/img/icons/unicons/student.png" alt="chart success" class="rounded" />
                                                        </div>
                                                        <div class="dropdown">
                                                            <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                                                                <a class="dropdown-item" href="student-list.php?title=student&page=list-students">See More</a>
                                                                <a class="dropdown-item" href="student-registration.php?title=student&page=register-students">Register</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span class="fw-semibold d-block mb-1">Students</span>
                                                    <?php

                                                    $stu = DB::search("SELECT * FROM `students`");
                                                    $studnt = $stu->num_rows;
                                                    $pendingS = DB::search("SELECT * FROM `students` WHERE `state`='Pending'");
                                                    ?>
                                                    <h3 class="card-title mb-2"><?php echo $studnt ?></h3>
                                                    <?php
                                                    if ($pendingS->num_rows == 0) {
                                                    ?>
                                                        <small class="text-success fw-semibold"><i class='bx bx-check'></i> All Verified</small>
                                                    <?php

                                                    } else {
                                                    ?>
                                                        <small class="text-warning fw-semibold"><i class='bx bx-loader'></i>

                                                            <?php
                                                            echo $pendingS->num_rows;
                                                            ?>
                                                            Pending</small>

                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-6 mb-4">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-start justify-content-between">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="../../assets/img/icons/unicons/teacher.png" alt="Credit Card" class="rounded" />
                                                        </div>
                                                        <div class="dropdown">
                                                            <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                                                                <a class="dropdown-item" href="teachers-list.php? title=teacher&page=list-teacher">See More</a>
                                                                <a class="dropdown-item" href="teacher-ragistration.php?title=teacher&page=register-teacher">Register</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span>Teachers</span>
                                                    <?php

                                                    $tec = DB::search("SELECT * FROM `teachers`");
                                                    $tech = $tec->num_rows;
                                                    $pendingT = DB::search("SELECT * FROM `teachers` WHERE `state`='Pending'");
                                                    ?>
                                                    <h3 class="card-title mb-2"><?php echo $tech ?></h3>
                                                    <?php
                                                    if ($pendingT->num_rows == 0) {
                                                    ?>
                                                        <small class="text-success fw-semibold"><i class='bx bx-check'></i> All Verified</small>
                                                    <?php

                                                    } else {
                                                    ?>
                                                        <small class="text-warning fw-semibold"><i class='bx bx-loader'></i>

                                                            <?php
                                                            echo $pendingT->num_rows;
                                                            ?>
                                                            Pending</small>

                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-12 col-lg-6 order-2 order-md-2">
                                    <div class="row">
                                        <div class="col-6 mb-4">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-start justify-content-between">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="../../assets/img/icons/unicons/admin.png" alt="Credit Card" class="rounded" />
                                                        </div>
                                                        <div class="dropdown">
                                                            <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                                                                <a class="dropdown-item" href="admin-list.php?title=admin&page=list-admin">See More</a>
                                                                <a class="dropdown-item" href="admin-registration.php?title=admin&page=register-adminv">Register</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span>Admin</span>

                                                    <?php

                                                    $ad = DB::search("SELECT * FROM `admins`");
                                                    $adno = $ad->num_rows;
                                                    $pending = DB::search("SELECT * FROM `admins` WHERE `state`='Pending'");
                                                    ?>
                                                    <h3 class="card-title mb-2"><?php echo $adno ?></h3>
                                                    <?php
                                                    if ($pending->num_rows == 0) {
                                                    ?>
                                                        <small class="text-success fw-semibold"><i class='bx bx-check'></i> All Verified</small>
                                                    <?php

                                                    } else {
                                                    ?>
                                                        <small class="text-warning fw-semibold"><i class='bx bx-loader'></i>

                                                            <?php
                                                            echo $pending->num_rows;
                                                            ?>
                                                            Pending</small>

                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 mb-4">
                                            <div class="card h-100">
                                                <div class="card-body">
                                                    <div class="card-title d-flex align-items-start justify-content-between">
                                                        <div class="avatar flex-shrink-0">
                                                            <img src="../../assets/img/icons/unicons/officer.png" alt="Credit Card" class="rounded" />
                                                        </div>
                                                        <div class="dropdown">
                                                            <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="bx bx-dots-vertical-rounded"></i>
                                                            </button>
                                                            <div class="dropdown-menu" aria-labelledby="cardOpt1">
                                                                <a class="dropdown-item" href="officer-list.php?title=officer&page=list-Officers">See More</a>
                                                                <a class="dropdown-item" href="officer-registration.php?title=officer&page=register-Officers">Register</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <span>Academic Officer</span>

                                                    <?php

                                                    $of = DB::search("SELECT * FROM `officers`");
                                                    $offi = $of->num_rows;
                                                    $pendingO = DB::search("SELECT * FROM `officers` WHERE `state`='Pending'");
                                                    ?>
                                                    <h3 class="card-title mb-2"><?php echo $offi ?></h3>
                                                    <?php
                                                    if ($pendingO->num_rows == 0) {
                                                    ?>
                                                        <small class="text-success fw-semibold"><i class='bx bx-check'></i> All Verified</small>
                                                    <?php

                                                    } else {
                                                    ?>
                                                        <small class="text-warning fw-semibold"><i class='bx bx-loader'></i>

                                                            <?php
                                                            echo $pendingO->num_rows;
                                                            ?>
                                                            Pending</small>

                                                    <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>

                            <div class="row">

                                <!-- Enrollment Fee -->
                                <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
                                    <div class="card h-100">
                                        <div class="card-header d-flex align-items-center justify-content-between pb-0">
                                            <?php

                                            ?>
                                            <div class="card-title mb-0">
                                                <h5 class="m-0 me-2">Enrollment Fee </h5>
                                                <small class="text-muted">1000 Total Student</small>
                                            </div>

                                            <button class="btn p-0" type="button" id="refershbutton" onclick="refreshEnrollment();">

                                                <i class='bx bx-refresh'></i>
                                            </button>

                                        </div>
                                        <div class="card-body " id="enrolmentbody">
                                            <div class="d-flex justify-content-between align-items-center mb-3">
                                                <div class="d-flex flex-column align-items-center gap-1">
                                                    <h2 class="mb-2" id="noStu">
                                                        <?php
                                                        $payment = DB::search("SELECT * FROM `student_payment` LEFT JOIN `students` ON `student_payment`.`user_uid`=`students`.`uid` WHERE `pay_dtime` LIKE '" . $year . "%'   ORDER BY `student_payment`.`pay_dtime`  DESC ");
                                                        echo $payrow = $payment->num_rows;

                                                        ?>

                                                    </h2>
                                                    <span id="titlepaid">Total Paid Students</span>
                                                    <input id="paidstu" value="<?php echo $payrow  ?>" class="d-none" />
                                                    <input id="totstu" value=" <?php echo $studnt ?>" class="d-none" />
                                                </div>
                                                <div id="orderStatisticsChart"></div>




                                            </div>
                                            <div class="d-flex  overflow-auto scrollbar" style="max-height: 250px;">

                                                <ul class="p-0 m-0">

                                                    <?php

                                                    for ($i = 0; $i < $payrow && $i < 5; $i++) {
                                                        $paydata = $payment->fetch_assoc();
                                                    ?>
                                                        <li class="d-flex mb-4 pb-1">
                                                            <div class="avatar flex-shrink-0 me-3">

                                                                <img src="../../image/profile/<?php echo $paydata["path"] ?>" alt="chart success" class="rounded" />
                                                            </div>
                                                            <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                                                                <div class="me-2">
                                                                    <h6 class="mb-0"><?php echo ucwords($paydata["fname"] . " " . $paydata["lname"]) ?></h6>
                                                                    <small class="text-muted">Grade <?php echo $paydata["grade"] ?> (online payment)</small>
                                                                </div>
                                                                <div class="user-progress">
                                                                    <small class="fw-semibold">Rs <?php echo $paydata["total"] ?>.00</small>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    <?php
                                                    }
                                                    ?>



                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <!--/ Enrollment Fee -->

                                <!-- event calender -->
                                <div class="col-md-6 col-lg-4 order-1  mb-4">
                                    <div class="card h-100">
                                        <div class="card-header d-flex align-items-center justify-content-between">
                                            <h5 class="card-title m-0 me-2">Event Calender</h5>
                                            <div>
                                                <button class="btn p-0" type="button" id="event-btn">

                                                </button>
                                                <button class="btn p-0" type="button" onclick="showAddEveMod();">
                                                    <i class='bx bx-calendar-plus'></i> Add
                                                </button>
                                            </div>


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

                                                $noti = DB::search("SELECT * FROM `notification` WHERE `user_type` IN (1,5,6) ORDER BY noti_id DESC LIMIT 5");
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
                                            <div class="dropdown">
                                                <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="bx bx-dots-vertical-rounded"></i>
                                                    <!-- <i class='bx bx-message-square-add'></i> -->
                                                </button>
                                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                                                    <a class="dropdown-item" href="#" onclick="showAddAnnounce();">Add</a>
                                                    <a class="dropdown-item" href="#">Edit</a>
                                                    <!-- <a class="dropdown-item" href="javascript:void(0);">Last Month</a> -->
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body overflow-auto RecentActivity" style="max-height: 375px;">
                                            <ul class="activity-notice pe-2" id="anonceBox">
                                                <?php
                                                $anno = DB::search("SELECT * FROM `announcement` INNER JOIN `user_type` ON `announcement`.`user_type`=`user_type`.`utid` ORDER BY `an_id` DESC");
                                                if ($anno->num_rows >= 1) {
                                                    for ($i = 0; $i < $anno->num_rows; $i++) {
                                                        $annoD = $anno->fetch_assoc();
                                                ?>
                                                        <li class="notice-item">
                                                            <table class="w-100">
                                                                <tr>
                                                                    <td>
                                                                        <h6 class="notice-text text-start mb-0 fw-bold"><?php echo $annoD["type"] ?> </h6>
                                                                        <span class="notice-text text-start"><?php echo $annoD["annouce"] ?> </span>
                                                                        <span class="notice-date text-start"><?php echo $annoD["date_add"] ?></span>

                                                                    </td>
                                                                    <td class="text-end">
                                                                        <button class="btn btn-sm btn-danger" onclick="deleteAnnoce(<?php echo $annoD['an_id'] ?>);"><i class='bx bxs-trash'></i></button>

                                                                    </td>
                                                                </tr>
                                                            </table>

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

                                <!-- pandeing teachers  -->
                                <div class="col-12 col-lg-8 order-5 order-lg-4 mb-4">
                                    <div class="card h-100">
                                        <h5 class="card-header">Pendding Teachers</h5>
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
                                                    if ($pendingT->num_rows > 0) {

                                                        for ($i = 0; $i < $pendingT->num_rows; $i++) {
                                                            $data = $pendingT->fetch_assoc();
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
                                                                No Pending Officers
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

                                <!-- /pandeing teachers  -->

                                <!-- pandeing officer  -->
                                <div class="col-12 col-lg-8 order-5 order-lg-4  mb-4">
                                    <div class="card h-100">
                                        <h5 class="card-header">Pendding Officers</h5>
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
                                                    if ($pendingO->num_rows > 0) {


                                                        for ($i = 0; $i < $pendingO->num_rows; $i++) {
                                                            $data = $pendingO->fetch_assoc();
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $i + 1 ?></td>
                                                                <td><?php echo $data["fulname"] ?></td>
                                                                <td><?php echo $data["username"] ?></td>
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
                                                                No Pending Officers
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
                                <!-- /pandeing officer  -->

                                <div class="modal fade" id="anncounceMod" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog">
                                    <div class="modal-dialog">
                                        <form class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="backDropModalTitle">Add Announcement</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="Assigntecher" class="form-label">Crowds</label>

                                                        <select id="crowds" class="form-select">
                                                            <option value="0">Select Crowd</option>
                                                            <?php

                                                            $reult = DB::search("SELECT * FROM `user_type` WHERE `utid`!='1' ");

                                                            for ($i = 0; $i < $reult->num_rows; $i++) {
                                                                $d = $reult->fetch_assoc();
                                                            ?>
                                                                <option value="<?php echo $d["utid"] ?>"><?php echo $d["type"] ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                        <textarea class="form-control mt-3" style="height: 100px;" id="annonce" placeholder="Announcement" spellcheck="true" autocomplete="on"></textarea>

                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" class="btn btn-info" id="AnnsubmitBtn" onclick="submitAnno();">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="modal fade" id="eventMod" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog">
                                    <div class="modal-dialog">
                                        <form class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="backDropModalTitle">Add Event</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col mb-3">
                                                        <label for="evdate" class="form-label">Date</label>
                                                        <input class="form-control" type="date" id="evdate">
                                                        <label for="evtime" class="form-label mt-1">Time</label>

                                                        <input class="form-control" type="time" id="evtime">
                                                        <label for="infotag" class="form-label mt-1">Topic</label>
                                                        <input class="form-control" type="text" id="infotag">
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                    Close
                                                </button>
                                                <button type="button" class="btn btn-info" id="AnnsubmitBtn" onclick="addEvent();">Save</button>
                                            </div>
                                        </form>
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

        <!-- Vendors JS -->
        <script src="../../assets/vendor/libs/apex-charts/apexcharts.js"></script>

        <!-- Main JS -->
        <script src="../../assets/js/main.js"></script>

        <!-- Page JS -->
        <script src="../../assets/js/dashboards-analytics.js"></script>

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