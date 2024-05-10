<?php
session_start();
require "../../connection/connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../vendor/autoload.php';

if (isset($_POST["un"])) {

      $un = $_POST["un"];
      $pw = $_POST["pw"];
      $rem = $_POST["rem"];
      if (empty($un)) {
            echo "emptyUsername";
      } else if (empty($pw)) {
            echo "emptyPassword";
      } else {
            $result = DB::search("SELECT * FROM `user` WHERE (`username`='" . $un . "' OR `email`='".$un."')  AND `password`='" . $pw . "' AND `user_type` IN (5,1)");
            if ($result->num_rows == 1) {
                  $d = $result->fetch_assoc();
                  if ($d["status_sid"] == 1) {
                        if (isset($_POST["vc"])) {
                              $vc = $_POST["vc"];
                              $result2 = DB::search("SELECT * FROM `user` WHERE (`username`='" . $un . "' OR `email`='".$un."') AND `password`='" . $pw . "' AND `user_type`IN (5,1) AND `v_code`='" . $vc . "'");
                              if ($result2->num_rows == 1) {
                                    if ($rem == "true") {

                                          $t = time() + (60 * 60 * 24 * 7);
                                          setcookie("una", $un, $t);
                                          setcookie("pwa", $pw, $t);
                                    } else {
                                          setcookie("una", "", -1);
                                          setcookie("pwa", "", -1);
                                    }
                                    DB::iud("UPDATE `user` SET `status_sid`='2',`v_code`='' WHERE `username`='" . $un . "' AND `user_type` IN (5,1)");

                                    $_SESSION["admin"] = $d;
                                    echo "loginSucces";
                              } else {
                                    echo "wrongVc";
                              }
                        } else {

                              echo "needVcode";
                        }
                  } else if ($d["status_sid"] == 3) {
                        echo "banded";
                  } else {
                        if ($d["tsv_status"] == 1) {
                              if (isset($_POST["vc"])) {
                                    $vc = $_POST["vc"];
                                    $result2 = DB::search("SELECT * FROM `user` WHERE (`username`='" . $un . "' OR `email`='".$un."') AND `password`='" . $pw . "' AND `user_type`IN (5,1) AND `v_code`='" . $vc . "'");
                                    if ($result2->num_rows == 1) {
                                          if ($rem == "true") {
                                                $t = time() + (60 * 60 * 24 * 7);
                                                setcookie("una", $un, $t);
                                                setcookie("pwa", $pw, $t);
                                          } else {
                                                setcookie("una", "", -1);
                                                setcookie("pwa", "", -1);
                                          }
                                          DB::iud("UPDATE `user` SET `v_code`='' WHERE (`username`='" . $un . "' OR `email`='".$un."') AND `user_type` IN (5,1)");

                                          $_SESSION["admin"] = $d;
                                          echo "loginSucces";
                                    } else {
                                          echo "wrongVc";
                                    }
                              } else {
                                    $vc = rand(100000, 1000000);
                                    DB::iud("UPDATE `user` SET `v_code`='" . $vc . "' WHERE (`username`='" . $un . "' OR `email`='".$un."') AND `user_type` IN (5,1)");

                                    // start email sender 
                                    $mail = new PHPMailer(true);
                                    try {
                                          $mail->SMTPDebug = SMTP::DEBUG_OFF;                      //Enable verbose debug output
                                          $mail->isSMTP();                                            //Send using SMTP
                                          $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                                          $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                                          $mail->Username   = 'janprabashwara@gmail.com';                     //SMTP username
                                          $mail->Password   = 'shog gpiw iced cxrv';                               //SMTP password
                                          $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                                          $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                                          $mail->setFrom('janprabashwara@gmail.com', 'E-School');
                                          $mail->addReplyTo('janprabashwara@gmail.com', 'E-School');
                                          $mail->addAddress($d["email"]);
                                          $mail->isHTML(true);
                                          $mail->Subject = 'E-School Two-step Verification';

                                          $bodyContent = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office"><head> <meta charset="UTF-8"> <meta content="width=device-width, initial-scale=1" name="viewport"> <meta name="x-apple-disable-message-reformatting"> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta content="telephone=no" name="format-detection"> <title></title> <!--[if (mso 16)]> <style type="text/css"> a {text-decoration: none;} </style> <![endif]--> <!--[if gte mso 9]><style>sup { font-size: 100% !important; }</style><![endif]--> <!--[if gte mso 9]><xml> <o:OfficeDocumentSettings> <o:AllowPNG></o:AllowPNG> <o:PixelsPerInch>96</o:PixelsPerInch> </o:OfficeDocumentSettings></xml><![endif]--></head><body data-new-gr-c-s-loaded="14.1063.0"> <div class="es-wrapper-color"> <!--[if gte mso 9]><v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t"><v:fill type="tile" color="#ffffff"></v:fill></v:background><![endif]--> <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0"> <tbody> <tr> <td class="esd-email-paddings" valign="top"> <table class="es-content esd-footer-popover" align="center" cellspacing="0" cellpadding="0"> <tbody> <tr> <td class="esd-stripe" align="center"> <table class="es-content-body" style="border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;" align="center" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff"> <tbody> <tr> <td class="esd-structure es-p20t es-p40b es-p40r es-p40l" esd-custom-block-id="8537" align="left"> <table width="100%" cellspacing="0" cellpadding="0"> <tbody> <tr> <td class="esd-container-frame" align="left" width="518"> <table width="100%" cellspacing="0" cellpadding="0"> <tbody> <tr> <td class="esd-block-image es-m-txt-c" align="center" style="font-size: 0px;"> <a target="_blank" href class="rollover"><img src="https://vnolbh.stripocdn.email/content/guids/CABINET_f9cdb674352a68a40f04e8e66d824136/images/logo.png" alt="E-School" style="display: block; font-size: 12px;" title="E-School" width="30" class="rollover-first"> <div style="mso-hide:all;"><img alt="E-School" title="E-School" width="30" class="rollover-second" style="max-height: 0px; display: none; font-size: 12px;" src="https://vnolbh.stripocdn.email/content/guids/CABINET_f9cdb674352a68a40f04e8e66d824136/images/logo.png"></div> </a> </td> </tr> <tr> <td class="esd-block-text es-m-txt-c" align="center"> <h2>Two-step verification</h2> </td> </tr> <tr> <td class="esd-block-text es-m-txt-c es-p15t" align="center"> <p>Your E-School two-step verification code&nbsp;<br><br><span style="font-size:20px;"><strong>' . $vc . '</strong></span><br><br></p> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </div> <div style="position: absolute; left: -9999px; top: -9999px; margin: 0px;"></div></body></html>';
                                          $mail->Body    = $bodyContent;
                                          // end email sender 
                                          if (!$mail->send()) {
                                                echo 'Verification could not be sent';
                                          } else {
                                                echo "needVcode";
                                          }
                                    } catch (Exception $e) {
                                          echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                                    }
                              }
                        } else {
                              if ($rem == "true") {
                                    $t = time() + (60 * 60 * 24 * 7);
                                    setcookie("una", $un, $t);
                                    setcookie("pwa", $pw, $t);
                              } else {
                                    setcookie("una", "", -1);
                                    setcookie("pwa", "", -1);
                              }
                              $_SESSION["admin"] = $d;
                              echo "loginSucces";
                        }
                  }
            } else {
                  echo "WrongUnPw";
            }
      }
} else {
?>
      <script>
            // window.location = "../../misc/pages-404.php";
      </script>
<?php
}
?>