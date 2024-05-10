<?php

require "../../connection/connection.php";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../../vendor/autoload.php';

if (isset($_POST["id"])) {


      $id = $_POST["id"];


      $ishave = DB::search("SELECT * FROM `user` WHERE `uid`='" . $id . "'");
      if ($ishave->num_rows == 1) {
            $d = $ishave->fetch_assoc();
            $email = $d["email"];
            $vc = rand(100000, 1000000);

            DB::iud("UPDATE `user` SET `status_sid`='1',`v_code`='" . $vc . "' WHERE `uid`='" . $id . "'");
            // send email with verification code after unblock user 
            //start email sender 
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
                  $mail->addAddress($email);
                  $mail->isHTML(true);
                  $mail->Subject = 'Portal Activated ';

                  $bodyContent = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office"><head> <meta charset="UTF-8"> <meta content="width=device-width, initial-scale=1" name="viewport"> <meta name="x-apple-disable-message-reformatting"> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta content="telephone=no" name="format-detection"> <title></title></head><body data-new-gr-c-s-loaded="14.1063.0"> <div class="es-wrapper-color"> <!--[if gte mso 9]><v:background xmlns:v="urn:schemas-microsoft-com:vml" fill="t"><v:fill type="tile" color="#ffffff"></v:fill></v:background><![endif]--> <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0"> <tbody> <tr> <td class="esd-email-paddings" valign="top"> <table class="es-content esd-footer-popover" align="center" cellspacing="0" cellpadding="0"> <tbody> <tr> <td class="esd-stripe" align="center"> <table class="es-content-body" style="border-left:1px solid transparent;border-right:1px solid transparent;border-top:1px solid transparent;border-bottom:1px solid transparent;" align="center" width="600" cellspacing="0" cellpadding="0" bgcolor="#ffffff"> <tbody> <tr> <td class="esd-structure es-p20t es-p40b es-p40r es-p40l" esd-custom-block-id="8537" align="left"> <table width="100%" cellspacing="0" cellpadding="0"> <tbody> <tr> <td class="esd-container-frame" align="left" width="518"> <table width="100%" cellspacing="0" cellpadding="0"> <tbody> <tr> <td class="esd-block-image es-m-txt-c" align="center" style="font-size: 0px;"> <a target="_blank" href class="rollover"><img src="https://vnolbh.stripocdn.email/content/guids/CABINET_f9cdb674352a68a40f04e8e66d824136/images/logo.png" alt="E-School" style="display: block; font-size: 12px;" title="E-School" width="30" class="rollover-first"> <div style="mso-hide:all;"><img alt="E-School" title="E-School" width="30" class="rollover-second" style="max-height: 0px; display: none; font-size: 12px;" src="https://vnolbh.stripocdn.email/content/guids/CABINET_f9cdb674352a68a40f04e8e66d824136/images/logo.png"></div> </a> </td> </tr> <tr> <td class="esd-block-text es-m-txt-c" align="center"> <h2>Your Account Is Activated<br></h2> </td> </tr> <tr> <td class="esd-block-text es-m-txt-c es-p15t" align="center"> <p>your E-School portal is activate back.If you need to log in your portal please use Verification code given below. Thank you!<br><br>verification code - <strong>' . $vc . '</strong></p> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </td> </tr> </tbody> </table> </div> <div style="position: absolute; left: -9999px; top: -9999px; margin: 0px;"></div></body></html>';
                  $mail->Body    = $bodyContent;

                  $mail->send();

                  // end email sender 
                  echo "success";
            } catch (Exception $e) {
                  echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
      }
} else {
?>
      <script>
            window.location = "../../misc/pages-404.php";
      </script>
<?php
}
