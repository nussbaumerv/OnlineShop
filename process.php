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

$count = 0;
$sitze = "";
$place = $_POST['sitze'];

if (!isset($place)) {
    echo '<script> alert("Sie müssen einen Sitzplatz auswählen"); </script>';
    header("Location: reservieren.php");
} else {
    $Vorname = $_POST['vorname'];
    $Nachname = $_POST['name'];
    $Adresse = $_POST['adresse'];
    $Postleitzahl = $_POST['postleitzahl'];
    $Ort = $_POST['ort'];
    $Email = $_POST['email'];
    $Telefon = $_POST['telefon'];
    $price = $count * 25;
    $price = $price . " CHF";
    $paid = "Nein";
    $date = date("Y/m/d");
    $Auffuerung = 0;
    $Payment_method = "";
    $Validator = rand();
    $kids = $_POST['kids'];

    $sql_kunden = "INSERT INTO kunden_demo (Vorname, Nachname, Adresse, Postleitzahl, Ort, Email, Telefon, Datum, Plätze, Price, Paid, Payment_method, Auffuerung, Validator) VALUES ('$Vorname', '$Nachname', '$Adresse', '$Postleitzahl', '$Ort', '$Email', '$Telefon', '$date', '$sitze', '$price', '$paid', '$Payment_method', '$Auffuerung', '$Validator')";
    $result = mysqli_query($connect, $sql_kunden);


    if (!$result) {
        echo "<script> alert('Something went wrong'); </script>";
    } else {
        $sql_select = "SELECT * FROM kunden_demo WHERE Validator = '$Validator'";
        $result_select = mysqli_query($connect, $sql_select);
        $row = mysqli_fetch_assoc($result_select);
        $user_id = $row['id'];
        

        $kids_counter = $kids;
        if($kids_counter == ""){
            $kids_counter = 0;
        }
        $a1 = 0;
        $a2 = 0;

        if ($_POST['payment_method'] == "card") {
            foreach ($place as $check) {
            $sitze = $sitze . $check . " ";
            echo $sitze;
            $var = explode(",", $check);
            $aufführung = $var['0'];
            
            if($aufführung == 1){
                $a1 += 1;
            }
            else{
                $a2 += 1;
            }
            
            $check = $var['1'];
            $eat = $_POST['eat,' . $check];
            $alergene = $_POST['alergene,' . $check];
            
            if($kids_counter == 0){
                $kids_update = 0;
            }
            else{
                $kids_update = 1;
                $kids_counter -= 1;
            }
            $sql = "UPDATE plätze_demo SET ordeble = '1', usr_id = $user_id, kinder = '$kids_update', food = '$eat', alergene = '$alergene' WHERE Location = '$check' AND aufführung = '$aufführung'";
            $pupdate = mysqli_query($connect, $sql);
            $count += 1;
        }
        $price = $count * 25;
        if($kids != ""){
            $kids_price = $kids * 5;
            $price = $price - $kids_price;
            
        }
        $price = $price . " CHF";
        
        if($a1 == 0){
            $aufführung = 2;
        }
        else{
            if($a2 == 0){
                $aufführung = 1;
            }
            else{
                $aufführung = "1, 2";
            }
        }


            $sql_update = "UPDATE kunden_demo SET Payment_method = 'Karte', Plätze = '$sitze', Price = '$price', Auffuerung = '$aufführung' WHERE id = '$user_id'";
            $result = mysqli_query($connect, $sql_update);
            echo '<form id="form" method="post" action="stripe.php">
                <input type="hidden" name="amount" value="' . $count . '">
                <input type="hidden" name="kids" value="' . $kids . '">
                <input type="hidden" name="id" value="' . $user_id . '">
                <input type="hidden" name="email" value="' . $Email . '">
                </form>
                <script> document.getElementById("form").submit(); </script>';
        } else {
            if ($_POST['payment_method'] == "bill_email") {
                
            $a1 = 0;
            $a2 = 0;
                
            foreach ($place as $check) {
            $sitze = $sitze . $check . " ";
            echo $sitze;
            $var = explode(",", $check);
            $aufführung = $var['0'];
            $check = $var['1'];
            $eat = $_POST['eat,' . $check];
            $alergene = $_POST['alergene,' . $check];
            
            if($kids_counter == 0){
                $kids_update = 0;
            }
            else{
                $kids_update = 1;
                $kids_counter -= 1;
            }
            
            if($aufführung == 1){
                $a1 += 1;
            }
            else{
                $a2 += 1;
            }
            
            $sql = "UPDATE plätze_demo SET ordeble = '0', usr_id = $user_id, kinder = '$kids_update', food = '$eat', alergene = '$alergene' WHERE Location = '$check' AND aufführung = '$aufführung'";
            $pupdate = mysqli_query($connect, $sql);
            $count += 1;
        }
        $price = $count * 25;
        if($kids != ""){
            $kids_price = $kids * 5;
            $price = $price - $kids_price;
            
        }
        $price = $price . " CHF";
        
        if($a1 == 0){
            $aufführung = 2;
        }
        else{
            if($a2 == 0){
                $aufführung = 1;
            }
            else{
                $aufführung = "1, 2";
            }
        }

                $user_id_url = $user_id * 69;

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
                $mail->addAddress($Email);

                $mail->isHTML(true);
                $mail->Subject = 'Bestellbestätigung';
                $mail->Body = '
                    Sehr geehrte Damen und Herren <br>
                    Vielen Dank für Ihre Bestellung. <br>
                    Sie haben erfolgreich Ihre Plätze für ' . $price . ' reserviert.
                    Sie können Ihre Tickets <a href="https://sommernachtstraum.me/ticket.php?uid=' . $user_id_url . '">hier</a> einsehen oder <a href="https://sommernachtstraum.me/pdf.php?uid=' . $user_id_url . '">hier</a> als PDF downloaden. <br>
                    Wir bitten Sie ' . $price . ' vor dem 6. Mai 2022 an das unten aufgelistete Konto zu überweisen <br>
                    Bitte laden Sie die Überweisungsbestätigung ebenfals vor dem 6 Mai 2022 als PDF <a href="https://sommernachtstraum.me/upload/?usr='.$user_id.'">hier</a> hoch.<br>
                    Herzliche Grüsse, <br>
                    die 3. Sek Uetikon<br><br>

                    Betrag: ' . $price . ' <br>
                    IBAN-Nr: CH73 0900 0000 8000 6938 2<br>
                    Konto-Nr: 80-6938-2<br>
                    Zahlungsmitteilung: Schultheater Sek 2130.4260.20.01<br>
                    Konto lautet auf: Gemeinde Uetikon am See, Gemeindekasse, Bergstrasse 90, 8707 Uetikon am See<br><br>
                    3.Sek Uetikon | sommernachtstraum.me | contact@sommernachtstraum.me<br><br>
                    &copy;Valentin Nussbaumer 2022';
                $mail->send();

                $sql_update = "UPDATE kunden_demo SET Payment_method = 'Rechnung per Email', Plätze = '$sitze', Price = '$price', Auffuerung = '$aufführung' WHERE id = '$user_id'";
                $result_update = mysqli_query($connect, $sql_update);

                if ($result_update) {
                    $_SESSION['id'] = $user_id;
                    header("Location: thanks.php?uid=".$user_id."");
                }
            }
        }
    }
}
