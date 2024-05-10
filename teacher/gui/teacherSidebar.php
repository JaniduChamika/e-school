<div class="app-brand demo">
      <a href="../../index.php" class="app-brand-link">
            <span class="app-brand-logo demo">
                  <img src="../../image/logo/logo.png" width="38" />
                  <!-- logo  -->
            </span>
            <span class="app-brand-text demo menu-text fw-bolder ms-2 ">E-School</span>
      </a>

      <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
      </a>
</div>

<div class="menu-inner-shadow"></div>
<ul class="menu-inner py-1">
      <?php
      $page;
      $title;
      if (isset($_GET["page"])) {
            $page = $_GET["page"];
      }
      if (isset($_GET["title"])) {
            $title = $_GET["title"];
      } else {
            $title = "";
      }
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







      <li class="menu-item <?php if ($curPageName == "assignments-list.php" || $curPageName == "student-anwser-sheet.php" || $curPageName == "assignment-marks.php" || $curPageName == "add-assignment.php") {
                                    echo "active open";
                              } ?>">
            <a href="#" class="menu-link menu-toggle">
                  <i class='menu-icon tf-icons bx bx-receipt'></i>
                  <div>Assignments</div>
            </a>
            <ul class="menu-sub">
                  <li class="menu-item <?php if ($curPageName == "assignments-list.php") {
                                                echo "active";
                                          } ?>">
                        <a href="assignments-list.php" class="menu-link">
                              <div>Assignments List</div>
                        </a>
                  </li>
                  <li class="menu-item <?php if ($curPageName == "student-anwser-sheet.php") {
                                                echo "active";
                                          } ?>">
                        <a href="student-anwser-sheet.php" class="menu-link">
                              <div>Student Answer Sheet</div>
                        </a>
                  </li>
                  <li class="menu-item <?php if ($curPageName == "assignment-marks.php") {
                                                echo "active";
                                          } ?>">
                        <a href="assignment-marks.php" class="menu-link">
                              <div>Assignment Marks</div>
                        </a>
                  </li>
                  <li class="menu-item <?php if ($curPageName == "add-assignment.php") {
                                                echo "active";
                                          } ?>">
                        <a href="add-assignment.php" class="menu-link">
                              <div>Add-Assignment</div>
                        </a>
                  </li>
            </ul>
      </li>
      <li class="menu-item <?php if ($curPageName == "note-list.php" || $curPageName == "notes-add.php") {
                                    echo "active open";
                              } ?>">
            <a href="#" class="menu-link menu-toggle">
                  <i class='menu-icon tf-icons bx bx-food-menu'></i>
                  <div>Notes</div>
            </a>
            <ul class="menu-sub">
                  <li class="menu-item <?php if ($curPageName == "note-list.php") {
                                                echo "active";
                                          } ?>">
                        <a href="note-list.php" class="menu-link">
                              <div>Note List</div>
                        </a>
                  </li>
                  <li class="menu-item <?php if ($curPageName == "notes-add.php") {
                                                echo "active";
                                          } ?>">
                        <a href="notes-add.php" class="menu-link">
                              <div>Add Note</div>
                        </a>
                  </li>

            </ul>
      </li>
      <?php
      $ishaveClass = DB::search("SELECT * FROM `class` WHERE `teacher_tuid`='" . $_SESSION["teacher"]["uid"] . "'");
      if ($ishaveClass->num_rows == 1) {
      ?>
            <li class="menu-item <?php if ($curPageName == "my-class.php") {
                                          echo "active";
                                    } ?>">
                  <a href="my-class.php" class="menu-link">
                        <i class='menu-icon tf-icons bx bx-building'></i>
                        <div data-i18n="Tables">My Class</div>
                  </a>
            </li>
      <?php
      }
      ?>

      <li class="menu-item <?php if ($curPageName == "#") {
                                    echo "active";
                              } ?>">
            <a href="../../doc/user-manual/Teacher-Manual.pdf" class="menu-link">
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