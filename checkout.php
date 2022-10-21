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
    <link rel="shortcut icon" href="https://shop.valentin-nussbaumer.com/img/1.png" type="img/vnd.microsoft.icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <link rel="stylesheet" href="index.css" />
    <title>Checkout</title>
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
            text-align: center;
        }

        titel {
            font-size: 50px;
            font-family: Monstarize;
        }

        suptitel {
            font-size: 25px;
            font-family: Monstarize;
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
            width: 200px !important;
        }

        .title {
            text-align: center;
            font-size: 100px;
        }

        .productImg {
            border-radius: 30px !important;
            margin-bottom: 20px !important;
            margin-right: 20px !important;
        }

        .productName {
            font-family: Monstarize;
        }

        .comprice {
            font-family: Monstarize;
            text-align: center;
            font-size: 30px;
            color:rgb(200, 58, 115)
        }

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
            font-family: Monstarize;
            font-size: 35px;
            border: none;
            background-color: rgb(240, 58, 115);
            width: 300px;
            height: 50px;
            border-radius: 30px;
            color: rgb(72, 212, 255);
        }

        #submit:hover {
            background-color: rgb(200, 58, 115);
        }
    </style>
</head>
<br>
<div class="container" style="font-family: Monstarize;text-align:center;color:rgb(72, 212, 255);">
    <div class="row">
        <div class="col-12 padcol">
            <nav class="navbar navbar-expand-lg">
                <img src="VHD-Logo.png" alt="" />
                <div class="container-fluid">
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse custnav" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link" aria-current="" href="index.php">Home</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="About-us.php">About us</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Kontakt.php">Kontakt</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="Shop.php">Shop</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <br><br><br><br><br><br><br><br>
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
    <span class='productPrice'>" . $row['price'] . " CHF</span><br>
    <a href='dropBasket.php?pid=" . $row['id'] . "&dest=checkout.php'><span class='material-symbols-outlined' style='color: red;'>
     close
    </span></a>
    </td>
    </tr>";
            $totalPrice += $row['price'];
        }
        ?>

    </table>
    <?php
    if ($totalPrice == 0) {
        echo "<h2>Your basket is empty!</h2>";
    } else {
        echo '  <div class="container">
            <hr>
            <div class="comprice">
                Your total: ' . $totalPrice . ' CHF
            </div>';
    }

    ?>


    <br><br>

    <br><br>
    <h2 style="margin-bottom: 100px;margin-top: 100px;;font-size: 95px;color:rgb(200, 58, 115);font-family: Monstarize">Information</h2>
    <div class="informationen">
        <form action="process.php" method="post">
            <div class="row">
                <div class="col-12">
                    <label for="vorname" class="inplabels" style="font-weight: bold;">First name</label>
                    <input name="vorname" type="text" required><b>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="name" class="inplabels">Surname</label>
                    <input name="name" type="text" required><br><br>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <label for="adresse" class="inplabels">Address</label>
                    <input name="adresse" type="text" required><br>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <label for="postleitzahl" class="inplabels">Postal code</label>
                    <input name="postleitzahl" type="number" required><br>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <label for="ort" class="inplabels">City</label>
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
                    <label for="telefon" class="inplabels">Phone</label>
                    <input name="telefon" type="tel" required><br>
                </div>
            </div>


    </div>



    <h2 class="paymeth">Payment methods</h2>
    <div id="zahlungsmethoden">
        <label class="container">
            <input type="radio" name="payment_method" style="margin-top: 20px;" value="card" checked>
            <label class="label">Credit card</label>
        </label><br>

        <label class="container" id="bill_email">
            <input type="radio" style="margin-top: 20px;" name="payment_method" value="bill_email">
            <label id="email" class="label">Invoice by email</label>
    </div><br>
    <br>

    <input type="submit" id="submit">

    </form>
</div>
</div>
<br><br><br>
<br><br><br>
<br><br><br>
<?php include("footer.php"); ?>
<?php include("basket.php"); ?>
<<<<<<< HEAD <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous">
    </script>
    =======
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    >>>>>>> 46ea0800cd0eb43e4ef54b0179293453fa468834