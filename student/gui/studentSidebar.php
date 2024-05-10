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



      <li class="menu-item <?php if ($curPageName == "assignments.php") {
                                    echo "active";
                              } ?>">
            <a href="assignments.php" class="menu-link">
                  <i class='menu-icon tf-icons bx bx-receipt'></i>

                  <div data-i18n="Tables">Assignments</div>
            </a>
      </li>

      <li class="menu-item <?php if ($curPageName == "notes.php") {
                                    echo "active";
                              } ?>">
            <a href="notes.php" class="menu-link">
                  <i class='menu-icon tf-icons bx bx-food-menu'></i>

                  <div data-i18n="Tables">Notes</div>
            </a>
      </li>


      <li class="menu-item <?php if ($curPageName == "enrollmentfee.php") {
                                    echo "active";
                              } ?>">
            <a href="enrollmentfee.php" class="menu-link">
                  <i class='menu-icon tf-icons bx bx-money'></i>

                  <div data-i18n="Tables">Enrollment Fee</div>
            </a>
      </li>






      <li class="menu-item <?php if ($curPageName == "#") {
                                    echo "active";
                              } ?>">
            <a href="../../doc/user-manual/Student-Manual.pdf" class="menu-link">
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