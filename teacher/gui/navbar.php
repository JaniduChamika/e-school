<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme" id="layout-navbar">
    <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
        <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
            <i class="bx bx-menu bx-sm"></i>
        </a>
    </div>

    <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
        <!-- Search -->
        <div class="navbar-nav align-items-center">
            <div class="nav-item d-flex align-items-center">
                <i class="bx bx-search fs-4 lh-0"></i>
                <?php
                $curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);
                if ($curPageName == "assignments-list.php") {
                ?>
                    <input type="text" class="form-control border-0 shadow-none" id="seachbar" onkeyup="searchAssingment(1);" placeholder="Search..." aria-label="Search..." />

                <?php
                } else if ($curPageName == "student-anwser-sheet.php") {
                ?>
                    <input type="text" class="form-control border-0 shadow-none" id="seachbar" onkeyup="searchAnswerSheet(1);" placeholder="Search..." aria-label="Search..." />

                <?php
                } else if ($curPageName == "assignment-marks.php") {
                ?>
                    <input type="text" class="form-control border-0 shadow-none" id="seachbar" onkeyup="searchAssignmentMarks(1);" placeholder="Search..." aria-label="Search..." />

                <?php
                } else if ($curPageName == "note-list.php") {
                ?>
                    <input type="text" class="form-control border-0 shadow-none" id="seachbar" onkeyup="searchNote(1);" placeholder="Search..." aria-label="Search..." />

                <?php
                } else if ($curPageName == "my-class.php") {
                ?>
                    <input type="text" class="form-control border-0 shadow-none" id="seachbar" onkeyup="searchMyclass(1);" placeholder="Search..." aria-label="Search..." />

                <?php
                } else {
                ?>
                    <input type="text" class="form-control border-0 shadow-none" id="seachbar" placeholder="Search..." aria-label="Search..." disabled />

                <?php
                }
                ?>
            </div>
        </div>
        <!-- /Search -->

        <ul class="navbar-nav flex-row align-items-center ms-auto">
            <!-- Place this tag where you want the button to render. -->
            <!-- <li class="nav-item lh-1 me-3">
                                <a class="github-button" href="https://github.com/themeselection/sneat-html-admin-template-free" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star themeselection/sneat-html-admin-template-free on GitHub">Star</a>
                            </li> -->

            <!-- User -->
            <li class="nav-item navbar-dropdown dropdown-user dropdown">
                <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                    <div class="avatar avatar-online">
                        <?php
                        $imgp = DB::search("SELECT * FROM `profile_image` WHERE `user_uid`='" . $_SESSION["teacher"]["uid"] . "'");
                        $imgd;
                        if ($imgp->num_rows == 1) {
                            $imgd = $imgp->fetch_assoc();
                        ?>
                            <img src="../../image/profile/<?php echo $imgd["path"]  ?>" alt class="w-px-40 h-auto rounded-circle" />

                        <?php
                        } else {
                        ?>
                            <img src="../../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />

                        <?php
                        }
                        ?>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    <li>
                        <a class="dropdown-item" href="#">
                            <div class="d-flex">
                                <div class="flex-shrink-0 me-3">
                                    <div class="avatar avatar-online">
                                        <?php
                                        if ($imgp->num_rows == 1) {

                                        ?>
                                            <img src="../../image/profile/<?php echo $imgd["path"]  ?>" alt class="w-px-40 h-auto rounded-circle" />

                                        <?php
                                        } else {
                                        ?>
                                            <img src="../../assets/img/avatars/1.png" alt class="w-px-40 h-auto rounded-circle" />

                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                                <div class="flex-grow-1">
                                    <?php
                                    if (isset($_SESSION["teacher"])) {
                                        $user = $_SESSION["teacher"];

                                    ?>
                                        <span class="fw-semibold d-block"><?php echo ucwords($user["fname"] . " " . $user["lname"]) ?></span>


                                        <small class="text-muted">Teacher</small>
                                    <?php

                                    }

                                    ?>
                                </div>
                            </div>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="profile.php?page=profile">
                            <i class="bx bx-user me-2"></i>
                            <span class="align-middle">My Profile</span>
                        </a>
                    </li>

                    <li>
                        <a class="dropdown-item" href="#">
                            <span class="d-flex align-items-center align-middle">
                                <i class="flex-shrink-0 bx bx-bell me-2"></i>
                                <span class="flex-grow-1 align-middle">Notification</span>
                                <span class="flex-shrink-0 badge badge-center rounded-pill bg-danger w-px-20 h-px-20">
                                    <?php
                                    $noti = DB::search("SELECT * FROM `notification` WHERE `user_type` IN (3)");
                                    echo $noti->num_rows;
                                    ?>
                                </span>
                            </span>
                        </a>
                    </li>
                    <li>
                        <div class="dropdown-divider"></div>
                    </li>
                    <li>
                        <a class="dropdown-item" href="../../login/backend/logout.php">
                            <i class="bx bx-power-off me-2"></i>
                            <span class="align-middle">Log Out</span>
                        </a>
                    </li>
                </ul>
            </li>
            <!--/ User -->
        </ul>
    </div>
</nav>
<div id="tostbox">
    <div class="bs-toast toast toast-placement-ex m-2 fade bg-info bottom-0 start-0 shadow-none mytost" id="tostdiv" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">
        <div class="toast-header">
            <i class="bx bx-bell me-2"></i>
            <div class="me-auto fw-semibold">Bootstrap</div>
            <small>Just Now</small>
            <button type="button" class="btn-close shadow-none" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body" id="contentTost">Fruitcake chocolate bar tootsie roll gummies gummies jelly beans cake.</div>


    </div>
</div>