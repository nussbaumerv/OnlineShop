<?php
include("connect.php");
session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$id = $_SESSION['id'];

$id_url = $id * 69;

$Validator = $_GET['key'] / $id / $id / 34;

$sql = "SELECT * FROM kunden_demo WHERE id = '$id'";
$result = mysqli_query($connect, $sql);

$row = mysqli_fetch_assoc($result);

if ($Validator == $row['Validator']) {
    $sql_place = "SELECT * FROM plätze_demo WHERE usr_id = '$id'";
    $result_place = mysqli_query($connect, $sql_place);
    
    while ($row2 = mysqli_fetch_assoc($result_place)) {
        $sql_q = "UPDATE plätze_demo SET ordeble = '0' WHERE usr_id = '$id'";
        $pupdate = mysqli_query($connect, $sql_q);
    }
    
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

    $mail->isHTML(true);
    $mail->Subject = 'Bestellbestätigung';
    $mail->Body    = '
                    Sehr geehrte Damen und Herren <br>
                    Vielen Dank für Ihre Bestellung. <br>
                    Sie haben erfolgreich Ihre Plätze für ' . $row['Price'] . ' Reserviert und Bezahlt.
                    Sie können Ihre Tickets <a href="https://sommernachtstraum.me/ticket.php?uid=' . $user_id_url . '">hier</a> einsehen oder <a href="https://sommernachtstraum.me/pdf.php?uid=' . $user_id_url . '">hier</a> als PDF downloaden. <br>
                    Herzliche Grüsse, <br>
                    die 3. Sek Uetikon<br><br>
                    3.Sek Uetikon | sommernachtstraum.me | contact@sommernachtstraum.me<br><br>
                    &copy;Valentin Nussbaumer 2022
                    ';
    $mail->send();

    $sql_update = "UPDATE kunden_demo SET Paid = 'Ja' WHERE id = '$id'";
    $result_update = mysqli_query($connect, $sql_update);
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://avatars.githubusercontent.com/u/83828188?v=4" type="img/vnd.microsoft.icon" />
    <title>Danke</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">

    <style>
        body {
            margin: 0px;
            text-align: center;
        }

        titel {
            font-family: 'Playfair Display', serif;
            font-size: 50px;
        }

        #container {
            min-height: 100vh;
            display: flex;

        }

        #text {
            margin: auto;
        }

        a {
            text-decoration: none;
            color: grey;
            font-size: 20px;
        }

        a:hover {
            color: black;
        }
    </style>
</head>

<body>
    <div id="container">
        <div id="text">
            <titel>Vielen Dank für Ihre Bestellung</titel><br>
            <a href="ticket.php?uid=<?php echo $id_url; ?>">Zu Ihren Tickets</a>
        </div>
    </div>

</body>

</html>