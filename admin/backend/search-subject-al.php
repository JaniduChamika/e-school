<?php
require "../../connection/connection.php";

if (isset($_POST["page"])) {
      $page = $_POST["page"];
      $stream = $_POST["s"];
      $word = $_POST["word"];
?>

      <div class="table-responsive text-nowrap overflow-auto scrollbar" style="min-height: 600px;max-height: 680px;">
            <table class="table table-hover">
                  <thead>
                        <tr>
                              <th>#</th>

                              <th>Subject Name</th>
                              <th>A/L Stream</th>
                              <th class="text-center">Actions</th>

                        </tr>
                  </thead>
                  <tbody class="table-border-bottom-0">
                        <?php
                        // search a/l subject  
                        $q = "SELECT * FROM `allsubject` WHERE `sub_grade_type`=1213";
                        if ($stream != "0") {
                              $q = $q . " AND `s_id`='" . $stream . "'";
                        }
                        if (!empty($word)) {
                              $q = $q . " AND (`sub_name` LIKE '" . $word . "%')";
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

                        $reult = DB::search($q . "  ORDER BY `sub_name` ASC LIMIT $number_per_page OFFSET $offset");


                        for ($i = 0; $i < $reult->num_rows; $i++) {
                              $d = $reult->fetch_assoc();

                        ?>
                              <!-- load a/l subject  -->
                              <tr>
                                    <td><?php echo $i + 1 + $offset ?></td>
                                    <td><?php

                                          echo $d["sub_name"];


                                          ?></td>
                                    <td>
                                          <?php


                                          echo $d["stream_name"];


                                          ?>
                                    </td>


                                    <td class="text-center">
                                          <div class="dropdown">
                                                <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                                      <i class="bx bx-dots-vertical-rounded"></i>
                                                </button>
                                                <div class="dropdown-menu">

                                                      <a class="dropdown-item" href="#" onclick="showModel(<?php echo $d['sub_id'] ?>, 'ed-subject','<?php echo $d['sub_name'] ?>');"><i class='bx bx-rename'></i> Rename</a>
                                                      <?php
                                                      $subUsed = DB::search(" SELECT assignment.sub_id FROM assignment WHERE `sub_id`=" . $d['sub_id'] . " UNION SELECT note.sub_id  FROM  note WHERE `sub_id`=" . $d['sub_id'] . " UNION SELECT teacher_has_subject.subject_id FROM teacher_has_subject  WHERE `subject_id`=" . $d['sub_id'] . "");
                                                      if ($subUsed->num_rows == 0) {
                                                      ?>
                                                            <a class="dropdown-item" href="#" onclick="showDelModel(<?php echo $d['sub_id'] ?>);"><i class="bx bx-trash me-1"></i> Delete</a>

                                                      <?php
                                                      }
                                                      ?>
                                                </div>
                                          </div>
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
                              <a class="page-link" href="javascript:void(0);" onclick="searchSubjectal(<?php echo $page - 1 ?>);"><i class="tf-icon bx bx-chevrons-left"></i></a>
                        </li>
                        <?php
                  }

                  for ($p = 1; $p <= $no_of_page; $p++) {
                        if ($page == $p) {
                        ?>
                              <li class="page-item active">
                                    <a class="page-link" href="javascript:void(0);" onclick="searchSubjectal(<?php echo $p  ?>);"><?php echo $p ?></a>
                              </li>
                        <?php
                        } else {
                        ?>
                              <li class="page-item">
                                    <a class="page-link" href="javascript:void(0);" onclick="searchSubjectal(<?php echo $p ?>);"><?php echo $p ?></a>
                              </li>
                        <?php
                        }
                  }
                  if ($no_of_page != $page && $no_of_page != 0) {
                        ?>
                        <li class="page-item next">
                              <a class="page-link" href="javascript:void(0);" onclick="searchSubjectal(<?php echo $page + 1 ?>);"><i class="tf-icon bx bx-chevrons-right"></i></a>
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
