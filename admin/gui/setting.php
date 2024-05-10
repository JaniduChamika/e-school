<?php
session_start();
require "../../connection/connection.php";

// check admin is loged 
if (isset($_SESSION["admin"])) {

?>
      <!DOCTYPE html>

      <html lang="en" class="light-style layout-menu-fixed" dir="ltr" data-theme="theme-default" data-assets-path="../../assets/" data-template="vertical-menu-template-free">

      <head>
            <meta charset="utf-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />

            <title>Admin | Setting</title>

            <?php
            require "headLink.php";
            ?>

      </head>

      <body>
            <!-- Layout wrapper -->
            <div class="layout-wrapper layout-content-navbar">
                  <div class="layout-container">
                        <!-- Menu -->

                        <aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">

                              <?php
                              require "adminSidebar.php";
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
                                          <div class="row px-2">
                                                <div class="col-12">

                                                      <div class="nav-align-top mb-4">
                                                            <ul class="nav nav-pills mb-3" role="tablist">
                                                                  <?php

                                                                  if ($_SESSION["admin"]["user_type"] == 1) {

                                                                  ?>
                                                                        <li class="nav-item">
                                                                              <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-home" aria-controls="navs-pills-top-home" aria-selected="true">
                                                                                    General Settings
                                                                              </button>
                                                                        </li>
                                                                        <li class="nav-item">
                                                                              <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile" aria-selected="false">
                                                                                    Account Settings
                                                                              </button>
                                                                        </li>
                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                        <li class="nav-item">
                                                                              <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-profile" aria-controls="navs-pills-top-profile" aria-selected="false">
                                                                                    Account Settings
                                                                              </button>
                                                                        </li>
                                                                  <?php

                                                                  }
                                                                  ?>

                                                                  <!-- <li class="nav-item">
                                                                  <button type="button" class="nav-link" role="tab" data-bs-toggle="tab" data-bs-target="#navs-pills-top-messages" aria-controls="navs-pills-top-messages" aria-selected="false">
                                                                        Messages
                                                                  </button>
                                                            </li> -->
                                                            </ul>
                                                            <div class="tab-content non-backgound shadow-none p-0" style="background: none;">
                                                                  <?php

                                                                  if ($_SESSION["admin"]["user_type"] == 1) {

                                                                  ?>
                                                                        <div class="tab-pane fade active show " id="navs-pills-top-home" role="tabpanel">
                                                                              <div class="row">
                                                                                    <div class="col-md-6">
                                                                                          <div class="card mb-4">
                                                                                                <h5 class="card-header">Grades</h5>
                                                                                                <div class="card-body">
                                                                                                      <label class="form-label d-block">Select Grades in Your School Have</label>
                                                                                                      <div class="row">

                                                                                                            <div class="col-12">
                                                                                                                  <div class="btn-group w-100" role="group" aria-label="Basic checkbox toggle button group">

                                                                                                                        <?php

                                                                                                                        $result1g = DB::search("SELECT * FROM `grade` WHERE `gname` IN(1,2,3,4,5)");
                                                                                                                        $result2g = DB::search("SELECT * FROM `grade` WHERE `gname` IN(6,7,8,9,10,11)");
                                                                                                                        $result3g = DB::search("SELECT * FROM `grade` WHERE `gname` IN(12,13)");
                                                                                                                        if ($result1g->num_rows == 5) {
                                                                                                                        ?>
                                                                                                                              <input type="checkbox" class="btn-check" id="btncheck1" checked="" disabled>
                                                                                                                        <?php
                                                                                                                        } else {
                                                                                                                        ?>
                                                                                                                              <input type="checkbox" class="btn-check" id="btncheck1">
                                                                                                                        <?php
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                        <label class="btn btn-outline-success" for="btncheck1">1-5</label>
                                                                                                                        <?php
                                                                                                                        if ($result2g->num_rows == 6) {
                                                                                                                        ?>
                                                                                                                              <input type="checkbox" class="btn-check" id="btncheck2" checked="" disabled>
                                                                                                                        <?php
                                                                                                                        } else {
                                                                                                                        ?>
                                                                                                                              <input type="checkbox" class="btn-check" id="btncheck2">
                                                                                                                        <?php
                                                                                                                        }
                                                                                                                        ?>

                                                                                                                        <label class="btn btn-outline-info" for="btncheck2">6-11</label>
                                                                                                                        <?php
                                                                                                                        if ($result3g->num_rows == 2) {
                                                                                                                        ?>
                                                                                                                              <input type="checkbox" class="btn-check" id="btncheck3" checked="" disabled>
                                                                                                                        <?php
                                                                                                                        } else {
                                                                                                                        ?>
                                                                                                                              <input type="checkbox" class="btn-check" id="btncheck3">
                                                                                                                        <?php
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                        <label class="btn btn-outline-warning" for="btncheck3">12-13</label>
                                                                                                                  </div>
                                                                                                            </div>
                                                                                                            <div id="" class="form-text text-danger">
                                                                                                                  you'll never be able to edit these details after adding system them once.
                                                                                                            </div>
                                                                                                            <div class="col-12 text-end">


                                                                                                                  <div class="btn-group ms-auto me-0" role="group" aria-label="Basic checkbox toggle button group">
                                                                                                                        <?php

                                                                                                                        if (!($result3g->num_rows == 2 || $result2g->num_rows == 6 || $result1g->num_rows == 5)) {
                                                                                                                        ?>
                                                                                                                              <button class="btn btn-info" id="gradeadd" onclick="addGrade();">Add to System</button>

                                                                                                                        <?php
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                  </div>
                                                                                                            </div>

                                                                                                      </div>


                                                                                                </div>
                                                                                          </div>
                                                                                    </div>
                                                                                    <div class="col-md-6">
                                                                                          <div class="card mb-4">
                                                                                                <h5 class="card-header">Medium</h5>
                                                                                                <div class="card-body">
                                                                                                      <label class="form-label d-block">Choose the teaching mediums in your school</label>
                                                                                                      <div class="row">
                                                                                                            <div class="col-12">
                                                                                                                  <div class="btn-group w-100" role="group">
                                                                                                                        <?php
                                                                                                                        $result1 = DB::search("SELECT * FROM `medium` WHERE `mname` ='Sinhala'");
                                                                                                                        $result2 = DB::search("SELECT * FROM `medium` WHERE `mname` ='English'");
                                                                                                                        $result3 = DB::search("SELECT * FROM `medium` WHERE `mname` ='Tamil'");
                                                                                                                        if ($result1->num_rows == 1) {
                                                                                                                        ?>
                                                                                                                              <input type="checkbox" class="btn-check" id="sinhala" checked="" disabled>
                                                                                                                        <?php
                                                                                                                        } else {
                                                                                                                        ?>
                                                                                                                              <input type="checkbox" class="btn-check" id="sinhala">

                                                                                                                        <?php
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                        <label class="btn btn-outline-success" for="sinhala">Sinhala</label>
                                                                                                                        <?php
                                                                                                                        if ($result2->num_rows == 1) {
                                                                                                                        ?>
                                                                                                                              <input type="checkbox" class="btn-check" id="Englsih" checked="" disabled>
                                                                                                                        <?php
                                                                                                                        } else {
                                                                                                                        ?>
                                                                                                                              <input type="checkbox" class="btn-check" id="Englsih">

                                                                                                                        <?php
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                        <label class="btn btn-outline-info" for="Englsih">Englsih</label>
                                                                                                                        <?php
                                                                                                                        if ($result3->num_rows == 1) {
                                                                                                                        ?>
                                                                                                                              <input type="checkbox" class="btn-check" id="Tamil" checked="" disabled>
                                                                                                                        <?php
                                                                                                                        } else {
                                                                                                                        ?>
                                                                                                                              <input type="checkbox" class="btn-check" id="Tamil">

                                                                                                                        <?php
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                        <label class="btn btn-outline-warning" for="Tamil">Tamil</label>
                                                                                                                  </div>
                                                                                                            </div>
                                                                                                            <div id="" class="form-text text-danger">
                                                                                                                  you'll never be able to edit these details after adding system them once.
                                                                                                            </div>
                                                                                                            <div class="col-12 text-end">

                                                                                                                  <div class="btn-group ms-auto me-0" role="group">
                                                                                                                        <?php
                                                                                                                        if (!($result1->num_rows == 1 || $result2->num_rows == 1 || $result3->num_rows == 1)) {
                                                                                                                        ?>
                                                                                                                              <button class="btn btn-info" id="addlang" onclick="addMedium();">Add to System</button>

                                                                                                                        <?php
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                  </div>
                                                                                                            </div>

                                                                                                      </div>


                                                                                                </div>
                                                                                          </div>
                                                                                    </div>
                                                                                    <?php

                                                                                    if (($result2g->num_rows == 6 || $result1g->num_rows == 5)) {
                                                                                          if ($result3g->num_rows == 2) {
                                                                                    ?>

                                                                                                <div class="col-md-6" id="albox">
                                                                                                      <div class="card mb-4">
                                                                                                            <h5 class="card-header">A/L Stream</h5>
                                                                                                            <div class="card-body">
                                                                                                                  <label class="form-label d-block">Select A/L Streams in Your School Have</label>
                                                                                                                  <div class="row">
                                                                                                                        <div class="col-12">
                                                                                                                              <?php
                                                                                                                              $result1 = DB::search("SELECT * FROM `al_stream` WHERE `stream_name` ='Physical-Science'");
                                                                                                                              $result2 = DB::search("SELECT * FROM `al_stream` WHERE `stream_name` ='Commerce'");
                                                                                                                              $result3 = DB::search("SELECT * FROM `al_stream` WHERE `stream_name` ='Arts'");
                                                                                                                              $result4 = DB::search("SELECT * FROM `al_stream` WHERE `stream_name` ='Bio-Science'");
                                                                                                                              $result5 = DB::search("SELECT * FROM `al_stream` WHERE `stream_name` ='Technology'");
                                                                                                                              ?>
                                                                                                                              <div class="btn-group w-100" role="group" aria-label="Basic checkbox toggle button group">
                                                                                                                                    <?php

                                                                                                                                    if ($result1->num_rows == 1) {
                                                                                                                                    ?>
                                                                                                                                          <input type="checkbox" class="btn-check" id="Physical-Science" checked="" disabled>

                                                                                                                                    <?php
                                                                                                                                    } else {
                                                                                                                                    ?>
                                                                                                                                          <input type="checkbox" class="btn-check" id="Physical-Science">

                                                                                                                                    <?php
                                                                                                                                    }
                                                                                                                                    ?>
                                                                                                                                    <label class="btn btn-outline-info" for="Physical-Science">Physical Science</label>
                                                                                                                                    <?php

                                                                                                                                    if ($result2->num_rows == 1) {
                                                                                                                                    ?>
                                                                                                                                          <input type="checkbox" class="btn-check" id="Commerce" checked="" disabled>


                                                                                                                                    <?php
                                                                                                                                    } else {
                                                                                                                                    ?>
                                                                                                                                          <input type="checkbox" class="btn-check" id="Commerce">
                                                                                                                                    <?php

                                                                                                                                    }
                                                                                                                                    ?>

                                                                                                                                    <label class="btn btn-outline-warning" for="Commerce">Commerce</label>


                                                                                                                              </div>
                                                                                                                              <div class="btn-group w-100" role="group" aria-label="Basic checkbox toggle button group">
                                                                                                                                    <?php

                                                                                                                                    if ($result3->num_rows == 1) {
                                                                                                                                    ?>
                                                                                                                                          <input type="checkbox" class="btn-check" id="Arts" checked="" disabled>

                                                                                                                                    <?php
                                                                                                                                    } else {
                                                                                                                                    ?>
                                                                                                                                          <input type="checkbox" class="btn-check" id="Arts">

                                                                                                                                    <?php

                                                                                                                                    }
                                                                                                                                    ?>
                                                                                                                                    <label class="btn btn-outline-secondary" for="Arts">Arts</label>
                                                                                                                                    <?php

                                                                                                                                    if ($result4->num_rows == 1) {
                                                                                                                                    ?>
                                                                                                                                          <input type="checkbox" class="btn-check" id="Bio-Science" checked="" disabled>


                                                                                                                                    <?php
                                                                                                                                    } else {
                                                                                                                                    ?>
                                                                                                                                          <input type="checkbox" class="btn-check" id="Bio-Science">


                                                                                                                                    <?php

                                                                                                                                    }
                                                                                                                                    ?>

                                                                                                                                    <label class="btn btn-outline-success" for="Bio-Science">Bio Science</label>
                                                                                                                                    <?php

                                                                                                                                    if ($result5->num_rows == 1) {
                                                                                                                                    ?>
                                                                                                                                          <input type="checkbox" class="btn-check" id="Technology" checked="" disabled>


                                                                                                                                    <?php
                                                                                                                                    } else {
                                                                                                                                    ?>
                                                                                                                                          <input type="checkbox" class="btn-check" id="Technology">


                                                                                                                                    <?php

                                                                                                                                    }
                                                                                                                                    ?>
                                                                                                                                    <label class="btn btn-outline-primary" for="Technology">Technology</label>


                                                                                                                              </div>
                                                                                                                        </div>
                                                                                                                        <div id="defaultFormControlHelp" class="form-text text-danger">
                                                                                                                              you'll never be able to edit these details after adding system them once.
                                                                                                                        </div>
                                                                                                                        <div class="col-12 text-end">

                                                                                                                              <div class="btn-group ms-auto me-0" role="group" aria-label="Basic checkbox toggle button group">
                                                                                                                                    <?php
                                                                                                                                    if (!($result1->num_rows == 1 || $result2->num_rows == 1 || $result3->num_rows == 1 || $result4->num_rows == 1 || $result5->num_rows == 1)) {
                                                                                                                                    ?>

                                                                                                                                          <button class="btn btn-info" id="addalstram" onclick="addALstream();">Add to System</button>
                                                                                                                                    <?php
                                                                                                                                    }
                                                                                                                                    ?>
                                                                                                                              </div>
                                                                                                                        </div>

                                                                                                                  </div>


                                                                                                            </div>
                                                                                                      </div>
                                                                                                </div>
                                                                                          <?php
                                                                                          }
                                                                                    } else {
                                                                                          ?>
                                                                                          <div class="col-md-6" id="albox">
                                                                                                <div class="card mb-4">
                                                                                                      <h5 class="card-header">A/L Stream</h5>
                                                                                                      <div class="card-body">
                                                                                                            <label class="form-label d-block">Select A/L Streams in Your School Have</label>
                                                                                                            <div class="row">
                                                                                                                  <div class="col-12">
                                                                                                                        <?php
                                                                                                                        $result1 = DB::search("SELECT * FROM `al_stream` WHERE `stream_name` ='Physical-Science'");
                                                                                                                        $result2 = DB::search("SELECT * FROM `al_stream` WHERE `stream_name` ='Commerce'");
                                                                                                                        $result3 = DB::search("SELECT * FROM `al_stream` WHERE `stream_name` ='Arts'");
                                                                                                                        $result4 = DB::search("SELECT * FROM `al_stream` WHERE `stream_name` ='Bio-Science'");
                                                                                                                        $result5 = DB::search("SELECT * FROM `al_stream` WHERE `stream_name` ='Technology'");
                                                                                                                        ?>
                                                                                                                        <div class="btn-group w-100" role="group" aria-label="Basic checkbox toggle button group">
                                                                                                                              <?php

                                                                                                                              if ($result1->num_rows == 1) {
                                                                                                                              ?>
                                                                                                                                    <input type="checkbox" class="btn-check" id="Physical-Science" checked="" disabled>

                                                                                                                              <?php
                                                                                                                              } else {
                                                                                                                              ?>
                                                                                                                                    <input type="checkbox" class="btn-check" id="Physical-Science">

                                                                                                                              <?php
                                                                                                                              }
                                                                                                                              ?>
                                                                                                                              <label class="btn btn-outline-info" for="Physical-Science">Physical Science</label>
                                                                                                                              <?php

                                                                                                                              if ($result2->num_rows == 1) {
                                                                                                                              ?>
                                                                                                                                    <input type="checkbox" class="btn-check" id="Commerce" checked="" disabled>


                                                                                                                              <?php
                                                                                                                              } else {
                                                                                                                              ?>
                                                                                                                                    <input type="checkbox" class="btn-check" id="Commerce">
                                                                                                                              <?php

                                                                                                                              }
                                                                                                                              ?>

                                                                                                                              <label class="btn btn-outline-warning" for="Commerce">Commerce</label>


                                                                                                                        </div>
                                                                                                                        <div class="btn-group w-100" role="group" aria-label="Basic checkbox toggle button group">
                                                                                                                              <?php

                                                                                                                              if ($result3->num_rows == 1) {
                                                                                                                              ?>
                                                                                                                                    <input type="checkbox" class="btn-check" id="Arts" checked="" disabled>

                                                                                                                              <?php
                                                                                                                              } else {
                                                                                                                              ?>
                                                                                                                                    <input type="checkbox" class="btn-check" id="Arts">

                                                                                                                              <?php

                                                                                                                              }
                                                                                                                              ?>
                                                                                                                              <label class="btn btn-outline-secondary" for="Arts">Arts</label>
                                                                                                                              <?php

                                                                                                                              if ($result4->num_rows == 1) {
                                                                                                                              ?>
                                                                                                                                    <input type="checkbox" class="btn-check" id="Bio-Science" checked="" disabled>


                                                                                                                              <?php
                                                                                                                              } else {
                                                                                                                              ?>
                                                                                                                                    <input type="checkbox" class="btn-check" id="Bio-Science">


                                                                                                                              <?php

                                                                                                                              }
                                                                                                                              ?>

                                                                                                                              <label class="btn btn-outline-success" for="Bio-Science">Bio Science</label>
                                                                                                                              <?php

                                                                                                                              if ($result5->num_rows == 1) {
                                                                                                                              ?>
                                                                                                                                    <input type="checkbox" class="btn-check" id="Technology" checked="" disabled>


                                                                                                                              <?php
                                                                                                                              } else {
                                                                                                                              ?>
                                                                                                                                    <input type="checkbox" class="btn-check" id="Technology">


                                                                                                                              <?php

                                                                                                                              }
                                                                                                                              ?>
                                                                                                                              <label class="btn btn-outline-primary" for="Technology">Technology</label>


                                                                                                                        </div>
                                                                                                                  </div>
                                                                                                                  <div id="defaultFormControlHelp" class="form-text text-danger">
                                                                                                                        you'll never be able to edit these details after adding system them once.
                                                                                                                  </div>
                                                                                                                  <div class="col-12 text-end">

                                                                                                                        <div class="btn-group ms-auto me-0" role="group" aria-label="Basic checkbox toggle button group">
                                                                                                                              <?php
                                                                                                                              if (!($result1->num_rows == 1 || $result2->num_rows == 1 || $result3->num_rows == 1 || $result4->num_rows == 1 || $result5->num_rows == 1)) {
                                                                                                                              ?>

                                                                                                                                    <button class="btn btn-info" id="addalstram" onclick="addALstream();">Add to System</button>
                                                                                                                              <?php
                                                                                                                              }
                                                                                                                              ?>
                                                                                                                        </div>
                                                                                                                  </div>

                                                                                                            </div>


                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>
                                                                                    <?php
                                                                                    }
                                                                                    ?>


                                                                              </div>
                                                                        </div>
                                                                        <div class="tab-pane fade" id="navs-pills-top-profile" role="tabpanel">
                                                                              <div class="row">


                                                                                    <div class="card mb-4">
                                                                                          <h5 class="card-header">Account Settings</h5>
                                                                                          <!-- Account -->
                                                                                          <div class="card-body">
                                                                                                <div class="row">
                                                                                                      <div class="col-12">
                                                                                                            <div class="row">
                                                                                                                  <div class="col-6 col-lg-3">
                                                                                                                        Application Theam

                                                                                                                  </div>

                                                                                                                  <?php
                                                                                                                  $isdark = DB::search("SELECT * FROM `dark_theam` WHERE `user_uid`='" . $_SESSION["admin"]["uid"] . "'");
                                                                                                                  if ($isdark->num_rows == 1) {
                                                                                                                  ?>
                                                                                                                        <div class="col-3 col-lg-2 form-check">
                                                                                                                              <input class="form-check-input" name="theam" onchange="Lighttheam('admin');" type="radio" id="lighttheam">
                                                                                                                              <label class="form-check-label" for="lighttheam"> Light </label>

                                                                                                                        </div>
                                                                                                                        <div class="col form-check">
                                                                                                                              <input class="form-check-input" name="theam" onchange="darktheam('admin');" type="radio" id="darktheam" checked>
                                                                                                                              <label class="form-check-label" for="darktheam"> Dark </label>

                                                                                                                        </div>
                                                                                                                  <?php
                                                                                                                  } else {
                                                                                                                  ?>
                                                                                                                        <div class="col-3 col-lg-2 form-check">
                                                                                                                              <input class="form-check-input" name="theam" onchange="Lighttheam('admin');" type="radio" id="lighttheam" checked>
                                                                                                                              <label class="form-check-label" for="lighttheam"> Light </label>

                                                                                                                        </div>
                                                                                                                        <div class="col form-check">
                                                                                                                              <input class="form-check-input" name="theam" onchange="darktheam('admin');" type="radio" id="darktheam">
                                                                                                                              <label class="form-check-label" for="darktheam"> Dark </label>

                                                                                                                        </div>
                                                                                                                  <?php
                                                                                                                  }
                                                                                                                  ?>
                                                                                                            </div>
                                                                                                            <div class="row pt-2">
                                                                                                                  <div class="col-6 col-lg-3">
                                                                                                                        Two step verification

                                                                                                                  </div>

                                                                                                                  <div class="col form-check form-switch mb-2">
                                                                                                                        <?php
                                                                                                                        $user = DB::search("SELECT * FROM `user` WHERE `uid`='" . $_SESSION["admin"]["uid"] . "'");
                                                                                                                        if ($user->num_rows == 1) {
                                                                                                                              $userD = $user->fetch_assoc();
                                                                                                                              if ($userD["tsv_status"] == 1) {
                                                                                                                        ?>

                                                                                                                                    <input class="form-check-input" type="checkbox" onchange="twoStepVerify('admin');" id="verifiyid" checked="">
                                                                                                                                    <label class="form-check-label" for="verifiyid">ON</label>
                                                                                                                              <?php
                                                                                                                              } else {
                                                                                                                              ?>

                                                                                                                                    <input class="form-check-input" type="checkbox" onchange="twoStepVerify('admin');" id="verifiyid">
                                                                                                                                    <label class="form-check-label" for="verifiyid">OFF</label>
                                                                                                                        <?php
                                                                                                                              }
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                  </div>
                                                                                                            </div>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>

                                                                                    </div>
                                                                                    <div class="card">
                                                                                          <h5 class="card-header">Change Password</h5>
                                                                                          <div class="card-body">
                                                                                                <div class="row">

                                                                                                      <div class="mb-0 col-md-6">
                                                                                                            <label for="currpasswod" class="form-label">Current Password</label>
                                                                                                            <input class="form-control" type="password" id="currpasswod" placeholder="Enter you current password">
                                                                                                            <div class="form-text text-danger" id="errorid1">
                                                                                                            </div>
                                                                                                      </div>
                                                                                                      <div class="mb-0  col-md-6">
                                                                                                            <label for="newpws" class="form-label">New Password</label>
                                                                                                            <input class="form-control" type="password" id="newpws" placeholder="Enter you new password">
                                                                                                            <div class="form-text text-danger" id="errorid2">
                                                                                                            </div>
                                                                                                      </div>
                                                                                                      <div class="mb-0  col-md-6">
                                                                                                            <label for="Cnewpws" class="form-label">Comfirm New Password</label>
                                                                                                            <input class="form-control" type="password" id="Cnewpws" placeholder="Enter you comfirm password">
                                                                                                            <div class="form-text text-danger" id="errorview">
                                                                                                            </div>
                                                                                                      </div>
                                                                                                      <div class="col-12 text-end">
                                                                                                            <button type="submit" class="btn btn-info " onclick="resetPws('admin');">Save</button>

                                                                                                      </div>
                                                                                                </div>

                                                                                          </div>
                                                                                    </div>
                                                                              </div>
                                                                        </div>
                                                                  <?php
                                                                  } else {
                                                                  ?>
                                                                        <div class="tab-pane fade active show " id="navs-pills-top-profile" role="tabpanel">
                                                                              <div class="row">


                                                                                    <div class="card mb-4">
                                                                                          <h5 class="card-header">Account Settings</h5>
                                                                                          <!-- Account -->
                                                                                          <div class="card-body">
                                                                                                <div class="row">
                                                                                                      <div class="col-12">
                                                                                                            <div class="row">
                                                                                                                  <div class="col-6 col-lg-3">
                                                                                                                        Application Theam

                                                                                                                  </div>
                                                                                                                  <?php
                                                                                                                  $isdark = DB::search("SELECT * FROM `dark_theam` WHERE `user_uid`='" . $_SESSION["admin"]["uid"] . "'");
                                                                                                                  if ($isdark->num_rows == 1) {
                                                                                                                  ?>
                                                                                                                        <div class="col-3 col-lg-2 form-check">
                                                                                                                              <input class="form-check-input" name="theam" onchange="Lighttheam('admin');" type="radio" id="lighttheam">
                                                                                                                              <label class="form-check-label" for="lighttheam"> Light </label>

                                                                                                                        </div>
                                                                                                                        <div class="col form-check">
                                                                                                                              <input class="form-check-input" name="theam" onchange="darktheam('admin');" type="radio" id="darktheam" checked>
                                                                                                                              <label class="form-check-label" for="darktheam"> Dark </label>

                                                                                                                        </div>
                                                                                                                  <?php
                                                                                                                  } else {
                                                                                                                  ?>
                                                                                                                        <div class="col-3 col-lg-2 form-check">
                                                                                                                              <input class="form-check-input" name="theam" onchange="Lighttheam('admin');" type="radio" id="lighttheam" checked>
                                                                                                                              <label class="form-check-label" for="lighttheam"> Light </label>

                                                                                                                        </div>
                                                                                                                        <div class="col form-check">
                                                                                                                              <input class="form-check-input" name="theam" onchange="darktheam('admin');" type="radio" id="darktheam">
                                                                                                                              <label class="form-check-label" for="darktheam"> Dark </label>

                                                                                                                        </div>
                                                                                                                  <?php
                                                                                                                  }
                                                                                                                  ?>
                                                                                                            </div>
                                                                                                            <div class="row pt-2">
                                                                                                                  <div class="col-6 col-lg-3">
                                                                                                                        Two step verification

                                                                                                                  </div>

                                                                                                                  <div class="col form-check form-switch mb-2">
                                                                                                                        <?php
                                                                                                                        $user = DB::search("SELECT * FROM `user` WHERE `uid`='" . $_SESSION["admin"]["uid"] . "'");
                                                                                                                        if ($user->num_rows == 1) {
                                                                                                                              $userD = $user->fetch_assoc();
                                                                                                                              if ($userD["tsv_status"] == 1) {
                                                                                                                        ?>

                                                                                                                                    <input class="form-check-input" type="checkbox" onchange="twoStepVerify('admin');" id="verifiyid" checked="">
                                                                                                                                    <label class="form-check-label" for="verifiyid">ON</label>
                                                                                                                              <?php
                                                                                                                              } else {
                                                                                                                              ?>

                                                                                                                                    <input class="form-check-input" type="checkbox" onchange="twoStepVerify('admin');" id="verifiyid">
                                                                                                                                    <label class="form-check-label" for="verifiyid">OFF</label>
                                                                                                                        <?php
                                                                                                                              }
                                                                                                                        }
                                                                                                                        ?>
                                                                                                                  </div>
                                                                                                            </div>
                                                                                                      </div>
                                                                                                </div>
                                                                                          </div>

                                                                                    </div>
                                                                                    <div class="card">
                                                                                          <h5 class="card-header">Change Password</h5>
                                                                                          <div class="card-body">
                                                                                                <div class="row">
                                                                                                      <div class="mb-0 col-md-6">
                                                                                                            <label for="currpasswod" class="form-label">Current Password</label>
                                                                                                            <input class="form-control" type="password" id="currpasswod" placeholder="Enter you current password">
                                                                                                            <div class="form-text text-danger" id="errorid1">
                                                                                                            </div>
                                                                                                      </div>
                                                                                                      <div class="mb-0  col-md-6">
                                                                                                            <label for="newpws" class="form-label">New Password</label>
                                                                                                            <input class="form-control" type="password" id="newpws" placeholder="Enter you new password">
                                                                                                            <div class="form-text text-danger" id="errorid2">
                                                                                                            </div>
                                                                                                      </div>
                                                                                                      <div class="mb-0  col-md-6">
                                                                                                            <label for="Cnewpws" class="form-label">Comfirm New Password</label>
                                                                                                            <input class="form-control" type="password" id="Cnewpws" placeholder="Enter you comfirm password">
                                                                                                            <div class="form-text text-danger" id="errorview">
                                                                                                            </div>
                                                                                                      </div>
                                                                                                      <div class="col-12 text-end">
                                                                                                            <button type="submit" class="btn btn-info " onclick="resetPws();">Save</button>

                                                                                                      </div>
                                                                                                </div>

                                                                                          </div>
                                                                                    </div>
                                                                              </div>
                                                                        </div>
                                                                  <?php

                                                                  }
                                                                  ?>
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
            <script src="../js/admin.js"></script>


      </body>

      </html>
<?php
} else {
?>
      <script>
            window.location = "../../login/gui/admin-login.php";
      </script>
<?php
}
?>