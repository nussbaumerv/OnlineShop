<?php
include("connect.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

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
                $mail->addAddress('vali7799@icloud.com');

                $mail->isHTML(true);
                $mail->Subject = 'Bestellbestätigung';
                $mail->Body = '
                    Sehr geehrte Damen und Herren <br>
                    Vielen Dank für Ihre Bestellung. <br>
                    Sie haben erfolgreich Ihre Plätze für  reserviert.
                    Sie können Ihre Tickets <a href="https://sommernachtstraum.me/ticket.php?ui">hier</a> einsehen oder <a href="https://sommernachtstraum.me/pdf.php?ui>hier</a> als PDF downloaden. <br>
                    Wir bitten Sievor dem 6. Mai 2022 an das unten aufgelistete Konto zu überweisen <br>
                    Bitte laden Sie die Überweisungsbestätigung ebenfals vor dem 6 Mai 2022 als PDF <a href="https://sommernachtstraum.me/upload/?u>hier</a> hoch.<br>
                    Herzliche Grüsse, <br>
                    die 3. Sek Uetikon<br><br>

                    Betrag <br>
                    IBAN-Nr: CH73 0900 0000 8000 6938 2<br>
                    Konto-Nr: 80-6938-2<br>
                    Zahlungsmitteilung: Schultheater Sek 2130.4260.20.01<br>
                    Konto lautet auf: Gemeinde Uetikon am See, Gemeindekasse, Bergstrasse 90, 8707 Uetikon am See<br><br>
                    3.Sek Uetikon | sommernachtstraum.me | contact@sommernachtstraum.me<br><br>
                    &copy;Valentin Nussbaumer 2022';
                $mail->send();