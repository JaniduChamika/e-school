<?php
require "../../connection/connection.php";
if (isset($_POST["page"])) {
      $page = $_POST["page"];

      $grade = $_POST["g"];
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
                              <th class="ps-2">Actions</th>
                        </tr>
                  </thead>
                  <tbody class="table-border-bottom-0 ">
                        <?php
                        // search student 
                        $q = "SELECT * FROM `students` ";
                        if (!empty($word)) {
                              // search student by username, fullname,contact or email 
                              $q = $q . " WHERE (`username` LIKE '" . $word . "%' OR `fulname` LIKE '%" . $word . "%' OR `contact` LIKE '" . $word . "%' OR `email` LIKE '" . $word . "%')";
                              if ($pen == "true" || $grade != 0) {
                                    $q = $q . "AND";
                              }
                        } else {
                              if ($pen == "true" || $grade != 0) {
                                    $q = $q . "WHERE";
                              }
                        }
                        if ($grade != "0") {
                              $q = $q . " `gid`='" . $grade . "'";
                        }
                        if ($pen == "true" && $grade != 0) {
                              $q = $q . " AND ";
                        }
                        if ($pen == "true") {
                              $q = $q . " `state`='Pending'";
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
                        <!-- load student records  -->
                              <tr>
                                    <td><?php echo $i + 1 + $offset ?></td>

                                    <td>
                                          <span>
                                                <?php
                                                if (empty($d["path"])) {
                                                ?>
                                                      <img src="../../image/profile/student-default.png" alt="Avatar" class="rounded-circle" style="width: 40px;">

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

                                    <td>
                                          <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                      <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">
                                                      <a class="dropdown-item" id="showmorebtn<?php echo $i; ?>" onclick="showMore(<?php echo $i; ?>);"><i class='bx bx-show-alt'></i></i> See More</a>

                                                      <a class="dropdown-item" href="student-edit.php?uid=<?php echo $d["uid"] ?>"><i class="bx bx-edit-alt me-1"></i> Edit</a>

                                                </div>
                                          </div>
                                    </td>
                              </tr>
                              <tr class="d-none advaViewUser" id="advancedetails<?php echo $i; ?>">
                                    <td colspan="7">
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
                                                                                          <p>Class</p>
                                                                                          <h6><?php echo $d["clz_name"] ?></h6>
                                                                                    </div>
                                                                              </div>
                                                                              <?php
                                                                              if ($d["grade"] > 11) {
                                                                              ?>
                                                                                    <div class="expanded-table-normal-cell d-none">

                                                                                          <div class="">
                                                                                                <p>A/L Stream</p>
                                                                                                <h6>Maths</h6>
                                                                                          </div>
                                                                                    </div>
                                                                              <?php
                                                                              }
                                                                              ?>

                                                                              <div class="expanded-table-normal-cell">
                                                                                    <?php
                                                                                    if ($d["state"] == "Blocked") {
                                                                                    ?>
                                                                                          <button class="btn btn-rounded rounded-circle  btn-icon p-2 text-white unloackbtn" id="lock" onclick="unblockS(<?php echo $d['uid']; ?>,<?php echo $page ?>);">
                                                                                                <i class='bx bx-lock-open-alt'></i>
                                                                                          </button>
                                                                                    <?php
                                                                                    } else {
                                                                                    ?>
                                                                                          <button class="btn btn-rounded rounded-circle  btn-icon p-2 text-white" id="lock" onclick="blockS(<?php echo $d['uid']; ?>,<?php echo $page ?>);" style="background-color: #EC255A;">
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
                              <a class="page-link" href="javascript:void(0);" onclick="searchStudent(<?php echo $page - 1 ?>);"><i class="tf-icon bx bx-chevrons-left"></i></a>
                        </li>
                        <?php
                  }

                  for ($p = 1; $p <= $no_of_page; $p++) {
                        if ($page == $p) {
                        ?>
                              <li class="page-item active">
                                    <a class="page-link" href="javascript:void(0);" onclick="searchStudent(<?php echo $p  ?>);"><?php echo $p ?></a>
                              </li>
                        <?php
                        } else {
                        ?>
                              <li class="page-item">
                                    <a class="page-link" href="javascript:void(0);" onclick="searchStudent(<?php echo $p ?>);"><?php echo $p ?></a>
                              </li>
                        <?php
                        }
                  }
                  if ($no_of_page != $page && $no_of_page != 0) {
                        ?>
                        <li class="page-item next">
                              <a class="page-link" href="javascript:void(0);" onclick="searchStudent(<?php echo $page + 1 ?>);"><i class="tf-icon bx bx-chevrons-right"></i></a>
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
