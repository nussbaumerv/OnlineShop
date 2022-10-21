<?php
session_start();
include("connect.php");
$products = json_decode($_SESSION['basket'], true);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Bootstrap demo</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous" />
  <link rel="stylesheet" href="Shop.css">
  <link rel="stylesheet" href="index.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>

  <div class="container">
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
                  <a class="nav-link active" href="Shop.php">Shop</a>
                </li>
              </ul>
              <span onclick="openNav()" class="material-symbols-outlined addBasket" style="margin-left: 455px;">
                shopping_cart
              </span>


            </div>
          </div>
        </nav>
      </div>
    <div class="row" style="margin-top: 300px;">
      <div class="col-12">
        <p class="headtitleshop">Shop</p>
      </div>
    </div>

    <div class="row">
      <div class="col-4">
        <img src="henrimonster.png" width="100%" />
        <p class="prodname">Henri: 20$</p>
        <button class="buybutton">
          <a class="isA" href="addBasket.php?pid=3&dest=Shop.php">Add to cart</a>
        </button>
      </div>
      <div class="col-4">
        <img src="valentinmonster.png" width="100%">
        <p class="prodname">Valentin: 20$</p>
        <button class="buybutton1">
          <a class="isA" href="addBasket.php?pid=2&dest=Shop.php">Add to cart</a>
        </button>
      </div>
      <div class="col-4">
        <img src="Dominicmonster.png" width="100%" />
        <p class="prodname">Dominic: 20$</p>
        <button class="buybutton2">
          <a class="isA" href="addBasket.php?pid=4&dest=Shop.php">Add to cart</a>
        </button>
      </div>
    </div>
    <?php include("basket.php"); ?>
  </div>
</body>

</html>