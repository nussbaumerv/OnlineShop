<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

function send_mail($to, $subject, $message)
{
  $mail = new PHPMailer(true);

  $mail->IsSMTP();
  $mail->Host       = "smtp.hostinger.com"; 
  $mail->SMTPAuth   = true;        
  $mail->SMTPSecure = "tls";             
  $mail->Username   = 'mail@shop.valentin-nussbaumer.com';
  $mail->Password   = 'SirO7799!';
  $mail->Port       = 465;
  $mail->setFrom('mail@shop.valentin-nussbaumer.com', 'VHD Shop');
  $mail->addAddress($to);

  $mail->isHTML(true);
  $mail->Subject = $subject;
  $mail->Body = '
<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <meta name="x-apple-disable-message-reformatting">
  <title></title>
  <!--[if mso]>
  <noscript>
    <xml>
      <o:OfficeDocumentSettings>
        <o:PixelsPerInch>96</o:PixelsPerInch>
      </o:OfficeDocumentSettings>
    </xml>
  </noscript>
  <![endif]-->
  <style>
    table, td, div, h1, p {font-family: Arial, sans-serif;}
  </style>
</head>
<body style="margin:0;padding:0;">
    <table role="presentation" style="width:100%;border-collapse:collapse;border:solid;border-spacing:0;background:rgb(72, 212, 255); border-color:rgb(240, 58, 115);">
        <tr>
            <td align="left" style="padding:20px; font-size:30px;; font-weight:bold">
                ' . $subject . '
            </td>
        </tr>
        <tr>
            <td style="padding:0px 30px; font-size:16px;">
              ' . $message . '
              <br><br>
              Regards, <br>
              VHD Shop
              <br><br><br><br>
            </td>
            
        </tr>
        <tr>
    <td align="center" style="background-color:rgb(240, 58, 115); padding:30px;">
    <a href="https://valentin-nussbaumer.com"><img src="https://valentin-bewerbung.com/media/Bildschirmfoto%202021-08-04%20um%2019.59.26.png" alt="" width="90" style="height:auto;display:block;" /></a>
   <br> VHD Shop | <a style="color:black" href="https://edu-chat.me">VHD.shop</a> | <a style="color:black" href="mailto: mail@valentin-nussbaumer.com">mail@valentin-nussbaumer.com</a>
  </td>
        </tr>
    </table>
</body>
</html>';
  $mail->send();
}
