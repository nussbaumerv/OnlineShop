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
  <title>Bootstrap demo</title>
  <link href=https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
  <link rel="stylesheet" href="index.css">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link href="contact-form.css" rel="stylesheet">
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
                  <a class="nav-link active" href="Kontakt.php">Kontakt</a>
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
          <div class="fcf-body">

            <div id="fcf-form">
              <h3 class="fcf-h3">Contact us</h3>

              <form id="fcf-form-id" class="fcf-form-class" method="post" action="contact.php">

                <div class="fcf-form-group">
                  <label for="Name" class="fcf-label">Your name</label>
                  <div class="fcf-input-group">
                    <input type="text" id="Name" name="Name" class="fcf-form-control" required>
                  </div>
                </div>

                <div class="fcf-form-group">
                  <label for="Email" class="fcf-label">Your email address</label>
                  <div class="fcf-input-group">
                    <input type="email" id="Email" name="Email" class="fcf-form-control" required>
                  </div>
                </div>

                <div class="fcf-form-group">
                  <label for="Message" class="fcf-label">Your message</label>
                  <div class="fcf-input-group">
                    <textarea id="Message" name="Message" class="fcf-form-control" rows="6" maxlength="3000" required></textarea>
                  </div>
                </div>

                <div class="fcf-form-group">
                  <button type="submit" id="fcf-button" class="fcf-btn fcf-btn-primary fcf-btn-lg fcf-btn-block">Send Message</button>
                </div>



              </form>
            </div>

          </div>

        </div>
      </div>


    </div>

    <?php include("basket.php") ?>
</body>

</html>