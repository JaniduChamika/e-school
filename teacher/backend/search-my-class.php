<?php
session_start();
require "../../connection/connection.php";
if (isset($_POST["page"])) {

      $techerId = $_SESSION["teacher"]["uid"];

      $ishaveClass = DB::search("SELECT * FROM `class` WHERE `teacher_tuid`='" . $techerId . "'");
      if ($ishaveClass->num_rows == 1) {
            $data = $ishaveClass->fetch_assoc();
            $page = $_POST["page"];

            $word = $_POST["word"];

?>

            <div class="table-responsive text-nowrap mb-4 scrollbar" style="min-height: 550px;max-height: 550px;">
                  <table class="table table-hover expandable-table">
                        <thead>
                              <tr>
                                    <th class="ps-3">#</th>
                                    <th class="ps-3">Student Username </th>
                                    <th class="ps-3">Student Name</th>
                                    <th class="ps-3">Email Address</th>

                                    <th class="ps-3">Contact No</th>

                                    <th class="ps-2">Actions</th>
                              </tr>
                        </thead>
                        <tbody class="table-border-bottom-0 ">
                              <?php
                              // search student acroding to class id 
                              $q = "SELECT * FROM `students`  WHERE `clz_id`='" . $data["clz_id"] . "'";
                              if (!empty($word)) {
                                    $q = $q . " AND (`username` LIKE '" . $word . "%' OR `fulname` LIKE '" . $word . "%' OR `email` LIKE '" . $word . "%' OR `contact` LIKE '" . $word . "%')";
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

                              $studnt = DB::search($q . " LIMIT $number_per_page OFFSET $offset");

                              for ($i = 0; $i < $studnt->num_rows; $i++) {
                                    $stuD = $studnt->fetch_assoc();
                              ?>
                                    <!-- load student details  -->
                                    <tr>
                                          <td><?php echo $i + 1 + $offset ?></td>

                                          <td>
                                                <span class="fw-bold text-capitalize"><?php echo $stuD["username"] ?></span>
                                          </td>
                                          <td><?php echo ucwords($stuD["fname"] . " " . $stuD["lname"]) ?></td>
                                          <td class="ps-3"><?php echo $stuD["email"] ?></td>
                                          <td><?php echo $stuD["contact"] ?></td>

                                          <td>
                                                <div class="dropdown">
                                                      <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                            <i class="bx bx-dots-vertical-rounded"></i>
                                                      </button>
                                                      <div class="dropdown-menu">

                                                            <a class="dropdown-item" id="showmorebtn<?php echo $i; ?>" onclick="showMore(<?php echo $i; ?>);"><i class='bx bx-show-alt'></i> See More</a>
                                                            <!-- <a class="dropdown-item" href="javascript:void(0);"><i class='bx bx-trash'></i> Delete</a> -->

                                                      </div>
                                                </div>
                                          </td>
                                    </tr>
                                    <tr class="d-none advaViewUser" id="advancedetails<?php echo $i; ?>">
                                          <td colspan="6">
                                                <table cellpadding="5" cellspacing="0" style="width:100%;">
                                                      <tbody>
                                                            <tr class="expanded-row">
                                                                  <td colspan="8" class="row-bg">
                                                                        <div>
                                                                              <div class="d-flex justify-content-between">
                                                                                    <div class="expanded-table-normal-cell ">
                                                                                          <div class="">
                                                                                                <p>Full Name </p>
                                                                                                <h6><?php echo $stuD["fulname"] ?></h6>
                                                                                          </div>

                                                                                    </div>
                                                                                    <div class="expanded-table-normal-cell ">
                                                                                          <div class="">
                                                                                                <p>Guardian Name</p>
                                                                                                <h6><?php echo $stuD["guardian_name"] ?></h6>
                                                                                          </div>

                                                                                    </div>
                                                                                    <div class="expanded-table-normal-cell ">
                                                                                          <div class="">
                                                                                                <p>Guardian Contact No</p>
                                                                                                <h6><?php echo $stuD["guardian_contact"] ?></h6>
                                                                                          </div>

                                                                                    </div>
                                                                                    <div class="expanded-table-normal-cell">

                                                                                          <div class="">
                                                                                                <p>DOB</p>
                                                                                                <h6><?php echo $stuD["dob"] ?></h6>
                                                                                          </div>
                                                                                    </div>
                                                                                    <div class="expanded-table-normal-cell">

                                                                                          <div class="">
                                                                                                <p>Gender</p>
                                                                                                <h6><?php echo $stuD["gen"] ?></h6>
                                                                                          </div>
                                                                                    </div>
                                                                                    <div class="expanded-table-normal-cell">
                                                                                          <div class=" ">
                                                                                                <p>Address</p>

                                                                                                <h6><?php echo $stuD["address_line"] . " " . $stuD["city"] ?></h6>
                                                                                          </div>
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
                                    <a class="page-link" href="javascript:void(0);" onclick="searchMyclass(<?php echo $page - 1 ?>);"><i class="tf-icon bx bx-chevrons-left"></i></a>
                              </li>
                              <?php
                        }

                        for ($p = 1; $p <= $no_of_page; $p++) {
                              if ($page == $p) {
                              ?>
                                    <li class="page-item active">
                                          <a class="page-link" href="javascript:void(0);" onclick="searchMyclass(<?php echo $p  ?>);"><?php echo $p ?></a>
                                    </li>
                              <?php
                              } else {
                              ?>
                                    <li class="page-item">
                                          <a class="page-link" href="javascript:void(0);" onclick="searchMyclass(<?php echo $p ?>);"><?php echo $p ?></a>
                                    </li>
                              <?php
                              }
                        }
                        if ($no_of_page != $page && $no_of_page != 0 && $no_of_page != 0) {
                              ?>
                              <li class="page-item next">
                                    <a class="page-link" href="javascript:void(0);" onclick="searchMyclass(<?php echo $page + 1 ?>);"><i class="tf-icon bx bx-chevrons-right"></i></a>
                              </li>
                        <?php
                        }
                        ?>
                  </ul>
            </nav>






      <?php
      }
} else {
      ?>
      <script>
            window.location = "../../misc/pages-404.php";
      </script>
<?php
}
