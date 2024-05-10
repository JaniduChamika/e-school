<?php
session_start();
$username = "";
$password = "";
$checked = "";

if (isset($_COOKIE["uns"])) {
  $username = $_COOKIE["uns"];
  $password = $_COOKIE["pws"];
  $checked = "checked";
}
if (!isset($_SESSION["student"])) {
?>

  <!DOCTYPE html>

  <html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

    <title>Student Log In</title>

    <meta name="description" content="" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />



    <!-- Icons. Uncomment required icon fonts -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/boxicons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/theme-default.css" class="template-customizer-theme-css" />


    <link rel="stylesheet" href="../../assets/vendor/css/pages/page-auth.css" />
    <link rel="stylesheet" href="../../css/bac-animation.css" />
    <link rel="stylesheet" href="../../css/style.css" />

  </head>

  <body>
    <!-- Content -->
    <div class="area position-fixed">
      <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
      </ul>
    </div>
    <div class="container-xxl">
      <div class="authentication-wrapper authentication-basic container-p-y">
        <div class="authentication-inner">
          <!-- Register -->
          <div class="card">
            <div class="card-body" id="loginbox">
              <!-- Logo -->
              <div class="app-brand justify-content-center">
                <a href="../../index.php" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                  <img src="../../image/logo/logo.png" width="38" />
                    <!-- logo  -->
                  </span>
                  <span class="app-brand-text demo text-body fw-bolder fs-3">E-School</span>

                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Student Log In </h4>


              <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" value="<?php echo $username ?>" name="email-username" placeholder="Enter your username" autofocus />
                <div class="form-text text-danger" id="error1">

                </div>
              </div>
              <div class="mb-3 form-password-toggle">
                <div class="d-flex justify-content-between">
                  <label class="form-label " for="password">Password</label>

                </div>
                <div class="input-group input-group-merge">
                  <input type="password" id="password" value="<?php echo $password ?>" class="form-control" placeholder="Enter your password" />

                  <span class="input-group-text cursor-pointer" id="pwsnbtn" onclick="showPssword();"><i class="bx bx-hide"></i></span>
                </div>
                <div class="form-text text-danger" id="error2">

                </div>
              </div>
              <div class="mb-3">
                <div class="form-check d-flex justify-content-between">
                  <input class="form-check-input me-2" type="checkbox" id="remember-me" <?php echo $checked ?> />
                  <label class="form-check-label" for="remember-me"> Remember Me </label>
                  <a href="forgot-password.php" class="text-info me-0 ms-auto">
                    <small>Forgot Password?</small>
                  </a>
                </div>
              </div>
              <div class="mb-3">
                <button class="btn btn-info d-grid w-100" type="submit" onclick="studentLogin()"> Log In</button>
              </div>



            </div>
            <div class="card-body d-none" id="vcbox">

              <div class="app-brand justify-content-center">
              <a href="../../index.php" class="app-brand-link gap-2">
                  <span class="app-brand-logo demo">
                    <!-- logo  --> <img src="../../image/logo/logo.png" width="38" />

                  </span>
                  <span class="app-brand-text demo text-body fw-bolder fs-3">E-School</span>

                </a>
              </div>
              <!-- /Logo -->
              <h4 class="mb-2">Two Step Verification</h4>
              <p class="mb-4">Verification code sent your email by system. Please check your inbox</p>

              <div class="mb-3">
                <label for="email" class="form-label">Verification Code</label>
                <input type="text" class="form-control" id="vcode" placeholder="Enter verification code" autofocus="">
                <div class="form-text text-danger" id="error3">

                </div>
              </div>
              <button class="btn btn-info w-100 fw-bold" id="logbtn" onclick="studentLoginVC();">
                <div class="spinner-grow  text-white d-none" style="height: 19px;width: 19px;" role="status" id="pendingbtn1">
                </div> &nbsp;
                Log In &nbsp;
                <div class="spinner-grow  text-white d-none" style="height: 19px;width: 19px;" role="status" id="pendingbtn2">
                </div>
              </button>


            </div>
          </div>
          <!-- /Register -->
        </div>
      </div>
    </div>
    <div id="tostbox">
      <div class="bs-toast toast toast-placement-ex m-2 fade bg-info bottom-0 start-0 shadow-none mytost" id="tostdiv" role="alert" aria-live="assertive" aria-atomic="true" data-delay="2000">

      </div>
    </div>
    <!-- / Content -->
    <script src="../../js/script.js"></script>



  </body>

  </html>
<?php
} else {
?>
  <script>
    window.location = "../../student/gui/dashboard.php";
  </script>
<?php
}
?>