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

      <li class="menu-item <?php if ($curPageName == "#") {
                                    echo "active";
                              } ?>">
            <a href="../../doc/user-manual/Academic-Officer-Manual.pdf" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-table"></i>
                  <div data-i18n="Tables">User Manual</div>
            </a>
      </li>
      <li class="menu-item <?php if ($curPageName == "setting.php") {
                                    echo "active";
                              } ?>">
            <a href="setting.php" class="menu-link">
                  <i class="menu-icon tf-icons bx bx-dock-top"></i>
                  <div data-i18n="Account Settings">Account Settings</div>
            </a>
      </li>
</ul>