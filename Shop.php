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
      <?php include("nav.php"); ?>
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