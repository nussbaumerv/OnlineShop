<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>lädt...</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://avatars.githubusercontent.com/u/83828188?v=4" type="img/vnd.microsoft.icon" />
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid grey;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 1s linear infinite;
            animation: spin 1s linear infinite;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                border-top: 16px solid lightgrey;
            }

            50% {
                border-top: 16px solid grey;
            }

            100% {
                -webkit-transform: rotate(360deg);
                border-top: 16px solid lightgrey;
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
                border-top: 16px solid lightgrey;
            }

            50% {
                border-top: 16px solid grey;
            }

            100% {
                transform: rotate(360deg);
                border-top: 16px solid lightgrey;
            }
        }

        #container {
            min-height: 100vh;
            display: flex;

        }

        .loader {
            margin: auto;
        }
    </style>
</head>

<body>
    <div id="container">
        <div class="loader"></div>
    </div>


</body>

</html>
<?php
session_start();
include("connect.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$betref = "Ihr Bestätigungscode";

$inhalt = "Sehr gehrte Damen und Herren <br><br>
Hier finden Sie ihr Bestätigungscode. <br><br>
Freundliche Grüsse
Valentin";



$mail = new PHPMailer(true);

$mail->isSMTP();
$mail->Host       = 'smtp.hostinger.com';
$mail->SMTPAuth   = true;
$mail->CharSet    = 'UTF-8';
$mail->Username   = 'contact@sommernachtstraum.me';
$mail->Password   = 'Winternachtstraum07!';
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
$mail->Port       = 465;

$mail->setFrom('contact@sommernachtstraum.me', 'sommernachtstraum.me');
$mail->addAddress('mail@valentin-nussbaumer.com');

$mail->isHTML(true);
$mail->Subject = $betref;
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
    <table role="presentation" style="width:100%;border-collapse:collapse;border:solid;border-spacing:0;background:#ffffff; border-color:red">
        <tr>
            <td align="left" style="padding:20px; font-size:30px;; font-weight:bold">
                '.$betref.'
            </td>
        </tr>
        <tr>
            <td style="padding:0px 30px; font-size:16px;">
              '.$inhalt.'
              <br><br><br><br><br><br>
            </td>
            
        </tr>
        <tr>
    <td align="center" style="background-color:rgb(189, 184, 184); padding:30px;">
    <a href="https://valentin-nussbaumer.com"><img src="https://valentin-bewerbung.com/media/Bildschirmfoto%202021-08-04%20um%2019.59.26.png" alt="" width="90" style="height:auto;display:block;" /></a>
   <br> Valentin Nussbaumer | <a style="color:black" href="https://valentin-nussbaumer.com">valentin-nussbaumer.com</a> | <a style="color:black" href="mailto: mail@valentin-nussbaumer.com">mail@valentin-nussbaumer.com</a>
  </td>
        </tr>
    </table>
</body>
</html>';
$mail->send();
