<?php

$d = new DateTime();
$tz = new DateTimeZone("Asia/Colombo");
$d->setTimezone($tz);
$date = $d->format("Y-m-d");
$month = $d->format("m");
$year = $d->format("Y");
$today = $d->format("d");

$nodays = cal_days_in_month(CAL_GREGORIAN, $month, $year);
$nodaysprvios;

if ($month == 1) {
      $nodaysprvios = cal_days_in_month(CAL_GREGORIAN, 12, $year - 1);
} else {
      $nodaysprvios = cal_days_in_month(CAL_GREGORIAN, $month - 1, $year);
}

$jd = gregoriantojd($month, 1, $year);
$wday = jddayofweek($jd, 0);
$jd2 = gregoriantojd($month, $today, $year);
$monthname = jdmonthname($jd2, 1);

if ($wday == 0) {

      $pwfd = 31;
      $pwld = 30;

      $fday = 1;
      $feld = 7;
      $swfd = 8;
      $swld = 14;
      $twfd = 15;
      $twld = 21;
      $fwfd = 22;
      $fwld = 28;
      $fiwfd = 29;
      $fiwld = $nodays;
} else if ($wday == 1) {

      $pwfd = $nodaysprvios;
      $pwld = $nodaysprvios;

      $fday = 1;
      $feld = 6;
      $swfd = 7;
      $swld = 13;
      $twfd = 14;
      $twld = 20;
      $fwfd = 21;
      $fwld = 27;
      $fiwfd = 28;
      $fiwld = $nodays;
} else if ($wday == 2) {

      $pwfd = $nodaysprvios - 1;
      $pwld = $nodaysprvios;

      $fday = 1;
      $feld = 5;
      $swfd = 6;
      $swld = 12;
      $twfd = 13;
      $twld = 19;
      $fwfd = 20;
      $fwld = 26;
      $fiwfd = 27;
      $fiwld = $nodays;
} else if ($wday == 3) {

      $pwfd = $nodaysprvios - 2;
      $pwld = $nodaysprvios;

      $fday = 1;
      $feld = 4;
      $swfd = 5;
      $swld = 11;
      $twfd = 12;
      $twld = 18;
      $fwfd = 19;
      $fwld = 25;
      $fiwfd = 26;
      $fiwld = $nodays;
} else if ($wday == 4) {

      $pwfd = $nodaysprvios - 3;
      $pwld = $nodaysprvios;

      $fday = 1;
      $feld = 3;
      $swfd = 4;
      $swld = 10;
      $twfd = 11;
      $twld = 17;
      $fwfd = 18;
      $fwld = 24;
      $fiwfd = 25;
      $fiwld = $nodays;
} else if ($wday == 5) {

      $pwfd = $nodaysprvios - 4;
      $pwld = $nodaysprvios;

      $fday = 1;
      $feld = 2;
      $swfd = 3;
      $swld = 9;
      $twfd = 10;
      $twld = 16;
      $fwfd = 17;
      $fwld = 23;
      $fiwfd = 24;
      $fiwld = $nodays;
} else if ($wday == 6) {

      $pwfd = $nodaysprvios - 5;
      $pwld = $nodaysprvios;

      $fday = 1;
      $feld = 1;
      $swfd = 2;
      $swld = 8;
      $twfd = 9;
      $twld = 15;
      $fwfd = 16;
      $fwld = 22;
      $fiwfd = 23;
      $fiwld = $nodays;
}

?>


