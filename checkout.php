<?php
session_start();
include("connect.php");
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
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
    <title>Your Basket</title>
    <style>
        body {
            margin: 0px;
            font-family: Ubuntu;
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
            display: block;
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-wrap: wrap;
            flex-wrap: wrap;
            -ms-flex-align: stretch;
            align-items: stretch;
            width: 100%;
            padding-bottom: 20px;
            display: block;
            width: 100%;
            height: calc(1.5em + 0.75rem + 2px);
            padding: 0.375rem 0.75rem;
            font-size: 2rem;
            font-weight: 400;
            line-height: 1.5;
            color: black;
            background-color: white;
            background-clip: padding-box;
            border: 1px solid #ced4da;
            outline: none;
            border-radius: 0.25rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        titel {
            font-size: 50px;
        }

        suptitel {
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

        .productName {
            font-size: 25px;
        }

        .productImg {
            width: 200px;
        }

        .title {
            text-align: center;
            font-size: 100px;
        }

        img {
            border-radius: 30px;
            margin-bottom: 20px;
            margin-right: 20px;
        }

        .productName {
            font-family: Monstarize;
        }

        .comprice {
            font-family: Ubuntu;
            text-align: center;
            font-size: 40px;
        }
    </style>
</head>
<br>
<div class="container" style="font-family: Monstarize;text-align:center;color:rgb(72, 212, 255);">
    <titel class="title">VHD Shop</titel><br>
    <suptitel>Your Basket:</suptitel>
</div>
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
    <span class='productPrice'>" . $row['price'] . " CHF</span>
    <a href='dropBasket.php?pid=" . $row['id'] . "&dest=checkout.php'>Remove from Basket</a>
    </td>
    </tr>";
        $totalPrice += $row['price'];
    }

    ?>

</table>




<style>
    .inplabels {
        display: inline-block;
        margin-bottom: 1px;
        color: rgb(72, 212, 255);
        font-size: 30px;
    }

    @font-face {
        font-family: Monstarize;

        src: url("Monstarize-qZ09l.ttf");
    }

    .paymeth {
        color: rgb(72, 212, 255);
    }

    #submit {
        background-color: white;
        width: 200px;
        height: 40px;
        border-radius: 30px;
        color: rgb(72, 212, 255);
    }
    #submit:hover{
        background-color: gray;
    }
</style>

<div class="container">
    <hr>
    <div class="comprice">
        <a style="font-size: 30px;">Your total:</a>
        <?php echo $totalPrice; ?>
        <a style="font-size: 30px;">CHF</a>
    </div>


    <br><br> <br>

    <br><br>
    <h2 style="margin-bottom: 120px;font-size: 50px;color:rgb(72, 212, 255);">Information</h2>
    <div class="infromationen">
        <form action="process.php" method="post">
            <div class="row">
                <div class="col-12">
                    <label for="vorname" class="inplabels">Vorname</label>
                    <input name="vorname" type="text" required><b>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="name" class="inplabels">Name</label>
                    <input name="name" type="text" required><br><br>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="adresse" class="inplabels">Adresse</label>
                    <input name="adresse" type="text" required><br>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <label for="postleihzahl" class="inplabels">Postleihzahl</label>
                    <input name="postleitzahl" type="text" required><br>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <label for="ort" class="inplabels">Ort</label>
                    <input name="ort" type="text" remove required><br><br>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <label for="email" class="inplabels">Email</label>
                    <input name="email" type="email" required><br>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="telefon" class="inplabels">Telefon</label>
                    <input name="telefon" type="tel" required><br>
                </div>
            </div>


    </div>



    <h2 class="paymeth">Payment methods</h2>
    <div id="zahlungsmethoden">
        <label class="container">
            <input type="radio" name="payment_method" value="card" checked>
            <div class="label">credit card</div>
        </label><br>

        <label class="container" id="bill_email">
            <input type="radio" name="payment_method" value="bill_email">
            <div id="email" class="label">bill per email</div>
    </div><br>
    <br>

    <input type="submit" id="submit">

    </form>
</div>
<br><br><br><br>

<br><br><br>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>