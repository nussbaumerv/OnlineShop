<?php

session_start();

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

        if($_SESSION['pwd'] != "Winternachtstraum07"){
            header("Location: /login.php");
            exit;
        }
include("connect.php");
$id = $_GET['usr'];
if($_POST['jes']){
    $sql = "UPDATE kunden_demo SET Paid = 'Ja' WHERE id = '$id'";
    $result = mysqli_query($connect, $sql);
    if($result){
        header("Location: /demo/admin.php");
    }
}
if($_POST['no']){
    $sql_select = "SELECT Email FROM kunden_demo WHERE id = '$id'";
    $result_select = mysqli_query($connect, $sql_select);
    $row = mysqli_fetch_assoc($result_select);
    
    $sql = "UPDATE kunden_demo SET Paid = 'Nein' WHERE id = '$id'";
    $result = mysqli_query($connect, $sql);
    rename("uploads/user".$id.".pdf", "uploads/".rand(1,99)."_false".$id.".pdf");
    if($result){
        
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

    $mail->isHTML(true);
    $mail->Subject = 'Rechnungs Bestätigung abgelehnt';
    $mail->Body = '
                    Sehr geehrte Damen und Herren <br>
                    Ihre Rechnungs Bestätigung wurde abgelehnt.
                    Laden Sie bitte <a href="https://sommernachtstraum.me/upload/?usr='.$id.'">hier</a> eine gültige Rechnungsbestätigung hoch.<br>
                    Bei Fragen schreiben Sie bitte eine Mail an contact@sommernachtstraum.me.
                    <br>
                    Herzliche Grüsse, <br>
                    die 3. Sek Uetikon<br><br>
                    3.Sek Uetikon | sommernachtstraum.me | contact@sommernachtstraum.me<br><br>
                    &copy;Valentin Nussbaumer 2022
                    ';
    $mail->send();
        header("Location: /demo/admin.php");
    }
}
if(!$id){
    header("Location: /demo/admin.php");
}
else{
    
}
?>
<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rechnung Überprüfen</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://avatars.githubusercontent.com/u/83828188?v=4" type="img/vnd.microsoft.icon" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
<script src="https://www.google.com/recaptcha/enterprise.js?render=6LeulSQfAAAAALR-WNApmKm51zXJDwuiq4BYy-sF"></script>
<script>
grecaptcha.enterprise.ready(function() {
    grecaptcha.enterprise.execute('6LeulSQfAAAAALR-WNApmKm51zXJDwuiq4BYy-sF', {action: 'login'}).then(function(token) {
       ...
    });
});
</script>
        <style>
            body{
                text-align:center;
                font-family:arial;
                margin:0px;
    
            }
            input[type="submit"]{
                padding: 5px 20px;
                border:solid;
                border-color:black;
                border-radius:0px;
                cursor:pointer;
                color:white;
                margin:20px;
            }
            input[name="jes"]{
                background-color:green;
            }
            input[name="no"]{
                background-color:red;
            }
        </style>
    </head>
    <br>
    <h1>Rechnung überprüfen</h1>
    <iframe src="uploads/user<?php echo $id; ?>.pdf#toolbar=0" height="550" width="425" >
    </iframe>
    <form method="post">
        <input type="submit" name="jes" value="Ja">
        <input type="submit" name="no" value="Nein">
    </form>
</html>