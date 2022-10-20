<?php
session_start();
include("connect.php");
include("header.html");
$products = json_decode($_SESSION['basket'], true);

$free_places = false;
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://avatars.githubusercontent.com/u/83828188?v=4" type="img/vnd.microsoft.icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
    <title>Your Basket</title>
    <style>
        body {
            text-align: center;
            margin: 0px;
            font-family: arial;
            -webkit-appearance: none;
        }

        table {
            margin-left: auto;
            margin-right: auto;
        }


        input[type="text"],
        input[type="tel"],
        input[type="email"],
        input[type="number"] {
            padding: 10 20px;
            width: 60vw;
            background-color: rgb(255, 255, 255);
            border: solid;
            border-color: #c72f2f;
            font-size: 16px;
        }

        input[type="text"]:focus,
        input[type="tel"]:focus,
        input[type="email"]:focus,
        input[type="number"]:focus {
            outline: none;
            background-color: #e0e0e0;
        }

        #submit_button {
            padding: 5 10px;
            color: rgb(0, 0, 0);
            background-color: rgb(226, 225, 225);
            border: solid;
            font-size: 16px;
            border-color: #c72f2f;
            cursor: pointer;
            transition: opacity .2s;
        }

        #submit_button:hover {
            opacity: 0.7;
            transition: opacity .2s;
        }

       

        titel {
            font-size: 50px;
        }
        suptitel{
            font-size: 25px;
        }


        #price {
            position: fixed;
            margin: 0px;
            bottom: 0px;
            box-shadow: 30px 20px 30px 40px rgba(0, 0, 0, .1);
            padding: 10px;
            width: 100vw;
            background-color: white;
            opacity: 0.98;
        }


        #zahlungsmethoden {
            width: 60vw;
            margin-left: 20vw;
        }

        textarea {
            padding: 10 20px;
            width: 60vw;
            background-color: rgb(255, 255, 255);
            border: solid;
            border-color: #c72f2f;
            font-size: 16px;
            text-align: center;
            font-family: arial;
        }

        textarea:focus {
            outline: none;
            background-color: #e0e0e0;
        }
        .productName{
            font-size:25px;
        }
        .productImg{
            width:200px;
        }
 
        
    </style>
</head>
<br>
<titel>VHD Shop</titel><br>
<suptitel>Your Basket</suptitel>
<br><br>

<table>
<?php
$totalPrice = 0;
foreach ($products as $product) {
    $sql = "SELECT * FROM products WHERE id = '$product'";
    $result = mysqli_query($connect, $sql);
    if (!$result) {
        echo "<script> alert('Daten konnten nicht geladen Werden.'); </script>";
    }

    $row = mysqli_fetch_assoc($result);
    echo "
    <tr>
    <td><img  class='productImg' src='img/" . $row['id'] . ".png'></tb>
    <td><span class='productName'>" . $row['name'] . "</span><br>
    <span class='productPrice'>" . $row['price'] . " CHF</span></td>
    </tr>";
    $totalPrice += $row['price'];
}

?>
</table>
<br><br> <br>
<h1 id="price"><span id="money"><?php echo $totalPrice; ?></span> CHF</h1>
<br><br>
<h2>Informationen</h2><input name="vorname" type="text" placeholder="Vorname" required><br><br>
<form id="formi" action="process.php" method="post">
<input name="name" type="text" placeholder="Nachname" required><br><br> <br>
<input name="adresse" type="text" placeholder="Adresse" required><br><br>
<input name="postleitzahl" type="text" placeholder="Postleitzahl" required><br><br>
<input name="ort" type="text" remove placeholder="Ort" required><br><br> <br>

<input name="email" type="email" placeholder="Email" required><br><br>
<input name="telefon" type="tel" placeholder="Telefon" required><br><br>

<h2>Zahlungsmethoden</h2>
<div id="zahlungsmethoden">
    <label class="container">
        <input type="radio" name="payment_method" value="card" checked>
        <div class="label">Kartenzahlung</div>
    </label><br>

    <label class="container" id="bill_email">
        <input type="radio" name="payment_method" value="bill_email">
        <div id="email" class="label">Rechnung per Email</div>
</div><br>
<br>

<input hidden type="submit" id="submit">

</form>
<button id="submit_button" onclick="check()">Abschliessen</button>
<br><br><br><br>
<?php include("footer.php"); ?>
<br><br><br>