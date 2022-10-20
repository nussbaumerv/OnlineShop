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

$products_json = $_SESSION['basket'];
$products = json_decode($products_json, true);
$totalPrice = 0;

foreach ($products as $product) {
    $sql = "SELECT * FROM products WHERE id = '$product'";
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        echo "<script> alert('Daten konnten nicht geladen Werden.'); </script>";
    }

    $row = mysqli_fetch_assoc($result);
    $totalPrice += $row['price'];
}




$Vorname = $_POST['vorname'];
$Nachname = $_POST['name'];
$Adresse = $_POST['adresse'];
$Postleitzahl = $_POST['postleitzahl'];
$Ort = $_POST['ort'];
$Email = $_POST['email'];
$Telefon = $_POST['telefon'];
$paid = "No";
$date = date("Y/m/d");
$Payment_method = $_POST['payment_method'];
$Validator = rand();


$sql_kunden = "INSERT INTO customers (prename, name, adress, post_code, village, email, phone, paid, pruducts, date, payment_method, validator) VALUES 
('$Vorname', '$Nachname', '$Adresse', '$Postleitzahl', '$Ort', '$Email', '$Telefon', '$paid', '$products_json', '$date', '$Payment_method', '$Validator')";
$result = mysqli_query($connect, $sql_kunden);


if (!$result) {
    echo "<script> alert('Something went wrong'); </script>";
} else {
    $sql_select = "SELECT * FROM customers WHERE Validator = '$Validator'";
    $result_select = mysqli_query($connect, $sql_select);
    $row = mysqli_fetch_assoc($result_select);
    $user_id = $row['id'];
    $_SESSION['uid'] = $user_id;

    if ($Payment_method == "card") {
        header("Location:stripe.php");
    
    } else {
        if ($Payment_method == "bill_email") {
            $user_id_url = $user_id * 69;

           
            $subject = 'Bestellbestätigung';
            $body = '
                    Sehr geehrte Damen und Herren <br>
                    Vielen Dank für Ihre Bestellung. <br>
                    Sie haben erfolgreich Ihre Plätze für ' . $totalPrice . ' reserviert.
                    Sie können Ihre Tickets <a href="https://sommernachtstraum.me/ticket.php?uid=' . $user_id_url . '">hier</a> einsehen oder <a href="https://sommernachtstraum.me/pdf.php?uid=' . $user_id_url . '">hier</a> als PDF downloaden. <br>
                    Wir bitten Sie ' . $totalPrice . ' vor dem 6. Mai 2022 an das unten aufgelistete Konto zu überweisen <br>
                    Bitte laden Sie die Überweisungsbestätigung ebenfals vor dem 6 Mai 2022 als PDF <a href="https://sommernachtstraum.me/upload/?usr=' . $user_id . '">hier</a> hoch.<br>
                    Herzliche Grüsse, <br>
                    die 3. Sek Uetikon<br><br>
                    Betrag: ' . $totalPrice . ' <br>
                    IBAN-Nr: <br>
                    Konto-Nr: <br>
                    Zahlungsmitteilung: The Best Monster in Town<br>
                    Konto lautet auf: The Monster Company<br><br>
                    3.Sek Uetikon | sommernachtstraum.me | contact@sommernachtstraum.me<br><br>
                    &copy;Valentin Nussbaumer 2022';


            $sql_update = "UPDATE kunden_demo SET Payment_method = 'Rechnung per Email', Plätze = '$sitze', Price = '$price', Auffuerung = '$aufführung' WHERE id = '$user_id'";
            $result_update = mysqli_query($connect, $sql_update);

            if ($result_update) {
                header("Location: thanks.php?uid=" . $user_id . "");
            }
        }
    }
}