<div class="main-container-wrapper">

      <main>
            <div class="calendar-container" id="calender-ui">
                  <div class="calendar-container__header">
                        <button class="calendar-container__btn calendar-container__btn--left" title="Previous">
                              <i class='bx bx-chevron-left'></i>
                        </button>
                        <h2 class="calendar-container__title m-auto text-secondary"> <?php echo $monthname . " " . $year ?></h2>
                        <button class="calendar-container__btn calendar-container__btn--right" title="Next">
                              <i class='bx bx-chevron-right'></i>
                        </button>
                  </div>
                  <div class="calendar-container__body">
                        <div class="calendar-table">
                              <div class="calendar-table__header">
                                    <div class="calendar-table__row">
                                          <div class="calendar-table__col">S</div>
                                          <div class="calendar-table__col">M</div>
                                          <div class="calendar-table__col">T</div>
                                          <div class="calendar-table__col">W</div>
                                          <div class="calendar-table__col">T</div>
                                          <div class="calendar-table__col">F</div>
                                          <div class="calendar-table__col">S</div>
                                    </div>
                              </div>
                              <div class="calendar-table__body">
                                    <div class="calendar-table__row">
                                          <!-- <div class="calendar-table__col calendar-table__inactive">
                                                <div class="calendar-table__item">
                                                      <span>30</span>
                                                </div>
                                          </div> -->
                                          <!-- <div class="calendar-table__col calendar-table__today">
                                                      <div class="calendar-table__item">
                                                            <span>1</span>
                                                      </div>
                                                </div> -->
                                          <!-- <div class="calendar-table__col calendar-table__event" onclick="showevent();">
                                                      <div class="calendar-table__item">
                                                            <span>5</span>
                                                      </div>
                                                </div> -->
                                          <?php
                                          for ($i = $pwfd; $i <= $pwld; $i++) {

                                          ?>


                                                <div class="calendar-table__col calendar-table__inactive">
                                                      <div class="calendar-table__item">
                                                            <span><?php echo $i ?></span>

                                                      </div>
                                                </div>


                                          <?php
                                          }
                                          ?>
                                          <?php
                                          for ($i = $fday; $i <= $feld; $i++) {
                                                $todate = $year . "-" . $month . "-" . str_pad($i, 2, "0", STR_PAD_LEFT);
                                                if ($todate == $date) {
                                          ?>
                                                      <div class="calendar-table__col calendar-table__today">
                                                            <div class="calendar-table__item">
                                                                  <span><?php echo $i ?></span>
                                                            </div>
                                                      </div>
                                                      <?php
                                                } else {
                                                      $haveEve = DB::search("SELECT * FROM `event` WHERE `e_date`='" . $todate . "'");
                                                      if ($haveEve->num_rows >= 1) {
                                                      ?>
                                                            <div class="calendar-table__col calendar-table__event" onclick="eventLoder('<?php echo $todate ?>');">
                                                                  <div class="calendar-table__item">
                                                                        <span><?php echo $i ?></span>
                                                                  </div>
                                                            </div>
                                                      <?php
                                                      } else {
                                                      ?>
                                                            <div class="calendar-table__col">
                                                                  <div class="calendar-table__item">
                                                                        <span><?php echo $i ?></span>
                                                                  </div>
                                                            </div>
                                          <?php

                                                      }
                                                }
                                          }
                                          ?>

                                    </div>
                                    <div class="calendar-table__row">
                                          <!-- <div class="calendar-table__col calendar-table__event">
                                                <div class="calendar-table__item">
                                                      <span>7</span>
                                                </div>
                                          </div> -->
                                          <?php
                                          for ($i = $swfd; $i <= $swld; $i++) {
                                                $todate = $year . "-" . $month . "-" . str_pad($i, 2, "0", STR_PAD_LEFT);
                                                if ($todate == $date) {
                                          ?>
                                                      <div class="calendar-table__col calendar-table__today">
                                                            <div class="calendar-table__item">
                                                                  <span><?php echo $i ?></span>
                                                            </div>
                                                      </div>
                                                      <?php
                                                } else {
                                                      $haveEve = DB::search("SELECT * FROM `event` WHERE `e_date`='" . $todate . "'");
                                                      if ($haveEve->num_rows >= 1) {
                                                      ?>
                                                            <div class="calendar-table__col calendar-table__event" onclick="eventLoder('<?php echo $todate ?>');">
                                                                  <div class="calendar-table__item">
                                                                        <span><?php echo $i ?></span>
                                                                  </div>
                                                            </div>
                                                      <?php
                                                      } else {
                                                      ?>
                                                            <div class="calendar-table__col">
                                                                  <div class="calendar-table__item">
                                                                        <span><?php echo $i ?></span>
                                                                  </div>
                                                            </div>
                                          <?php
                                                      }
                                                }
                                          }
                                          ?>
                                    </div>
                                    <div class="calendar-table__row">
                                          <?php
                                          for ($i = $twfd; $i <= $twld; $i++) {
                                                $todate = $year . "-" . $month . "-" . str_pad($i, 2, "0", STR_PAD_LEFT);
                                                if ($todate == $date) {
                                          ?>
                                                      <div class="calendar-table__col calendar-table__today">
                                                            <div class="calendar-table__item">
                                                                  <span><?php echo $i ?></span>
                                                            </div>
                                                      </div>
                                                      <?php
                                                } else {
                                                      $haveEve = DB::search("SELECT * FROM `event` WHERE `e_date`='" . $todate . "'");
                                                      if ($haveEve->num_rows >= 1) {
                                                      ?>
                                                            <div class="calendar-table__col calendar-table__event" onclick="eventLoder('<?php echo $todate ?>');">
                                                                  <div class="calendar-table__item">
                                                                        <span><?php echo $i ?></span>
                                                                  </div>
                                                            </div>
                                                      <?php
                                                      } else {
                                                      ?>
                                                            <div class="calendar-table__col">
                                                                  <div class="calendar-table__item">
                                                                        <span><?php echo $i ?></span>
                                                                  </div>
                                                            </div>
                                          <?php


                                                      }
                                                }
                                          }
                                          ?>
                                          <!-- <div class="calendar-table__col calendar-table__event calendar-table__event--long calendar-table__event--start">
                                                <div class="calendar-table__item">
                                                      <span>16</span>
                                                </div>
                                          </div>
                                          <div class="calendar-table__col calendar-table__event calendar-table__event--long">
                                                <div class="calendar-table__item">
                                                      <span>17</span>
                                                </div>
                                          </div>
                                          <div class="calendar-table__col calendar-table__event calendar-table__event--long calendar-table__event--end">
                                                <div class="calendar-table__item">
                                                      <span>18</span>
                                                </div>
                                          </div> -->

                                    </div>
                                    <div class="calendar-table__row">
                                          <?php
                                          for ($i = $fwfd; $i <= $fwld; $i++) {
                                                $todate = $year . "-" . $month . "-" . str_pad($i, 2, "0", STR_PAD_LEFT);
                                                if ($todate == $date) {
                                          ?>
                                                      <div class="calendar-table__col calendar-table__today">
                                                            <div class="calendar-table__item">
                                                                  <span><?php echo $i ?></span>
                                                            </div>
                                                      </div>
                                                      <?php
                                                } else {
                                                      $haveEve = DB::search("SELECT * FROM `event` WHERE `e_date`='" . $todate . "'");
                                                      if ($haveEve->num_rows >= 1) {
                                                      ?>
                                                            <div class="calendar-table__col calendar-table__event" onclick="eventLoder('<?php echo $todate ?>');">
                                                                  <div class="calendar-table__item">
                                                                        <span><?php echo $i ?></span>
                                                                  </div>
                                                            </div>
                                                      <?php
                                                      } else {
                                                      ?>
                                                            <div class="calendar-table__col">
                                                                  <div class="calendar-table__item">
                                                                        <span><?php echo $i ?></span>
                                                                  </div>
                                                            </div>
                                          <?php

                                                      }
                                                }
                                          }
                                          ?>
                                          <!-- <div class="calendar-table__col calendar-table__event calendar-table__event--long calendar-table__event--start">
                                                <div class="calendar-table__item">
                                                      <span>27</span>
                                                </div>
                                          </div> -->
                                    </div>
                                    <div class="calendar-table__row justify-content-start ps-2">
                                          <!-- <div class="calendar-table__col calendar-table__event calendar-table__event--long calendar-table__event--end">
                                                <div class="calendar-table__item">
                                                      <span>28</span>
                                                </div>
                                          </div> -->
                                          <?php
                                          for ($i = $fiwfd; $i <= $fiwld; $i++) {
                                                $todate = $year . "-" . $month . "-" . str_pad($i, 2, "0", STR_PAD_LEFT);
                                                if ($todate == $date) {
                                          ?>
                                                      <div class="calendar-table__col calendar-table__today">
                                                            <div class="calendar-table__item">
                                                                  <span><?php echo $i ?></span>
                                                            </div>
                                                      </div>
                                                      <?php
                                                } else {
                                                      $haveEve = DB::search("SELECT * FROM `event` WHERE `e_date`='" . $todate . "'");
                                                      if ($haveEve->num_rows >= 1) {
                                                      ?>
                                                            <div class="calendar-table__col calendar-table__event" onclick="eventLoder('<?php echo $todate ?>');">
                                                                  <div class="calendar-table__item">
                                                                        <span><?php echo $i ?></span>
                                                                  </div>
                                                            </div>
                                                      <?php
                                                      } else {
                                                      ?>
                                                            <div class="calendar-table__col">
                                                                  <div class="calendar-table__item">
                                                                        <span><?php echo $i ?></span>
                                                                  </div>
                                                            </div>
                                          <?php
                                                      }
                                                }
                                          }
                                          ?>

                                          <!-- <div class="calendar-table__col calendar-table__event calendar-table__inactive">
                                                <div class="calendar-table__item">
                                                      <span>1</span>
                                                </div>
                                          </div> -->
                                          <!-- <div class="calendar-table__col calendar-table__inactive">
                                                <div class="calendar-table__item">
                                                      <span>2</span>
                                                </div>
                                          </div>
                                          <div class="calendar-table__col calendar-table__inactive">
                                                <div class="calendar-table__item">
                                                      <span>3</span>
                                                </div>
                                          </div> -->
                                    </div>
                              </div>
                        </div>
                  </div>
            </div>
            <div class="events-container d-none overflow-auto scrollbar" style="max-height: 375px;" id="event-view">
                 
            </div>
      </main>
</div>