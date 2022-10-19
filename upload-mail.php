<?php
session_start();
include("connect.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if($_POST['submit']){
    
$counter = 0;

$sql = "SELECT * FROM kunden";
$result = mysqli_query($connect, $sql);

$sql_spezial = "SELECT * FROM kunden_special";
$result_spezial = mysqli_query($connect, $sql_spezial);


while($row = mysqli_fetch_assoc($result)){
    
$counter += 1;

$betref = "Ein Sommernachtstraum Video";

$inhalt = "Sehr geehrte Damen und Herren<br><br>
Sie können das Video zum Theaterstück Ein Sommernachtstraum der 3.Sek Uetikon <a style='color:black;' href='https://sommernachtstraum.me/download/'>hier</a> als mp4 Datei herrunterladen. <br><br>
Freundliche Grüsse<br>
Die 3.Sek Uetikon";



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
$mail->addAddress($row['Email']);
$mail->addCC('testing@valentin-nussbaumer.com');

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
   <br> Ein Sommernachtstraum | <a style="color:black" href="https://sommernachtstraum.me">Sommernachtstraum.me</a> | <a style="color:black" href="mailto: contact@sommernachtstraum.me">contact@sommernachtstraum.me</a>
  </td>
        </tr>
    </table>
</body>
</html>';
$mail->send();
}
echo "<script> alert('Es wurden ".$counter." Emails erfolgreich versendet'); </script>";
}

if($_POST['submit_spezial']){
    
$counter = 0;

$sql = "SELECT * FROM kunden";
$result = mysqli_query($connect, $sql);

$sql_spezial = "SELECT * FROM kunden_special";
$result_spezial = mysqli_query($connect, $sql_spezial);


while($row = mysqli_fetch_assoc($result_spezial)){
    
$counter += 1;

$betref = "Ein Sommernachtstraum Video";

$inhalt = "Sehr geehrte Damen und Herren<br><br>
Sie können das Video zum Theaterstück Ein Sommernachtstraum der 3.Sek Uetikon <a style='color:black;' href='https://sommernachtstraum.me/download/'>hier</a> als mp4 Datei herrunterladen. <br><br>
Freundliche Grüsse<br>
Die 3.Sek Uetikon";



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
$mail->addAddress($row['Email']);
$mail->addCC('testing@valentin-nussbaumer.com');

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
   <br> Ein Sommernachtstraum | <a style="color:black" href="https://sommernachtstraum.me">Sommernachtstraum.me</a> | <a style="color:black" href="mailto: contact@sommernachtstraum.me">contact@sommernachtstraum.me</a>
  </td>
        </tr>
    </table>
</body>
</html>';
$mail->send();
}

echo "<script> alert('Es wurden ".$counter." Emails erfolgreich versendet'); </script>";
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>lädt...</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://avatars.githubusercontent.com/u/83828188?v=4" type="img/vnd.microsoft.icon" />
</head>

<body>
    <div id="container">
        <form id="form" method="post">
            <input type="submit" value="Email absenden" name="submit">
        </form>
        <form id="form" method="post">
            <input type="submit" value="Email absenden Sondervorstellung" name="submit_spezial">
        </form>
    </div>

</body>

</html>