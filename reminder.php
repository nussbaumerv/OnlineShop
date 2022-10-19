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


$sql = "SELECT * FROM kunden WHERE Paid = 'Nein' AND Payment_method = 'Rechnung per Email'";
$result = mysqli_query($connect, $sql);

while($row = mysqli_fetch_assoc($result)){
    $user_id_url = $row['id'] * 69;

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
                $mail->addCC('mail@valentin-nussbaumer.com');

                $mail->isHTML(true);
                $mail->Subject = 'Zahlungserinnerung';
                $mail->Body = '
                    Sehr geehrte Damen und Herren <br><br>
                    Bitte überweisen Sie ' . $row['Price'] . ' spätedens bis am Mittwoch dem 11. Mai 2022 auf das unten aufgelistete Konto.<br>
                    Bitte laden Sie danach die Überweisungsbestätigung ebenfals spädesten bis am Mittwoch dem 11. Mai 2022 als PDF <a href="https://sommernachtstraum.me/upload/?usr='.$row['id'].'">hier</a> hoch.<br><br>
                    Herzliche Grüsse, <br>
                    die 3. Sek Uetikon<br><br>

                    Betrag: ' . $row['Price'] . ' <br>
                    IBAN-Nr: CH73 0900 0000 8000 6938 2<br>
                    Konto-Nr: 80-6938-2<br>
                    Zahlungsmitteilung: Schultheater Sek 2130.4260.20.01<br>
                    Konto lautet auf: Gemeinde Uetikon am See, Gemeindekasse, Bergstrasse 90, 8707 Uetikon am See<br><br>
                    Bei Fragen schreiben Sie bitte eine Mail an: contact@sommernachtstraum.me.
                    <br><br>
                    3.Sek Uetikon | sommernachtstraum.me | contact@sommernachtstraum.me<br><br>
                    &copy;Valentin Nussbaumer 2022';
                $mail->send();
    
}
