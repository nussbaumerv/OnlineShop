<?php
session_start();
include("connect.php");
include("header.html");
$products = json_decode($_SESSION['basket'], true);
?>
<html>

<head>
    <style>
        * {
            font-family: arial;
        }

        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            right: 0;
            background-color: #111;
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 60px;
            text-align: right;
        }

        .sidenav a {
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            transition: transform .2s;
            color: #818181;
            display: block;
            transition: 0.3s;
        }

        .sidenav a:hover {
            color: #f1f1f1;
            transition: transform .2s;
            transition: color: .2s;
            transform: scale(1.03);
        }

        .sidenav .closebtn {
            position: absolute;
            top: 0;
            left: 10px;
            font-size: 36px;
        }

        .navib {
            font-size: 30px;
            cursor: pointer
        }

        .navib {
            font-size: 40px;
        }

        .zo {
            transition: margin-left .5s;
            color: black;
            text-align: right;
            position: fixed;
            transition: transform .2s;
            width: 40px;
            height: 50px;
            right: 10px;
            transition: color: .2s;
            top: 0;
        }

        .zo:hover {
            color: grey;
            transition: transform .2s;
            transition: color: .2s;
            transform: scale(1.12);

        }

        .productImg {
            width: 50px;
            float: left;
        }

        .containerProducts {
            padding: 0px;
            color: white;
        }

        .name {
            font-size: 25px;
        }

        #bottom_menu {
            margin: 0;
            position: absolute;
            bottom: 5%;
            left: 50%;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        #top_menu {
            height: 90%;
            bakcgro
        }
    </style>
</head>

<body>
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

    <div class="zo">
        <span class="navib" onclick="openNav()"> &#9776; </span>
    </div>

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