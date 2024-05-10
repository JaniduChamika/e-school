<?php

require "../connection/connection.php";

if (isset($_POST["date"])) {
      $date = $_POST["date"];
      $explo = explode("-", $date);
      $day1 = $explo[2];

      $jd1 = gregoriantojd($explo[1], $explo[2], $explo[0]);
      $monthname1 = jdmonthname($jd1, 0);
      $result = DB::search("SELECT * FROM `event` WHERE `e_date`='" . $date . "'");
      if ($result->num_rows >= 1) {
            // load event for calander 
?>
            <span class="events__title">Upcoming events on oct <?php echo $monthname1 . " " . $day1 ?></span>
            <ul class="events__list p-0">

                  <?php
                  for ($i = 0; $i < $result->num_rows; $i++) {
                        $d = $result->fetch_assoc();
                  ?>
                        <li class="events__item">
                              <div class="events__item--left">
                                    <span class="events__name"><?php echo $d["ev_info"] ?></span>
                                    <span class="events__date"><?php
                                                                  $day = explode("-", $d["e_date"]);

                                                                  $jd2 = gregoriantojd($day[1], $day[2], $day[0]);
                                                                  echo $monthname = jdmonthname($jd2, 0);
                                                                  echo $day[2]; ?></span>
                              </div>
                              <span class="events__tag"><?php
                                                            $tim = explode(":", $d["e_time"]);

                                                            echo  $tim[0] . ":" . $tim[1] ?></span>
                        </li>
                  <?php
                  }

                  ?>

            </ul>
      <?php


      } else {
      }
} else {
      ?>
      <script>
            // window.location = "../../misc/pages-404.php";
      </script>
<?php
}


?>