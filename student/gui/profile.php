<?php
session_start();
require "../../connection/connection.php";

if (isset($_SESSION["student"])) {
      $day = new DateTime();
      $tz = new DateTimeZone("Asia/Colombo");
      $day->setTimezone($tz);
      $date = $day->format("Y-m-d");
      // search student is paid his enrollment fee for his latest grade start
      $stu = DB::search("SELECT * FROM `students` WHERE `uid`='" . $_SESSION["student"]["uid"] . "'");
      $stuD = $stu->fetch_assoc();
      $ispaid = DB::search("SELECT * FROM `student_payment` WHERE `user_uid`='" . $_SESSION["student"]["uid"] . "' AND `grade_gid`='" . $stuD["gid"] . "'");
      if ($ispaid->num_rows == 1) {

            $_SESSION["pay_status"] = "paid";
      } else {
            $istrial = DB::search("SELECT * FROM `trial_period` WHERE `user_uid`='" . $_SESSION["student"]["uid"] . "'");
            if ($istrial->num_rows == 1) {
                  $tirald = $istrial->fetch_assoc();
                  // check different trail start date and today 
                  $date1 = date_create($date);
                  $date2 = date_create($tirald["start_date"]);
                  $diff = date_diff($date1, $date2);
                  $duration = $diff->format("%a");
                  if ($duration > 30) {
                        $_SESSION["pay_status"] = "notPaid";
                  } else {
                        $_SESSION["pay_status"] = "trial";
                  }
            } else {
                  $_SESSION["pay_status"] = "selectTrial";
            }
      }
      // search student is paid his enrollment fee for his latest grade end

      if ($_SESSION["pay_status"] == "paid" || $_SESSION["pay_status"] == "trial") {


            $student = $_SESSION["student"];
            $result = DB::search("SELECT * FROM `students` WHERE `uid`='" . $student["uid"] . "'");
            $data = $result->fetch_assoc();
?>
            <!DOCTYPE html>

            <html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

            <head>
                  <meta charset="utf-8" />
                  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

                  <title>Student | Profile</title>

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
                                    require "studentSidebar.php";
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
                                                                        <h5 class="mb-0">Profile</h5>
                                                                        <!-- <small class="text-muted float-end">Merged input group</small> -->
                                                                  </div>
                                                                  <div class="card-body">
                                                                        <div class="row">
                                                                              <div class="col-12 col-lg-6 text-center " id="imageviewbox">
                                                                                    <label>
                                                                                          <div class="serviceImageBox mb-2" id="viewImage3" style="background-image: url('../../image/profile/<?php echo $data["path"] ?>');">
                                                                                                <!-- <input type="file" class="d-none" accept=".png, .jpg, .jpeg" id="selectImage3" /> -->
                                                                                          </div>
                                                                                    </label>


                                                                              </div>

                                                                              <div class="col-12 col-lg-6">
                                                                                    <div class="row p-3">
                                                                                          <div class="col-lg-12 text-center text-lg-start">
                                                                                                <span class="form-text">Username <span class="d-none d-lg-inline-block">: -</span> </span>
                                                                                                <p class="mb-1"><?php echo $data["username"] ?></p>

                                                                                                <span class="form-text">Name <span class="d-none d-lg-inline-block">: -</span> </span>
                                                                                                <p class="mb-1"><?php echo $data["fulname"] ?></p>

                                                                                                <span class="form-text">Grade <span class="d-none d-lg-inline-block">: -</span> </span>
                                                                                                <p class="mb-1"><?php echo $data["clz_name"] ?></p>

                                                                                                <span class="form-text">Email Address <span class="d-none d-lg-inline-block">: -</span> </span>
                                                                                                <p class="mb-1"><?php echo $data["email"] ?></p>

                                                                                          </div>



                                                                                    </div>

                                                                              </div>

                                                                              <div class="col-12">
                                                                                    <div class="row">
                                                                                          <div class="col-12 col-md-6">

                                                                                                <div class="row mb-3">
                                                                                                      <label class="col-md-4 col-xxl-3 col-form-label" for="fname">First Name</label>
                                                                                                      <div class="col-md-8 col-xxl-9">
                                                                                                            <div class="input-group input-group-merge">
                                                                                                                  <span class="input-group-text"><i class="bx bx-user"></i></span>
                                                                                                                  <input type="text" class="form-control" id="fname" value="<?php echo $data["fname"] ?>" placeholder="John" disabled>
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
                                                                                                                  <input type="text" class="form-control" id="lname" value="<?php echo $data["lname"] ?>" placeholder="Mechel" disabled>
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
                                                                                                                  <input type="text" class="form-control" value="<?php echo $data["fulname"] ?>" onkeyup="this.value = this.value.toUpperCase();" id="nametag" placeholder="A.B.J MECHEL" disabled>
                                                                                                            </div>

                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>

                                                                                          <div class="col-12 col-lg-6">

                                                                                                <div class="row mb-3">
                                                                                                      <label class="col-md-4 col-xxl-3 col-form-label" for="emailtag">Email</label>
                                                                                                      <div class="col-md-8 col-xxl-9">
                                                                                                            <div class="input-group input-group-merge">
                                                                                                                  <span class="input-group-text"><i class="bx bx-envelope"></i></span>
                                                                                                                  <input type="text" id="emailtag" class="form-control ps-3" value="<?php echo $data["email"] ?>" placeholder="example@gmail.com" disabled>
                                                                                                                  <button class="btn input-group-buttone btn-info" onclick="emailModal();">Request</button>
                                                                                                            </div>

                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                          <div class="col-12 col-lg-6">

                                                                                                <div class="row mb-3">
                                                                                                      <label class="col-md-4 col-xxl-3 col-form-label" for="phonetag">Phone No</label>
                                                                                                      <div class="col-md-8 col-xxl-9">
                                                                                                            <div class="input-group input-group-merge">
                                                                                                                  <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                                                                                                  <input type="text" id="phonetag" value="<?php echo $data["contact"] ?>" class="form-control phone-mask ps-3" placeholder="07# 7777 8###" disabled>
                                                                                                            </div>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>


                                                                                          <div class="col-12 col-lg-6">
                                                                                                <div class="row mb-3">
                                                                                                      <label class="col-md-4 col-xxl-3 col-form-label" for="basic-icon-default-phone">Gander</label>
                                                                                                      <div class="col-md-8 col-xxl-9">
                                                                                                            <div class="input-group input-group-merge ps-3">
                                                                                                                  <?php
                                                                                                                  if ($data["gen"] == "Male") {
                                                                                                                  ?>
                                                                                                                        <div class="form-check mt-1 me-3">
                                                                                                                              <input name="ganeder" class="form-check-input" checked="" type="radio" value="1" id="ganderradiomale">
                                                                                                                              <label class="form-check-label" for="ganderradiomale"><i class='bx bx-male-sign'></i> Male </label>
                                                                                                                        </div>
                                                                                                                        <div class="form-check mt-1">
                                                                                                                              <input name="ganeder" class="form-check-input" type="radio" value="2" id="ganderradiofe">
                                                                                                                              <label class="form-check-label" for="ganderradiofe"><i class='bx bx-female-sign'></i> Female </label>
                                                                                                                        </div>
                                                                                                                  <?php
                                                                                                                  } else {
                                                                                                                  ?>
                                                                                                                        <div class="form-check mt-1 me-3">
                                                                                                                              <input name="ganeder" class="form-check-input" type="radio" value="1" id="ganderradiomale">
                                                                                                                              <label class="form-check-label" for="ganderradiomale"><i class='bx bx-male-sign'></i> Male </label>
                                                                                                                        </div>
                                                                                                                        <div class="form-check mt-1">
                                                                                                                              <input name="ganeder" class="form-check-input" checked="" type="radio" value="2" id="ganderradiofe">
                                                                                                                              <label class="form-check-label" for="ganderradiofe"><i class='bx bx-female-sign'></i> Female </label>
                                                                                                                        </div>
                                                                                                                  <?php
                                                                                                                  }
                                                                                                                  ?>

                                                                                                            </div>
                                                                                                      </div>
                                                                                                </div>

                                                                                          </div>
                                                                                          <div class="col-12 col-lg-6">
                                                                                                <div class="row mb-3">

                                                                                                      <label class="col-md-4 col-xxl-3 col-form-label " for="dobtag">DOB</label>
                                                                                                      <div class="col-md-8 col-xxl-9">
                                                                                                            <div class="input-group input-group-merge">
                                                                                                                  <span class="input-group-text"><i class='bx bx-calendar-heart'></i></span>
                                                                                                                  <input type="date" id="dobtag" class="form-control phone-mask ps-3" value="<?php echo $data["dob"] ?>" placeholder="200*******09" disabled>
                                                                                                            </div>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                          <div class="col-12 col-lg-6">
                                                                                                <div class="row mb-3">

                                                                                                      <label class="col-md-4 col-xxl-3 col-form-label " for="Religious ">Religious </label>
                                                                                                      <div class="col-md-8 col-xxl-9">
                                                                                                            <div class="input-group input-group-merge">
                                                                                                                  <span class="input-group-text"><i class='bx bx-world'></i></span>

                                                                                                                  <select id="Religious " class="form-select" disabled>
                                                                                                                        <option value="0">Select Religion</option>
                                                                                                                        <?php

                                                                                                                        $reult = DB::search("SELECT * FROM `religious`");

                                                                                                                        for ($i = 0; $i < $reult->num_rows; $i++) {
                                                                                                                              $d = $reult->fetch_assoc();
                                                                                                                              if ($data["religion"] == $d["religion"]) {
                                                                                                                        ?>
                                                                                                                                    <option value="<?php echo $d["rid"] ?>" selected><?php echo $d["religion"] ?></option>

                                                                                                                              <?php
                                                                                                                              } else {
                                                                                                                              ?>
                                                                                                                                    <option value="<?php echo $d["rid"] ?>"><?php echo $d["religion"] ?></option>

                                                                                                                        <?php
                                                                                                                              }
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                  </select>
                                                                                                            </div>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                          <div class="col-12 col-md-6">

                                                                                                <div class="row mb-3">
                                                                                                      <label class="col-md-4 col-xxl-3 col-form-label" for="parantnametag">Gardian Name</label>
                                                                                                      <div class="col-md-8 col-xxl-9">
                                                                                                            <div class="input-group input-group-merge">
                                                                                                                  <span class="input-group-text"><i class="bx bx-user"></i></span>
                                                                                                                  <input type="text" id="parantnametag" value="<?php echo $data["guardian_name"] ?>" class="form-control phone-mask ps-3" placeholder="Mr. Gunathilaka" disabled>
                                                                                                            </div>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                          <div class="col-12 col-md-6">

                                                                                                <div class="row mb-3">
                                                                                                      <label class="col-md-4 col-xxl-3 col-form-label" for="parantcontacttag">Gardian Contact No</label>
                                                                                                      <div class="col-md-8 col-xxl-9">
                                                                                                            <div class="input-group input-group-merge">
                                                                                                                  <span class="input-group-text"><i class="bx bx-phone"></i></span>
                                                                                                                  <input type="text" id="parantcontacttag" value="<?php echo $data["guardian_contact"] ?>" class="form-control phone-mask ps-3" placeholder="07# 7777 8###" disabled>
                                                                                                            </div>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                          <div class="col-12 col-lg-6">
                                                                                                <div class="row mb-3">

                                                                                                      <label class="col-md-4 col-xxl-3 col-form-label " for="addresstag">Address</label>
                                                                                                      <div class="col-md-8 col-xxl-9">
                                                                                                            <div class="input-group input-group-merge">
                                                                                                                  <span class="input-group-text"><i class='bx bx-home-circle'></i></span>
                                                                                                                  <input type="text" id="addresstag" value="<?php echo $data["address_line"] ?>" class="form-control phone-mask ps-3" placeholder="Address No, Street 01, Street 02" disabled>
                                                                                                            </div>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                          <div class="col-12 col-lg-6">
                                                                                                <div class="row mb-3">

                                                                                                      <label class="col-md-4 col-xxl-3 col-form-label " for="">Province</label>
                                                                                                      <div class="col-md-8 col-xxl-9">
                                                                                                            <div class="input-group input-group-merge">
                                                                                                                  <span class="input-group-text"><i class='bx bx-map-alt'></i></span>

                                                                                                                  <select id="provincetag" class="form-select" onchange="loaderAddres('district');" disabled>
                                                                                                                        <option value="0">Select Province</option>
                                                                                                                        <?php

                                                                                                                        $reult = DB::search("SELECT * FROM `province`");
                                                                                                                        $provinceId;

                                                                                                                        for ($i = 0; $i < $reult->num_rows; $i++) {
                                                                                                                              $d = $reult->fetch_assoc();
                                                                                                                              if ($data["province"] == $d["pname_en"]) {
                                                                                                                                    $provinceId = $d["pid"];

                                                                                                                        ?>
                                                                                                                                    <option value="<?php echo $d["pid"] ?>" selected><?php echo $d["pname_en"] ?></option>

                                                                                                                              <?php
                                                                                                                              } else {
                                                                                                                              ?>
                                                                                                                                    <option value="<?php echo $d["pid"] ?>"><?php echo $d["pname_en"] ?></option>

                                                                                                                        <?php
                                                                                                                              }
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                  </select>
                                                                                                            </div>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                          <div class="col-12 col-lg-6">
                                                                                                <div class="row mb-3">

                                                                                                      <label class="col-md-4 col-xxl-3 col-form-label " for="districtag">District</label>
                                                                                                      <div class="col-md-8 col-xxl-9">
                                                                                                            <div class="input-group input-group-merge">
                                                                                                                  <span class="input-group-text"><i class='bx bx-map-pin'></i></span>

                                                                                                                  <select id="districtag" class="form-select" onchange="loaderAddres('city');" disabled>
                                                                                                                        <option value="0">Select District</option>
                                                                                                                        <?php
                                                                                                                        $districId;

                                                                                                                        $reult = DB::search("SELECT * FROM `district` WHERE `province_pid`='" . $provinceId . "'");
                                                                                                                        for ($i = 0; $i < $reult->num_rows; $i++) {
                                                                                                                              $d = $reult->fetch_assoc();
                                                                                                                              if ($data["district"] == $d["dname_en"]) {
                                                                                                                                    $districId = $d["did"];
                                                                                                                        ?>
                                                                                                                                    <option value="<?php echo $d["did"] ?>" selected><?php echo $d["dname_en"] ?></option>
                                                                                                                              <?php
                                                                                                                              } else {
                                                                                                                              ?>
                                                                                                                                    <option value="<?php echo $d["did"] ?>"><?php echo $d["dname_en"] ?></option>

                                                                                                                        <?php
                                                                                                                              }
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                  </select>
                                                                                                            </div>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                          <div class="col-12 col-lg-6">
                                                                                                <div class="row mb-3">

                                                                                                      <label class="col-md-4 col-xxl-3 col-form-label " for="citytag">City</label>
                                                                                                      <div class="col-md-8 col-xxl-9">
                                                                                                            <div class="input-group input-group-merge">
                                                                                                                  <span class="input-group-text"><i class='bx bx-map'></i></span>

                                                                                                                  <select id="citytag" class="form-select" onchange="loaderAddres('postal');" disabled>
                                                                                                                        <option value="0">Select City</option>
                                                                                                                        <?php

                                                                                                                        $reult = DB::search("SELECT * FROM `city` WHERE `district_did`='" . $districId . "'");

                                                                                                                        for ($i = 0; $i < $reult->num_rows; $i++) {
                                                                                                                              $d = $reult->fetch_assoc();
                                                                                                                              if ($data["city"] == $d["cname_en"]) {

                                                                                                                        ?>
                                                                                                                                    <option value="<?php echo $d["cid"] ?>" selected><?php echo $d["cname_en"] ?></option>
                                                                                                                              <?php
                                                                                                                              } else {
                                                                                                                              ?>
                                                                                                                                    <option value="<?php echo $d["cid"] ?>"><?php echo $d["cname_en"] ?></option>

                                                                                                                        <?php
                                                                                                                              }
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                  </select>
                                                                                                            </div>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                          <div class="col-12 col-lg-6">
                                                                                                <div class="row mb-3">

                                                                                                      <label class="col-md-4 col-xxl-3 col-form-label " for="postalcodetag">Postal Code</label>
                                                                                                      <div class="col-md-8 col-xxl-9">
                                                                                                            <div class="input-group input-group-merge">
                                                                                                                  <span class="input-group-text"><i class='bx bxs-edit-location'></i></span>
                                                                                                                  <input type="text" id="postalcodetag" value="<?php echo $data["postcode"] ?>" class="form-control phone-mask ps-3" placeholder="11222" disabled>

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
                                                                              <div class="col-12 text-end">
                                                                                    <button type="submit" class="btn btn-info" onclick="profileEdiStudent();" id="editbtn">Edit</button>
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

                                          <!-- new email enter modal  -->
                                          <div class="modal fade" id="newemailMod" data-bs-backdrop="static" tabindex="-1" aria-modal="true" role="dialog">
                                                <div class="modal-dialog">
                                                      <form class="modal-content">
                                                            <div class="modal-header">
                                                                  <h5 class="modal-title" id="backDropModalTitle">New Email</h5>
                                                                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                  <div class="row">
                                                                        <div class="col mb-3">
                                                                              <label for="Assigntecher" class="form-label">New Email</label>


                                                                              <input class="form-control mt-3" id="newEmail" placeholder="Enter Your New Email">

                                                                        </div>
                                                                  </div>

                                                            </div>
                                                            <div class="modal-footer">
                                                                  <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                                        Close
                                                                  </button>
                                                                  <button type="button" class="btn btn-info" id="AnnsubmitBtn" onclick="requestEmailChange();">Submit</button>
                                                            </div>
                                                      </form>
                                                </div>
                                          </div>


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

                  <script src="../js/student.js"></script>

            </body>

            </html>
      <?php
      } else if ($_SESSION["pay_status"] == "notPaid") {
      ?>
            <script>
                  window.location = "../../misc/payment.php";
            </script>
      <?php
      } else if ($_SESSION["pay_status"] == "selectTrial") {
      ?>
            <script>
                  window.location = "../../misc/trial.php";
            </script>
      <?php
      }
} else {
      ?>
      <script>
            window.location = "../../login/gui/student-login.php";
      </script>
<?php
}
?>