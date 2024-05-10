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
      if ($ishave->num_rows >= 1) {
            $data = $ishave->fetch_assoc();
            $uname = $data["username"];
            $fname = $data["fname"];
            $lname = $data["lname"];
            $vc = $data["v_code"];
            $email = $data["email"];
            $pw = $data["password"];

            // send email with username ,password and one-time verifcation code after done registration 

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
                  $mail->Subject = 'E-School Login info';
                  $bodyContent = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" style="width:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0"><head> <meta charset="UTF-8"> <meta content="width=device-width, initial-scale=1" name="viewport"> <meta name="x-apple-disable-message-reformatting"> <meta http-equiv="X-UA-Compatible" content="IE=edge"> <meta content="telephone=no" name="format-detection"> <style type="text/css"> .rollover div { font-size: 0; } .rollover:hover .rollover-first { max-height: 0px !important; display: none !important; } .rollover:hover .rollover-second { max-height: none !important; display: block !important; } #outlook a { padding: 0; } .ExternalClass { width: 100%; } .ExternalClass, .ExternalClass p, .ExternalClass span, .ExternalClass font, .ExternalClass td, .ExternalClass div { line-height: 100%; } .es-button { mso-style-priority: 100 !important; text-decoration: none !important; } a[x-apple-data-detectors] { color: inherit !important; text-decoration: none !important; font-size: inherit !important; font-family: inherit !important; font-weight: inherit !important; line-height: inherit !important; } .es-desk-hidden { display: none; float: left; overflow: hidden; width: 0; max-height: 0; line-height: 0; mso-hide: all; } [data-ogsb] .es-button { border-width: 0 !important; padding: 6px 25px 6px 25px !important; } @media only screen and (max-width:600px) { p, ul li, ol li, a { line-height: 150% !important } h1, h2, h3, h1 a, h2 a, h3 a { line-height: 120% !important } h1 { font-size: 30px !important; text-align: center } h2 { font-size: 26px !important; text-align: center } h3 { font-size: 20px !important; text-align: center } .es-header-body h1 a, .es-content-body h1 a, .es-footer-body h1 a { font-size: 30px !important } .es-header-body h2 a, .es-content-body h2 a, .es-footer-body h2 a { font-size: 26px !important } .es-header-body h3 a, .es-content-body h3 a, .es-footer-body h3 a { font-size: 20px !important } .es-menu td a { font-size: 16px !important } .es-header-body p, .es-header-body ul li, .es-header-body ol li, .es-header-body a { font-size: 16px !important } .es-content-body p, .es-content-body ul li, .es-content-body ol li, .es-content-body a { font-size: 16px !important } .es-footer-body p, .es-footer-body ul li, .es-footer-body ol li, .es-footer-body a { font-size: 16px !important } .es-infoblock p, .es-infoblock ul li, .es-infoblock ol li, .es-infoblock a { font-size: 12px !important } *[class="gmail-fix"] { display: none !important } .es-m-txt-c, .es-m-txt-c h1, .es-m-txt-c h2, .es-m-txt-c h3 { text-align: center !important } .es-m-txt-r, .es-m-txt-r h1, .es-m-txt-r h2, .es-m-txt-r h3 { text-align: right !important } .es-m-txt-l, .es-m-txt-l h1, .es-m-txt-l h2, .es-m-txt-l h3 { text-align: left !important } .es-m-txt-r img, .es-m-txt-c img, .es-m-txt-l img { display: inline !important } .es-button-border { display: inline-block !important } a.es-button, button.es-button { font-size: 20px !important; display: inline-block !important; border-width: 6px 25px 6px 25px !important } .es-btn-fw { border-width: 10px 0px !important; text-align: center !important } .es-adaptive table, .es-btn-fw, .es-btn-fw-brdr, .es-left, .es-right { width: 100% !important } .es-content table, .es-header table, .es-footer table, .es-content, .es-footer, .es-header { width: 100% !important; max-width: 600px !important } .es-adapt-td { display: block !important; width: 100% !important } .adapt-img { width: 100% !important; height: auto !important } .es-m-p0 { padding: 0px !important } .es-m-p0r { padding-right: 0px !important } .es-m-p0l { padding-left: 0px !important } .es-m-p0t { padding-top: 0px !important } .es-m-p0b { padding-bottom: 0 !important } .es-m-p20b { padding-bottom: 20px !important } .es-mobile-hidden, .es-hidden { display: none !important } tr.es-desk-hidden, td.es-desk-hidden, table.es-desk-hidden { width: auto !important; overflow: visible !important; float: none !important; max-height: inherit !important; line-height: inherit !important } tr.es-desk-hidden { display: table-row !important } table.es-desk-hidden { display: table !important } td.es-desk-menu-hidden { display: table-cell !important } .es-menu td { width: 1% !important } table.es-table-not-adapt, .esd-block-html table { width: auto !important } table.es-social { display: inline-block !important } table.es-social td { display: inline-block !important } } </style></head><body data-new-gr-c-s-loaded="14.1063.0" style="width:100%;-webkit-text-size-adjust:100%;-ms-text-size-adjust:100%;padding:0;Margin:0"> <div class="es-wrapper-color" style="background-color:#FFFFFF"> <table class="es-wrapper" width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;padding:0;Margin:0;width:100%;height:100%;background-repeat:repeat;background-position:center top"> <tr style="border-collapse:collapse"> <td valign="top" style="padding:0;Margin:0"> <table class="es-content" align="center" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;table-layout:fixed !important;width:100%"> <tr style="border-collapse:collapse"> <td align="center" style="padding:0;Margin:0"> <table class="es-content-body" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px;background-color:#FFFFFF;border-top:1px solid transparent;border-right:1px solid transparent;border-left:1px solid transparent;width:600px;border-bottom:1px solid transparent" align="center" cellspacing="0" cellpadding="0" bgcolor="#ffffff"> <tr style="border-collapse:collapse"> <td align="left" style="Margin:0;padding-top:20px;padding-bottom:40px;padding-left:40px;padding-right:40px"> <table width="100%" cellspacing="0" cellpadding="0" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> <tr style="border-collapse:collapse"> <td align="left" style="padding:0;Margin:0;width:518px"> <table width="100%" cellspacing="0" cellpadding="0" role="presentation" style="mso-table-lspace:0pt;mso-table-rspace:0pt;border-collapse:collapse;border-spacing:0px"> <tr style="border-collapse:collapse"> <td class="es-m-txt-c" align="center" style="padding:0;Margin:0;font-size:0px"> <a target="_blank" href="" class="rollover" style="-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;text-decoration:underline;color:#EE6C6D;font-size:14px"><img src="https://vnolbh.stripocdn.email/content/guids/CABINET_f9cdb674352a68a40f04e8e66d824136/images/logo.png" alt="icon" style="display:block;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;font-size:12px" title="icon" width="30" class="rollover-first" height="30"> <div style="font-size:0;mso-hide:all"> <img alt="icon" title="icon" width="30" class="rollover-second" style="display:none;border:0;outline:none;text-decoration:none;-ms-interpolation-mode:bicubic;max-height:0px" src="https://vnolbh.stripocdn.email/content/guids/CABINET_f9cdb674352a68a40f04e8e66d824136/images/logo.png" height="30"> </div> </a></td> </tr> <tr style="border-collapse:collapse"> <td class="es-m-txt-c" align="center" style="padding:0;Margin:0"> <h2 style="Margin:0;line-height:29px;mso-line-height-rule:exactly;font-size:24px;font-style:normal;font-weight:normal;color:#333333"> Activate Account</h2> </td> </tr> <tr style="border-collapse:collapse"> <td class="es-m-txt-c" align="center" style="padding:0;Margin:0;padding-top:15px"> <p style="Margin:0;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;line-height:21px;color:#333333;font-size:14px"> Hi ' . ucfirst($fname) . ' ' . ucfirst($lname) . '! Your username, password and verification code given below. Use this one-time verification code when to login first time eschool LMS&nbsp;to activate your protal. Thank you!<br>Username - ' . $uname . '<br>Password -&nbsp;' . $pw . '<br>One-time Verification Code -&nbsp;' . $vc . '<br><br> </p> </td> </tr> <tr style="border-collapse:collapse"> <td align="center" style="Margin:0;padding-left:10px;padding-right:10px;padding-bottom:15px;padding-top:20px"> <span class="es-button-border" style="border-style:solid;border-color:#474745;background:#474745;border-width:0px;display:inline-block;border-radius:20px;width:auto"><a href="#" class="es-button" style="mso-style-priority:100 !important;text-decoration:none;-webkit-text-size-adjust:none;-ms-text-size-adjust:none;mso-line-height-rule:exactly;color:#EFEFEF;font-size:16px;border-style:solid;border-color:#474745;border-width:6px 25px 6px 25px;display:inline-block;background:#474745;border-radius:20px;font-weight:normal;font-style:normal;line-height:19px;width:auto;text-align:center">Click Here to login</a></span> </td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </td> </tr> </table> </div> <div style="position:absolute;left:-9999px;top:-9999px;margin:0px"></div></body></html>';
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
