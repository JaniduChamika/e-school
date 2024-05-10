<?php
require "../../connection/connection.php";

if (isset($_POST["page"])) {
      $page = (int)$_POST["page"];
      $grade = $_POST["g"];
      $sub = $_POST["s"];
      $pen = $_POST["pen"];
      $word = $_POST["word"];
?>

      <div class="table-responsive text-nowrap mb-4 scrollbar" style="min-height: 550px;max-height: 550px;">
            <table class="table table-hover expandable-table">
                  <thead>
                        <tr>
                              <th class="ps-3">#</th>
                              <th class="ps-3">Username</th>
                              <th class="ps-3">Name</th>

                              <th class="ps-3">Email Address</th>
                              <th class="ps-3">Contact No</th>
                              <th class="ps-3">Status</th>
                              <th class="ps-3">Class Status</th>

                              <th class="ps-2">Actions</th>
                        </tr>
                  </thead>
                  <tbody class="table-border-bottom-0 ">

                        <?php
                        //  search teachers 
                        $q = "SELECT * FROM `teachers`";

                        if (!empty($word)) {
                              // search teachers by username,fullname,contact,email or nic 
                              $q = $q . " WHERE (`username` LIKE '" . $word . "%' OR `fulname` LIKE '%" . $word . "%' OR `contact` LIKE '" . $word . "%' OR `email` LIKE '" . $word . "%' OR `nic_no` LIKE '" . $word . "%')";
                              if ($grade != "0" || $sub != "0" || $pen == "true") {
                                    $q = $q . "AND";
                              }
                        } else {
                              if ($grade != "0" || $sub != "0" || $pen == "true") {
                                    $q = $q . "WHERE";
                              }
                        }

                        // FILTER PART 
                        if ($grade != "0") {
                              $q = $q . "`uid` IN (SELECT `user_uid` FROM `teacher_has_grade` WHERE `grade_gid`='" . $grade . "')";
                        }
                        if ($grade != "0" && $sub != "0" || $grade != "0" &&  $pen == "true") {
                              $q = $q . " AND ";
                        }

                        if ($sub != "0") {
                              $q = $q . "`uid` IN (SELECT `user_uid` FROM `teacher_has_subject` WHERE `subject_id`='" . $sub . "')";
                        }
                        if ($grade != "0" && $sub != "0" && $pen == "true") {
                              $q = $q . "AND";
                        } else if ($sub != "0" && $pen == "true") {
                              $q = $q . "AND";
                        }
                        if ($pen == "true") {
                              $q = $q . "`state`='Pending'";
                        }
                        // for pagination 
                        $number_per_page = 10;
                        $offset = ($page - 1) * $number_per_page;
                        $pagination = DB::search($q);
                        $no_rows = $pagination->num_rows;
                        $no_of_page = $no_rows / $number_per_page;
                        if ($no_rows % $number_per_page != 0) {
                              $no_of_page = $no_of_page + 1;
                        }

                        $no_of_page = intval($no_of_page);
                        $reult;



                        $reult = DB::search($q . " LIMIT $number_per_page OFFSET $offset");



                        for ($i = 0; $i < $reult->num_rows; $i++) {
                              $d = $reult->fetch_assoc();
                        ?>
                              <!-- load teachers records  -->
                              <tr>
                                    <td><?php echo $i + 1 + $offset  ?></td>

                                    <td>
                                          <span>
                                                <?php
                                                if (empty($d["path"])) {
                                                ?>
                                                      <img src="../../image/profile/teacher-default.png" alt="Avatar" class="rounded-circle" style="width: 40px;">

                                                <?php
                                                } else {
                                                ?>
                                                      <img src="../../image/profile/<?php echo $d["path"] ?>" alt="Avatar" class="rounded-circle" style="width: 40px;">

                                                <?php
                                                }
                                                ?>
                                          </span>
                                          &nbsp;
                                          <span class="fw-bold text-capitalize"><?php echo $d["username"] ?></span>
                                    </td>
                                    <td><?php echo ucwords($d["fname"] . " " . $d["lname"]) ?></td>

                                    <td><?php echo $d["email"] ?></td>
                                    <td>
                                          <?php echo $d["contact"] ?>
                                    </td>
                                    <td>
                                          <?php
                                          if ($d["state"] == "Pending") {
                                          ?>
                                                <span class="badge bg-label-warning me-1">Pending</span>

                                          <?php
                                          } else if ($d["state"] == "Verified") {
                                          ?>
                                                <span class="badge bg-label-success me-1">Verified</span>

                                          <?php
                                          } else if ($d["state"] == "Blocked") {
                                          ?>
                                                <span class="badge bg-label-danger me-1">Blocked</span>

                                          <?php
                                          }
                                          ?>
                                    </td>
                                    <td class="text-center">
                                          <?php
                                          $ishaveClass = DB::search("SELECT * FROM `class` WHERE `teacher_tuid`='" . $d["uid"] . "'");
                                          if ($ishaveClass->num_rows >= 1) {
                                          ?>
                                                <span class="badge bg-label-success me-1">Assigned</span>

                                          <?php
                                          } else {
                                          ?>
                                                <span class="badge bg-label-danger me-1">Not Assigned</span>

                                          <?php
                                          }
                                          ?>
                                    </td>
                                    <td>
                                          <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                      <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                      <a class="dropdown-item" id="showmorebtn<?php echo $i; ?>" onclick="showMore(<?php echo $i; ?>);"><i class='bx bx-show-alt'></i></i> See More</a>

                                                      <a class="dropdown-item" href="teacher-edit.php?uid=<?php echo $d["uid"] ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>

                                                </div>
                                          </div>
                                    </td>
                              </tr>
                              <tr class="d-none advaViewUser" id="advancedetails<?php echo $i; ?>">
                                    <td colspan="8">
                                          <table cellpadding="5" cellspacing="0" style="width:100%;">
                                                <tbody>
                                                      <tr class="expanded-row">
                                                            <td colspan="8" class="row-bg">
                                                                  <div>
                                                                        <div class="d-flex justify-content-between">
                                                                              <div class="expanded-table-normal-cell ">
                                                                                    <div class="">
                                                                                          <p>Name</p>
                                                                                          <h6> <?php if ($d["gen"] == "Male") {
                                                                                                      echo "Mr.";
                                                                                                } else {
                                                                                                      echo "Mrs.";
                                                                                                }
                                                                                                echo $d["fulname"] ?></h6>
                                                                                    </div>

                                                                              </div>
                                                                              <div class="expanded-table-normal-cell ">
                                                                                    <div class="">
                                                                                          <p>NIC</p>
                                                                                          <h6><?php echo $d["nic_no"] ?></h6>
                                                                                    </div>

                                                                              </div>
                                                                              <div class="expanded-table-normal-cell">

                                                                                    <div class="">
                                                                                          <p>Reg Date</p>
                                                                                          <h6><?php echo $d["reg_date"] ?></h6>
                                                                                    </div>
                                                                              </div>
                                                                              <div class="expanded-table-normal-cell">

                                                                                    <div class="">
                                                                                          <p>Gender</p>

                                                                                          <h6>
                                                                                                <?php if ($d["gen"] == "Male") {
                                                                                                      echo "Male";
                                                                                                } else {
                                                                                                      echo "Female.";
                                                                                                }
                                                                                                ?></h6>
                                                                                    </div>
                                                                              </div>
                                                                              <div class="expanded-table-normal-cell">
                                                                                    <div class=" ">
                                                                                          <p>Address</p>

                                                                                          <h6><?php if (empty($d["address_line"])) {
                                                                                                      echo "None";
                                                                                                } else {
                                                                                                      echo $d["address_line"] . ", " . $d["city"] . " " . $d["district"];
                                                                                                } ?></h6>
                                                                                    </div>
                                                                              </div>
                                                                              <div class="expanded-table-normal-cell">

                                                                                    <div class="">
                                                                                          <p>Subject(s)</p>
                                                                                          <h6>
                                                                                                <?php
                                                                                                $subject = DB::search("SELECT * FROM `teacher_has_subject` INNER JOIN `subject` ON `teacher_has_subject`.`subject_id`=`subject`.`sub_id` WHERE `user_uid`='" . $d["uid"] . "'");
                                                                                                $subno = $subject->num_rows;
                                                                                                if ($subno >= 1) {

                                                                                                      for ($i2 = 0; $i2 < $subno; $i2++) {

                                                                                                            $subd = $subject->fetch_assoc();
                                                                                                            echo $subd["sub_name"] . ",";
                                                                                                      }
                                                                                                } else {
                                                                                                      echo "None";
                                                                                                }

                                                                                                ?>
                                                                                          </h6>
                                                                                    </div>
                                                                              </div>
                                                                              <div class="expanded-table-normal-cell">

                                                                                    <div class="">
                                                                                          <p>Grade(s)</p>
                                                                                          <h6>
                                                                                                <?php
                                                                                                $grade = DB::search("SELECT * FROM `teacher_has_grade` INNER JOIN `grade` ON `teacher_has_grade`.`grade_gid`=`grade`.`gid` WHERE `user_uid`='" . $d["uid"] . "'");
                                                                                                if ($grade->num_rows >= 1) {
                                                                                                      for ($i3 = 0; $i3 < $grade->num_rows; $i3++) {

                                                                                                            $gd = $grade->fetch_assoc();
                                                                                                            echo $gd["gname"] . ",";
                                                                                                      }
                                                                                                } else {
                                                                                                      echo "None";
                                                                                                }

                                                                                                ?> </h6>
                                                                                    </div>
                                                                              </div>
                                                                              <?php
                                                                              $ishaveClass = DB::search("SELECT * FROM `class` WHERE `teacher_tuid`='" . $d["uid"] . "'");
                                                                              if ($ishaveClass->num_rows >= 1) {
                                                                                    $data = $ishaveClass->fetch_assoc();
                                                                              ?>
                                                                                    <div class="expanded-table-normal-cell">

                                                                                          <div class="">
                                                                                                <p>Assigned Class</p>
                                                                                                <h6>
                                                                                                      <?php
                                                                                                      echo $data["clz_name"];

                                                                                                      ?>
                                                                                                </h6>
                                                                                          </div>
                                                                                    </div>

                                                                              <?php
                                                                              }
                                                                              ?>
                                                                              <div class="expanded-table-normal-cell">
                                                                                    <?php
                                                                                    if ($d["state"] == "Blocked") {
                                                                                    ?>
                                                                                          <button class="btn btn-rounded rounded-circle  btn-icon p-2 text-white unloackbtn" id="lock" onclick="unblockT(<?php echo $d['uid']; ?>,<?php echo $page ?>);">
                                                                                                <i class='bx bx-lock-open-alt'></i>
                                                                                          </button>
                                                                                    <?php
                                                                                    } else {
                                                                                    ?>
                                                                                          <button class="btn btn-rounded rounded-circle  btn-icon p-2 text-white" id="lock" onclick="blockT(<?php echo $d['uid']; ?>,<?php echo $page ?>);" style="background-color: #EC255A;">
                                                                                                <i class=' bx bxs-lock-alt'></i>

                                                                                          </button>
                                                                                    <?php
                                                                                    }
                                                                                    ?>


                                                                              </div>
                                                                        </div>
                                                                  </div>
                                                            </td>
                                                      </tr>
                                                </tbody>
                                          </table>
                                    </td>
                              </tr>
                        <?php
                        }
                        ?>


                  </tbody>
            </table>
      </div>
      <!-- pagination  button  -->
      <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                  <?php
                  if ($page != 1) {
                  ?>
                        <li class="page-item prev">
                              <a class="page-link" href="javascript:void(0);" onclick="searchTeacher(<?php echo $page - 1 ?>);"><i class="tf-icon bx bx-chevrons-left"></i></a>
                        </li>
                        <?php
                  }

                  for ($p = 1; $p <= $no_of_page; $p++) {
                        if ($page == $p) {
                        ?>
                              <li class="page-item active">
                                    <a class="page-link" href="javascript:void(0);" onclick="searchTeacher(<?php echo $p  ?>);"><?php echo $p ?></a>
                              </li>
                        <?php
                        } else {
                        ?>
                              <li class="page-item">
                                    <a class="page-link" href="javascript:void(0);" onclick="searchTeacher(<?php echo $p ?>);"><?php echo $p ?></a>
                              </li>
                        <?php
                        }
                  }
                  if ($no_of_page != $page && $no_of_page != 0) {
                        ?>
                        <li class="page-item next">
                              <a class="page-link" href="javascript:void(0);" onclick="searchTeacher(<?php echo $page + 1 ?>);"><i class="tf-icon bx bx-chevrons-right"></i></a>
                        </li>
                  <?php
                  }
                  ?>


            </ul>
      </nav>



<?php
} else {
?>
      <script>
            window.location = "../../misc/pages-404.php";
      </script>
<?php
}
