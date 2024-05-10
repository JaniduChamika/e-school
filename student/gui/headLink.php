<meta name="description" content="" />

<!-- Favicon -->
<link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

<!-- Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet" />

<!-- Icons. Uncomment required icon fonts -->
<link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css" />

<!-- Core CSS -->
<link rel="stylesheet" href="../../assets/vendor/css/core.css" class="template-customizer-core-css" />
<link rel="stylesheet" href="../../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />
<link rel="stylesheet" href="../../assets/css/demo.css" />

<!-- Vendors CSS -->
<link rel="stylesheet" href="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css" />

<link rel="stylesheet" href="../../assets/vendor/libs/apex-charts/apex-charts.css" />

<!-- Page CSS -->

<!-- Helpers -->
<script src="../../assets/vendor/js/helpers.js"></script>

<!--! Template customizer & Theme config files MUST be included after core stylesheets and helpers.js in the <head> section -->
<!-- Config:  Mandatory theme config file contain global vars & default theme options, Set your preferred theme option in this file.  -->
<script src="../../assets/js/config.js"></script>

<!-- my css  -->
<link rel="stylesheet" href="../../css/datatables.min.css" />
<link rel="stylesheet" href="../../css/style.css" />

<?php


$isdark = DB::search("SELECT * FROM `dark_theam` WHERE `user_uid`='" . $_SESSION["student"]["uid"] . "'");
if ($isdark->num_rows == 1) {
?>
      <style>
            .card {
                  background-color: #1b1b1b;
            }

            body {
                  background-color: #252525;
                  background: #252525;
            }

            .bg-menu-theme {
                  background-color: #1b1b1b !important
            }

            .layout-navbar {
                  background-color: #1b1b1b !important
            }

            .form-control {
                  background-color: #1b1b1b;
            }

            .form-control:disabled {
                  background-color: #1b1b1b;
            }

            .form-control:focus {
                  background-color: #1b1b1b;
            }

            .form-select {
                  background-color: #1b1b1b;

            }

            .calendar-container {
                  background-color: #1b1b1b !important
            }

            .dropdown-menu {
                  background-color: #1d1d1d;
                  box-shadow: 0 0.25rem 1rem rgb(161 172 184 / 10%);
            }

            .navbar-detached {
                  box-shadow: 0 0 0.375rem 0.25rem rgb(161 172 184 / 5%);
            }


            .calendar-table__event .calendar-table__item {
                  background-color: #00545f !important;
                  border-color: #606060 !important
            }

            .bg-menu-theme .menu-item.active>.menu-link:not(.menu-toggle) {
                  background-color: #141414 !important
            }

            .modal-content {
                  background-color: #1b1b1b !important
            }

            .bg-footer-theme {
                  background-color: #252525 !important
            }

            .events__item {
                  background: #252525 !important;
                  border-left: 8px solid #00545f !important;
            }

            .events__name {
                  color: white !important;

            }

            .events__tag {
                  background: #00545f !important;

            }
      </style>
<?php
}
?>