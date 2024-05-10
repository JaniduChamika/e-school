<!DOCTYPE html>


<html lang="en" class="light-style customizer-hide" dir="ltr" data-theme="theme-default" data-assets-path="../assets/" data-template="vertical-menu-template-free">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

  <title>Forgot Password</title>

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

        <div class="card">
          <div class="card-body">

            <div class="app-brand justify-content-center">
              <a href="../../index.php" class="app-brand-link gap-2">
                <span class="app-brand-logo demo">
                  <!-- logo  --> <img src="../../image/logo/logo.png" width="38" />

                </span>
                <span class="app-brand-text demo text-body fw-bolder fs-3">E-School</span>

              </a>
            </div>
            <!-- /Logo -->
            <h4 class="mb-2">Forgot Password? 🔒</h4>
            <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>

            <div class="mb-3">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email" placeholder="Enter your email" autofocus="">
              <div class="form-text text-danger" id="error2">

              </div>
            </div>
            <button class="btn btn-info d-grid w-100 mb-2" onclick="sendVerification();" id="vcbtn">Send Verification Code</button>

            <div class="text-center">
              <a href="#" onclick="history.back();" class="d-flex align-items-center justify-content-center text-info">
                <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                Back to log in
              </a>
            </div>
          </div>

        </div>
      </div>
    </div>

    <!-- / Content -->
    <script src="../../js/script.js"></script>



</body>

</html>