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
                  <a class="nav-link" href="About-us.php">About me</a>
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
          <a href="addBasket.php?pid=1&dest=Shop.php">Add to cart</a>
        </button>
      </div>
      <div class="col-4">
        <img src="valentinmonster.png" width="100%">
        <p class="prodname">Valentin: 20$</p>
        <button class="buybutton1">
          <a href="addBasket.php?pid=1&dest=Shop.php">Add to cart</a>
        </button>
      </div>
      <div class="col-4">
        <img src="Dominicmonster.png" width="100%" />
        <p class="prodname">Dominic: 20$</p>
        <button class="buybutton2">
          <a href="addBasket.php?pid=1&dest=Shop.php">Add to cart</a>
        </button>
      </div>
    </div>
    <div id="mySidenav" class="sidenav">

      <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
      <div id="top_menu">
        <?php
        $totalPrice = 0;
        foreach ($products as $product) {
          $sql = "SELECT * FROM products WHERE id = '$product'";
          $result = mysqli_query($connect, $sql);
          if (!$result) {
            echo "<script> alert('Daten konnten nicht geladen Werden.'); </script>";
          }

          $row = mysqli_fetch_assoc($result);
          echo "<div class='containerProducts'>
    <img  class='productImg' src='img/" . $row['id'] . ".png'>
    <span class='name'>" . $row['name'] . "</span><br>
    <span class='price'>" . $row['price'] . " CHF</span><br>
    <div><br>";
          $totalPrice += $row['price'];
        }
        echo "<hr><br>Total: " . $totalPrice . " CHF";
        ?>
      </div>
      <div id="bottom_menu">

        <a class="checkOut" href="checkout.php">Checkout</a>

      </div>


    </div>

  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  <script>
    function openNav() {
      document.getElementById("mySidenav").style.width = "300px";
      document.getElementById("main").style.marginLeft = "300px";
    }

    function closeNav() {
      document.getElementById("mySidenav").style.width = "0px";
      document.getElementById("main").style.marginLeft = "0";
    }
  </script>
</body>

</html>