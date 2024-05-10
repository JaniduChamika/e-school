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

            <title>Officer | Register Student</title>
            <?php
            require "headLink.php";
            ?>
            <link rel="stylesheet" href="../../css/jquery.imageResizer.css" />

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
                                                <div class="col-12 ">
                                                      <div class="card mb-4">
                                                            <div class="card-header d-flex align-items-center justify-content-between">
                                                                  <h5 class="mb-0">Ragister Student</h5>
                                                                  <!-- <small class="text-muted float-end">Merged input group</small> -->
                                                            </div>
                                                            <div class="card-body">
                                                                  <div class="row">
                                                                        <p class="text-muted mb-0">Allowed JPG, JPEG or PNG. Good with more than 720x510 resolution </p>


                                                                        <div class="col-12 text-center " id="imageviewbox">
                                                                              <label for="selectImage3" onclick="done();">
                                                                                    <div class="serviceImageBox mb-2" id="viewImage3" style="background-image: url('../../image/profile/student-default.png');">
                                                                                          <input type="file" class="d-none" accept=".png, .jpg, .jpeg" id="selectImage3" />

                                                                                    </div>
                                                                              </label>


                                                                        </div>
                                                                        <div class="col-12  d-none mb-2" id="cropbox">
                                                                              <div class="position-relative mx-auto mb-2" id="fullimagebox" style="height: 330px; width: 415px;">
                                                                                    <div id="contain" style="position:absolute; width:100%;height:100%;">

                                                                                    </div>

                                                                              </div>
                                                                              <div class="w-100 text-center">

                                                                                    <button class="resize-done btn btn-info py-2 px-4 fs-6">Done</button>

                                                                              </div>
                                                                        </div>


                                                                        <div class="col-12">
                                                                              <div class="row">
                                                                                    <div class="col-12 col-md-6">

                                                                                          <div class="row mb-3">
                                                                                                <label class="col-md-4 col-xxl-3 col-form-label" for="fname">First Name</label>
                                                                                                <div class="col-md-8 col-xxl-9">
                                                                                                      <div class="input-group input-group-merge border-danger">
                                                                                                            <span class="input-group-text"><i class="bx bx-user"></i></span>
                                                                                                            <input type="text" class="form-control" id="fname" placeholder="John">
                                                                                                      </div>

                                                                                                </div>
                                                                                          </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-6">

                                                                                          <div class="row mb-3">
                                                                                                <label class="col-md-4 col-xxl-3 col-form-label" for="lname">Last Name</label>
                                                                                                <div class="col-md-8 col-xxl-9">
                                                                                                      <div class="input-group input-group-merge">
                                                                                                            <span class="input-group-text"><i class="bx bx-user"></i></span>
                                                                                                            <input type="text" class="form-control" id="lname" placeholder="Mechel">
                                                                                                      </div>

                                                                                                </div>
                                                                                          </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-6">

                                                                                          <div class="row mb-3">
                                                                                                <label class="col-md-4 col-xxl-3 col-form-label" for="nametag">Name with initial</label>
                                                                                                <div class="col-md-8 col-xxl-9">
                                                                                                      <div class="input-group input-group-merge">
                                                                                                            <span class="input-group-text"><i class="bx bx-user"></i></span>
                                                                                                            <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" id="nametag" placeholder="A.B.J MECHEL">
                                                                                                      </div>

                                                                                                </div>
                                                                                          </div>
                                                                                    </div>

                                                                                    <div class="col-12 col-md-6">

                                                                                          <div class="row mb-3">
                                                                                                <label class="col-md-4 col-xxl-3 col-form-label" for="usernametag">Username</label>
                                                                                                <div class="col-md-8 col-xxl-9">
                                                                                                      <div class="input-group input-group-merge">
                                                                                                            <span class="input-group-text"><i class='bx bx-user-circle'></i></span>
                                                                                                            <input type="text" class="form-control" onkeyup="this.value = this.value.toUpperCase();" id="usernametag" placeholder="STU/ABJ/0001" aria-label="John Doe">
                                                                                                      </div>

                                                                                                </div>
                                                                                          </div>
                                                                                    </div>

                                                                                    <div class="col-12 col-md-6">

                                                                                          <div class="row mb-3">
                                                                                                <label class="col-md-4 col-xxl-3 col-form-label" for="emailtag">Email</label>
                                                                                                <div class="col-md-8 col-xxl-9">
                                                                                                      <div class="input-group input-group-merge">
                                                                                                            <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                                                                                            <input type="text" id="emailtag" class="form-control" placeholder="example@gmail.com">

                                                                                                      </div>

                                                                                                </div>
                                                                                          </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-6">

                                                                                          <div class="row mb-3">
                                                                                                <label class="col-md-4 col-xxl-3 col-form-label" for="phonetag">Phone No</label>
                                                                                                <div class="col-md-8 col-xxl-9">
                                                                                                      <div class="input-group input-group-merge">
                                                                                                            <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                                                                                            <input type="text" id="phonetag" class="form-control phone-mask" placeholder="07# 7777 8###">
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                    </div>


                                                                                    <div class="col-12 col-md-6">
                                                                                          <div class="row mb-3">
                                                                                                <label class="col-md-4 col-xxl-3 col-form-label" for="basic-icon-default-phone">Gander</label>
                                                                                                <div class="col-md-8 col-xxl-9">
                                                                                                      <div class="input-group input-group-merge">

                                                                                                            <div class="form-check mt-1 me-3 ms-2">
                                                                                                                  <input name="ganeder" class="form-check-input" checked="" type="radio" value="1" id="ganderradiomale">
                                                                                                                  <label class="form-check-label" for="ganderradiomale"><i class='bx bx-male-sign'></i> Male </label>
                                                                                                            </div>
                                                                                                            <div class="form-check mt-1">
                                                                                                                  <input name="ganeder" class="form-check-input" type="radio" value="2" id="ganderradiofe">
                                                                                                                  <label class="form-check-label" for="ganderradiofe"><i class='bx bx-female-sign'></i> Female </label>
                                                                                                            </div>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>

                                                                                    </div>
                                                                                    <div class="col-12 col-md-6">
                                                                                          <div class="row mb-3">

                                                                                                <label class="col-md-4 col-xxl-3 col-form-label " for="dobtag">DOB</label>
                                                                                                <div class="col-md-8 col-xxl-9">
                                                                                                      <div class="input-group input-group-merge">
                                                                                                            <span class="input-group-text"><i class='bx bx-calendar-heart'></i></span>
                                                                                                            <input type="date" id="dobtag" class="form-control phone-mask" placeholder="200*******09">
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-6">
                                                                                          <div class="row mb-3">

                                                                                                <label class="col-md-4 col-xxl-3 col-form-label " for="gradetag">Grade </label>
                                                                                                <div class="col-md-8 col-xxl-9">
                                                                                                      <div class="input-group input-group-merge">
                                                                                                            <span id="basic-icon-default-phone2" class="input-group-text"><i class="menu-icon tf-icons bx bxs-school"></i></span>

                                                                                                            <select id="gradetag" onchange="getClass();" class="form-select">
                                                                                                                  <option value="0">Select Grade</option>
                                                                                                                  <!-- load grades from db  -->
                                                                                                                  <?php

                                                                                                                  $reult = DB::search("SELECT * FROM `grade`");

                                                                                                                  for ($i = 0; $i < $reult->num_rows; $i++) {
                                                                                                                        $d = $reult->fetch_assoc();
                                                                                                                  ?>
                                                                                                                        <option value="<?php echo $d["gid"] ?>"><?php echo $d["gname"] ?></option>
                                                                                                                  <?php
                                                                                                                  }
                                                                                                                  ?>
                                                                                                            </select>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-6">
                                                                                          <div class="row mb-3">

                                                                                                <label class="col-md-4 col-xxl-3 col-form-label " for="classtag">Class </label>
                                                                                                <div class="col-md-8 col-xxl-9">
                                                                                                      <div class="input-group input-group-merge">
                                                                                                            <span id="basic-icon-default-phone2" class="input-group-text"><i class="menu-icon tf-icons bx bxs-school"></i></span>

                                                                                                            <select id="classtag" class="form-select">
                                                                                                                  <option value="0">Select Class</option>
                                                                                                                  <?php

                                                                                                                  $reult = DB::search("SELECT * FROM `class`");

                                                                                                                  for ($i = 0; $i < $reult->num_rows; $i++) {
                                                                                                                        $d = $reult->fetch_assoc();
                                                                                                                  ?>
                                                                                                                        <option value="<?php echo $d["clz_id"] ?>"><?php echo $d["clz_name"] ?></option>
                                                                                                                  <?php
                                                                                                                  }
                                                                                                                  ?>
                                                                                                            </select>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-6">
                                                                                          <div class="row mb-3">

                                                                                                <label class="col-md-4 col-xxl-3 col-form-label " for="Religious ">Religious </label>
                                                                                                <div class="col-md-8 col-xxl-9">
                                                                                                      <div class="input-group input-group-merge">
                                                                                                            <span id="basic-icon-default-phone2" class="input-group-text"><i class='bx bx-world'></i></span>

                                                                                                            <select id="Religious " class="form-select">
                                                                                                                  <option value="0">Select Religion</option>
                                                                                                                  <?php

                                                                                                                  $reult = DB::search("SELECT * FROM `religious`");

                                                                                                                  for ($i = 0; $i < $reult->num_rows; $i++) {
                                                                                                                        $d = $reult->fetch_assoc();
                                                                                                                  ?>
                                                                                                                        <option value="<?php echo $d["rid"] ?>"><?php echo $d["religion"] ?></option>
                                                                                                                  <?php
                                                                                                                  }
                                                                                                                  ?>
                                                                                                            </select>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-6">

                                                                                          <div class="row mb-3">
                                                                                                <label class="col-md-4 col-xxl-3 col-form-label" for="gardian-name">Guardian Name</label>
                                                                                                <div class="col-md-8 col-xxl-9">
                                                                                                      <div class="input-group input-group-merge">
                                                                                                            <span class="input-group-text"><i class="bx bx-user"></i></span>
                                                                                                            <input type="text" id="gardian-name" class="form-control phone-mask" placeholder="Mr. Gunathilaka">
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-6">

                                                                                          <div class="row mb-3">
                                                                                                <label class="col-md-4 col-xxl-3 col-form-label" for="gardian-contact">Guardian Contact No</label>
                                                                                                <div class="col-md-8 col-xxl-9">
                                                                                                      <div class="input-group input-group-merge">
                                                                                                            <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                                                                                            <input type="text" id="gardian-contact" class="form-control phone-mask" placeholder="07# 7777 8###">
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-6">
                                                                                          <div class="row mb-3">

                                                                                                <label class="col-md-4 col-xxl-3 col-form-label " for="addresstag">Address</label>
                                                                                                <div class="col-md-8 col-xxl-9">
                                                                                                      <div class="input-group input-group-merge">
                                                                                                            <span class="input-group-text"><i class='bx bx-home-circle'></i></span>

                                                                                                            <input type="text" id="addresstag" class="form-control phone-mask" placeholder="Address No, Street 01, Street 02">
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-6">
                                                                                          <div class="row mb-3">

                                                                                                <label class="col-md-4 col-xxl-3 col-form-label " for="provincetag">Province</label>
                                                                                                <div class="col-md-8 col-xxl-9">
                                                                                                      <div class="input-group input-group-merge">
                                                                                                            <span class="input-group-text"><i class='bx bx-map-alt'></i></span>

                                                                                                            <select id="provincetag" onchange="loaderAddres('district');" class="form-select">
                                                                                                                  <option value="0">Select Province</option>
                                                                                                                  <?php

                                                                                                                  $reult = DB::search("SELECT * FROM `province`");

                                                                                                                  for ($i = 0; $i < $reult->num_rows; $i++) {
                                                                                                                        $d = $reult->fetch_assoc();
                                                                                                                  ?>
                                                                                                                        <option value="<?php echo $d["pid"] ?>"><?php echo $d["pname_en"] ?></option>
                                                                                                                  <?php
                                                                                                                  }
                                                                                                                  ?>
                                                                                                            </select>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-6">
                                                                                          <div class="row mb-3">

                                                                                                <label class="col-md-4 col-xxl-3 col-form-label " for="districtag">District</label>
                                                                                                <div class="col-md-8 col-xxl-9">
                                                                                                      <div class="input-group input-group-merge">
                                                                                                            <span class="input-group-text"><i class='bx bx-map-pin'></i></span>

                                                                                                            <select id="districtag" onchange="loaderAddres('city');" class="form-select">
                                                                                                                  <option value="0">Select District</option>
                                                                                                                  <?php

                                                                                                                  $reult = DB::search("SELECT * FROM `district`");

                                                                                                                  for ($i = 0; $i < $reult->num_rows; $i++) {
                                                                                                                        $d = $reult->fetch_assoc();
                                                                                                                  ?>
                                                                                                                        <option value="<?php echo $d["did"] ?>"><?php echo $d["dname_en"] ?></option>
                                                                                                                  <?php
                                                                                                                  }
                                                                                                                  ?>
                                                                                                            </select>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-6">
                                                                                          <div class="row mb-3">

                                                                                                <label class="col-md-4 col-xxl-3 col-form-label " for="citytag">City</label>
                                                                                                <div class="col-md-8 col-xxl-9">
                                                                                                      <div class="input-group input-group-merge">
                                                                                                            <span class="input-group-text"><i class='bx bx-map'></i></span>

                                                                                                            <select id="citytag" onchange="loaderAddres('postal');" class="form-select">
                                                                                                                  <option value="0">Select City</option>
                                                                                                                  <?php

                                                                                                                  $reult = DB::search("SELECT * FROM `city`");

                                                                                                                  for ($i = 0; $i < $reult->num_rows; $i++) {
                                                                                                                        $d = $reult->fetch_assoc();
                                                                                                                  ?>
                                                                                                                        <option value="<?php echo $d["cid"] ?>"><?php echo $d["cname_en"] ?></option>
                                                                                                                  <?php
                                                                                                                  }
                                                                                                                  ?>
                                                                                                            </select>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                    </div>
                                                                                    <div class="col-12 col-md-6">
                                                                                          <div class="row mb-3">

                                                                                                <label class="col-md-4 col-xxl-3 col-form-label " for="postalcodetag">Postal Code</label>
                                                                                                <div class="col-md-8 col-xxl-9">
                                                                                                      <div class="input-group input-group-merge">
                                                                                                            <span class="input-group-text"><i class='bx bxs-edit-location'></i></span>
                                                                                                            <input type="text" id="postalcodetag" class="form-control phone-mask" placeholder="11222">

                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                    </div>
                                                                              </div>

                                                                        </div>

                                                                  </div>


                                                                  <div class="row">
                                                                        <div class="col-12 ">
                                                                              <div class="alert alert-danger alert-dismissible d-none" id="errormsg" role="alert">


                                                                              </div>
                                                                        </div>
                                                                        <div class="col-12  text-end ">

                                                                              <button type="submit" class="btn btn-info mt-auto mb-0" id="submitbtn" onclick="addUser('Student');">Submit
                                                                                    <div class="spinner-grow  text-white d-none" style="height: 14px;width: 14px;" role="status" id="pendingbtn2">
                                                                                    </div>
                                                                              </button>
                                                                        </div>
                                                                  </div>

                                                            </div>
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


            <!-- Main JS -->
            <script src="../../assets/js/main.js"></script>


            <!-- Place this tag in your head or just before your close body tag. -->
            <script async defer src="https://buttons.github.io/buttons.js"></script>

            <!-- my java script  -->
            <script src="../../js/script.js"></script>
            <script type="text/javascript" src="../../js/jquery.min.js"></script>
            <script type="text/javascript" src="../../js/jquery.imageResizer.js"></script>
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