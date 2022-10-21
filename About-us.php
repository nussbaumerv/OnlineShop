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
  <link rel="stylesheet" href="about-us.css" />
  <link rel="stylesheet" href="index.css" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Ubuntu" />
  <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
</head>

<body>
  <div class="container">
    <?php include("nav.php"); ?>

    <div class="row">
      <div class="col-12">
        <div>
          <h2 class="abouthead" style="margin-top: 280px">About us</h2>
        </div>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <p class="abouttxt">
          Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
          nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
          erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
          et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est
          Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur
          sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
          et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
          accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
          no sea takimata sanctus est Lorem ipsum dolor sit amet.
        </p>
      </div>
    </div>

    <div class="row">
      <div class="col-12">
        <h2 class="abouthead">Our mission</h2>
      </div>
    </div>

    <div class="row">
      <div class="col'12">
        <p class="abouttxt">
          Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam
          nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam
          erat, sed diam voluptua. At vero eos et accusam et justo duo dolores
          et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est
          Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur
          sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore
          et dolore magna aliquyam erat, sed diam voluptua. At vero eos et
          accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren,
          no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum
          dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod
          tempor invidunt ut labore et dolore magna aliquyam erat, sed diam
          voluptua. At vero eos et accusam et justo duo dolores et ea rebum.
          Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum
          dolor sit amet.
        </p>
      </div>
    </div>

    <div class="row">
      <div class="col'12">
        <h2 class="abouthead" style="margin-bottom: 30px;">Our creators</h2>
      </div>
    </div>

    <div class="row" style="margin-bottom: 60px;">
      <div class="col-4">
        <img src="Dominicmonster.png" width="100%" class="creatormonster" />
        <p class="founders">Dominic <br>(the funny guy)</p>
      </div>
      <div class="col-4">
        <img src="henrimonster.png" width="100%" alt="" />
        <p class="founders">Henri <br>(the happy guy)</p>
      </div>
      <div class="col-4">
        <img src="valentinmonster.png" width="100%" alt="" />
        <p class="founders">Valentin <br>(the crazy guy)
        </p>
      </div>
    </div>
  </div>
  <?php include("basket.php"); ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
</body>

</html>