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
include("PHPMailer/mail.php");

$products_json = $_SESSION['basket'];
$products = json_decode($products_json, true);
$totalPrice = 0;
$amount = 0;

foreach ($products as $product) {
    $sql = "SELECT * FROM products WHERE id = '$product'";
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        echo "<script> alert('Daten konnten nicht geladen Werden.'); </script>";
    }

    $row = mysqli_fetch_assoc($result);
    $totalPrice += $row['price'];
    $amount += 1;
}
$_SESSION['amount'] = $amount;


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


$sql_kunden = "INSERT INTO customers (prename, name, adress, post_code, village, email, phone, paid, price, products, date, payment_method, validator) VALUES 
('$Vorname', '$Nachname', '$Adresse', '$Postleitzahl', '$Ort', '$Email', '$Telefon', '$paid', '$totalPrice', '$products_json', '$date', '$Payment_method', '$Validator')";
$result = mysqli_query($connect, $sql_kunden);


if (!$result) {
    echo "<script> alert('Something went wrong'); </script>";
} else {

    $user_id = mysqli_insert_id($connect);
    $_SESSION['uid'] = $user_id;

    if ($Payment_method == "card") {
        header("Location:stripe.php");
    
    } else {
        if ($Payment_method == "bill_email") {
            $user_id_url = $user_id * 69;

            $subject = 'Order confirmation';
            $message = '
                            Hi, <br>
                            Thank you for your order. <br>
                            Your order of ' . $totalPrice . 'CHF will be sent to your adress in the next few days.
                            <a style="color:white;" href="https://sommernachtstraum.me/pdf.php?uid=' . $user_id_url . '">Here</a> you can download your bill as a PDF<br>
                            Please Pay your order in the next 30. Days and sent the Moneyto the Bankaccount below.
                        
                            <br><br><br>
                            Betrag: ' . $totalPrice . ' <br>
                            IBAN-Nr: <br>
                            Konto-Nr: <br>
                            Zahlungsmitteilung: The Best Monster in Town<br>
                            Konto lautet auf: The Monster Company<br><br>
                            ';
            $to = $Email;
            //send_mail($to, $subject, $message);

            $sql_update = "UPDATE customers SET payment_method = 'Bill email' WHERE id = '$user_id'";
            $result_update = mysqli_query($connect, $sql_update);

            $products = array();
            $products = json_encode($products, true);
            $_SESSION['basket'] = $products;

            if ($result_update) {
                header("Location: thanks.php");
            }
        }
    }
}
