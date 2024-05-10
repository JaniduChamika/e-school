<div class="app-brand demo">
      <a href="../../index.php" class="app-brand-link">
            <span class="app-brand-logo demo">
                  <img src="../../image/logo/logo.png" width="38" />
                  <!-- logo  -->
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2">E-School</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
</div>

<div class="menu-inner-shadow"></div>
<ul class="menu-inner py-1">
      <?php



      $curPageName = substr($_SERVER["SCRIPT_NAME"], strrpos($_SERVER["SCRIPT_NAME"], "/") + 1);


      ?>
      <!-- Dashboard -->
      <li class="menu-item <?php if ($curPageName == "dashboard.php") {
                                    echo "active";
                              } ?>">
            <a href="dashboard.php" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-home-circle"></i>
                  <div>Dashboard</div>
            </a>
      </li>

      <!-- Layouts -->

      <li class="menu-header small text-uppercase ">
            <span class="menu-header-text">Payments</span>
      </li>

      <li class="menu-item <?php if ($curPageName == "enrollment-fee.php" || $curPageName == "student-payment.php") {
                                    echo "active open";
                              } ?>">
            <a href="#" class="menu-link menu-toggle">
                  <i class='menu-icon tf-icons bx bx-money'></i>

                  <div>Enrollment Fee</div>
            </a>


            <ul class="menu-sub">
                  <li class="menu-item <?php if ($curPageName == "enrollment-fee.php") {
                                                echo "active";
                                          } ?>">
                        <a href="enrollment-fee.php" class="menu-link">
                              <div>Set Enrollment Fee</div>
                        </a>
                  </li>
                  <li class="menu-item <?php if ($curPageName == "student-payment.php") {
                                                echo "active";
                                          } ?>">
                        <a href="student-payment.php" class="menu-link">
                              <div>Student Fee</div>
                        </a>
                  </li>

            </ul>
      </li>


      <li class="menu-header small text-uppercase ">
            <span class="menu-header-text">User Management</span>
      </li>
      <li class="menu-item <?php if ($curPageName == "teachers-list.php" || $curPageName == "teacher-ragistration.php"|| $curPageName == "teacher-edit.php") {
                                    echo "active open";
                              } ?>">
            <a href="#" class="menu-link menu-toggle">
                  <i class='menu-icon tf-icons bx bx-book-reader'></i>
                  <div>Teachers</div>
            </a>
            <ul class="menu-sub">
                  <li class="menu-item <?php if ($curPageName == "teachers-list.php") {
                                                echo "active";
                                          } ?>">
                        <a href="teachers-list.php" class="menu-link">
                              <div>Teacher List</div>
                        </a>
                  </li>
                  <li class="menu-item <?php if ($curPageName == "teacher-ragistration.php") {
                                                echo "active";
                                          } ?>">
                        <a href="teacher-ragistration.php" class="menu-link">
                              <div>Register Teachers</div>
                        </a>
                  </li>
                  <!-- <li class="menu-item">
                  <a href="pages-account-settings-connections.html" class="menu-link">
                    <div data-i18n="Connections">Connections</div>
                  </a>
                </li> -->
            </ul>
      </li>
      <li class="menu-item <?php if ($curPageName == "officer-list.php" || $curPageName == "officer-registration.php"|| $curPageName == "officer-edit.php") {
                                    echo "active open";
                              } ?>">
            <a href="#" class="menu-link menu-toggle">
                  <i class='menu-icon tf-icons bx bx-glasses-alt'></i>
                  <div>Academic Officers</div>
            </a>
            <ul class="menu-sub">
                  <li class="menu-item <?php if ($curPageName == "officer-list.php") {
                                                echo "active";
                                          } ?>">
                        <a href="officer-list.php" class="menu-link">
                              <div>Officer List</div>
                        </a>
                  </li>
                  <li class="menu-item <?php if ($curPageName == "officer-registration.php") {
                                                echo "active";
                                          } ?>">
                        <a href="officer-registration.php" class="menu-link">
                              <div>Register Officers</div>
                        </a>
                  </li>
                  <!-- <li class="menu-item">
                  <a href="auth-forgot-password-basic.html" class="menu-link" >
                    <div data-i18n="Basic">Forgot Password</div>
                  </a>
                </li> -->
            </ul>
      </li>
      <li class="menu-item <?php if ($curPageName == "student-list.php" || $curPageName == "student-registration.php"|| $curPageName == "student-edit.php") {
                                    echo "active open";
                              } ?>">
            <a href="#" class="menu-link menu-toggle">
                  <i class='menu-icon tf-icons bx bxs-graduation'></i>
                  <div>Students</div>
            </a>
            <ul class="menu-sub">
                  <li class="menu-item <?php if ($curPageName == "student-list.php") {
                                                echo "active";
                                          } ?>">
                        <a href="student-list.php" class="menu-link">
                              <div>Student List</div>
                        </a>
                  </li>
                  <li class="menu-item <?php if ($curPageName == "student-registration.php") {
                                                echo "active";
                                          } ?>">
                        <a href="student-registration.php" class="menu-link">
                              <div>Register Students</div>
                        </a>
                  </li>
            </ul>
      </li>
      <?php

      if ($_SESSION["admin"]["user_type"] == 1) {

      ?>
            <li class="menu-item <?php if ($curPageName == "admin-list.php" || $curPageName == "admin-registration.php"|| $curPageName == "admin-edit.php") {
                                          echo "active open";
                                    } ?>">
                  <a href="#" class="menu-link menu-toggle">
                        <i class='menu-icon tf-icons bx bxs-binoculars'></i>
                        <div>Admin</div>
                  </a>
                  <ul class="menu-sub">
                        <li class="menu-item <?php if ($curPageName == "admin-list.php") {
                                                      echo "active";
                                                } ?>">
                              <a href="admin-list.php" class="menu-link">
                                    <div>Admin List</div>
                              </a>
                        </li>
                        <li class="menu-item <?php if ($curPageName == "admin-registration.php") {
                                                      echo "active";
                                                } ?>">
                              <a href="admin-registration.php" class="menu-link">
                                    <div>Register Admin</div>
                              </a>
                        </li>
                  </ul>
            </li>
      <?php
      }
      ?>

      <!-- Components -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">Primary Management</span></li>
      <!-- Cards -->
      <li class="menu-item <?php if ($curPageName == "1-5-class.php" || $curPageName == "6-11-class.php" || $curPageName == "al-class.php" || $curPageName == "add-class.php") {
                                    echo "active open";
                              } ?>">
            <a href="#" class="menu-link menu-toggle">
                  <i class='menu-icon tf-icons bx bxs-school'></i>
                  <div>Classes</div>
            </a>
            <ul class="menu-sub">
                  <?php
                  $result3g = DB::search("SELECT * FROM `grade` WHERE `gname` IN (1,2,3,4,5)");
                  if ($result3g->num_rows == 5) {
                  ?>
                        <li class="menu-item <?php if ($curPageName == "1-5-class.php") {
                                                      echo "active";
                                                } ?>">
                              <a href="1-5-class.php" class="menu-link">
                                    <div>1-5 Class List</div>
                              </a>
                        </li>
                  <?php
                  }
                  $result3g = DB::search("SELECT * FROM `grade` WHERE `gname` IN (6,7,8,9,10,11)");
                  if ($result3g->num_rows == 6) {
                  ?>
                        <li class="menu-item <?php if ($curPageName == "6-11-class.php") {
                                                      echo "active";
                                                } ?>">
                              <a href="6-11-class.php" class="menu-link">
                                    <div>6-11 Class List</div>
                              </a>
                        </li>
                  <?php
                  }
                  $resultal = DB::search("SELECT * FROM `grade` WHERE `gname` IN(12,13)");
                  if ($resultal->num_rows == 2) {
                  ?>
                        <li class="menu-item <?php if ($curPageName == "al-class.php") {
                                                      echo "active";
                                                } ?>">
                              <a href="al-class.php" class="menu-link">
                                    <div>A/L Class List</div>
                              </a>
                        </li>
                  <?php
                  }
                  ?>
                  <li class="menu-item <?php if ($curPageName == "add-class.php") {
                                                echo "active";
                                          } ?>">
                        <a href="add-class.php" class="menu-link">
                              <div>Add Class</div>
                        </a>
                  </li>
            </ul>
      </li>
      <li class="menu-item <?php if ($curPageName == "subject-list.php" || $curPageName == "add-subject.php" || $curPageName == "subject-list-al.php") {
                                    echo "active open";
                              } ?>">
            <a href="#" class="menu-link menu-toggle">
                  <i class='menu-icon tf-icons bx bx-book-alt'></i>
                  <div>Subject</div>
            </a>
            <ul class="menu-sub">
                  <li class="menu-item <?php if ($curPageName == "subject-list.php") {
                                                echo "active";
                                          } ?>">
                        <a href="subject-list.php" class="menu-link">
                              <div>Subject List</div>
                        </a>
                  </li>
                  <?php

               
                  if ($resultal->num_rows == 2) {
                  ?>
                        <li class="menu-item <?php if ($curPageName == "subject-list-al.php") {
                                                      echo "active";
                                                } ?>">
                              <a href="subject-list-al.php" class="menu-link">
                                    <div>A/L Subject List</div>
                              </a>
                        </li>
                  <?php
                  }
                  ?>
                  <li class="menu-item <?php if ($curPageName == "add-subject.php") {
                                                echo "active";
                                          } ?>">
                        <a href="add-subject.php" class="menu-link">
                              <div>Add Subject</div>
                        </a>
                  </li>
            </ul>
      </li>

      <li class="menu-header small text-uppercase"><span class="menu-header-text">File Management</span></li>

      <li class="menu-item <?php if ($curPageName == "assignments.php" || $curPageName == "marks.php") {
                                    echo "active open";
                              } ?>">
            <a href="#" class="menu-link menu-toggle">
                  <i class='menu-icon tf-icons bx bx-receipt'></i>
                  <div>Assignments</div>
            </a>
            <ul class="menu-sub">
                  <li class="menu-item <?php if ($curPageName == "assignments.php") {
                                                echo "active";
                                          } ?>">
                        <a href="assignments.php" class="menu-link">
                              <div>Assignments List</div>
                        </a>
                  </li>
                  <li class="menu-item <?php if ($curPageName == "marks.php") {
                                                echo "active";
                                          } ?>">
                        <a href="marks.php" class="menu-link">
                              <div>Assignment Marks</div>
                        </a>
                  </li>

            </ul>
      </li>

      <li class="menu-item <?php if ($curPageName == "notes.php") {
                                    echo "active";
                              } ?>">
            <a href="notes.php" class="menu-link">
                  <i class='menu-icon tf-icons bx bx-food-menu'></i>
                  <div data-i18n="Tables">Notes</div>
            </a>
      </li>

      <!-- Forms & Tables -->
      <li class="menu-header small text-uppercase"><span class="menu-header-text">MISC</span></li>
      <!-- Forms -->

      <!-- Tables -->
      <li class="menu-item <?php if ($curPageName == "#") {
                                    echo "active";
                              } ?>">
            <a href="../../doc/user-manual/Admin-Manual.pdf" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-table"></i>
                  <div data-i18n="Tables">User Manual</div>
            </a>
      </li>
      <li class="menu-item <?php if ($curPageName == "setting.php") {
                                    echo "active";
                              } ?>">
            <a href="setting.php" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-cog me-2"></i>
                  <div data-i18n="Tables">Setting</div>
            </a>
      </li>
</ul>