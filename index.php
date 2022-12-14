<?php
session_start();
include("connect.php");
$products = json_decode($_SESSION['basket'], true);
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>VHD Shop</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="shortcut icon" href="https://shop.valentin-nussbaumer.com/img/1.png" type="img/vnd.microsoft.icon" />
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
                  <a class="nav-link active" aria-current="" href="index.php">Home</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="About-us.php">About us</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="Kontakt.php">Kontakt</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link " href="Shop.php">Shop</a>
                </li>
              </ul>
              <span onclick="openNav()" class="material-symbols-outlined addBasket" style="margin-left: 455px;">
                shopping_cart
              </span>


            </div>
          </div>
        </nav>
      </div>
      <div class="row">
        <div class="col-12">
          <h1 class="headtitle">Welcome to the VHD Shop</h1>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <h1 class="headsubtitle">The best monsters in town</h1>
        </div>
      </div>

      <div class="row">
        <div class="col-12">
          <a href="Shop.php" class="shoplink">
            CLick here to go to the Shop
          </a>
        </div>
      </div>
      <?php include("basket.php") ?>

    </div>