<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://shop.valentin-nussbaumer.com/img/1.png" type="img/vnd.microsoft.icon" />
    <title>Document</title>
    <style>
        .sidenav {
            height: 100%;
            width: 0;
            position: fixed;
            z-index: 1;
            top: 0;
            right: 0;
            background-color: rgb(255, 255, 255);
            overflow-x: hidden;
            transition: 0.5s;
            padding-top: 200px;
            text-align: right;
            z-index: 3000;
            box-shadow: 0 .7px 2px 2px rgba(0, 0, 0, 0.092);
            visibility: hidden;
        }

        .sidenav .isA {
            margin-top: 68px;
            width: 50px;
            height: 50px;
            padding: 8px 8px 8px 32px;
            text-decoration: none;
            font-size: 25px;
            transition: transform .2s;
            color: rgb(240, 58, 115);
            display: block;
            transition: 0.3s;
        }

        .sidenav .isA:hover {
            color: rgb(192, 32, 83);
            transition: transform .2s;
            transition: .2s;
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


        .productImg {
            box-shadow: 0 1px 3px 3px rgba(0, 0, 0, .6);
            margin-left: 25px;
            margin-top: 1px;
            width: 70px;
            float: left;
            border-radius: 30px;
        }

        .containerProducts {
            padding: 0px;
            color: rgb(72, 212, 255);
            text-align: center;
        }

        .notA {
            position: absolute;
            margin-left: 20px;
            border-radius: 20px;
            padding: 20px;
            padding-left: 40px;
            padding-right: 40px;
            background-color: rgb(240, 58, 115);
            color: white;

        }

        .name {
            font-size: 25px;
        }

        #bottom_menu {
            width: 200px;
            height: 65px;
            margin: 0;
            margin-top: 50px;
            position: relative;
            text-align: center;
        }

        #top_menu {
            height: 90%;
        }

        a {
            color: rgb(72, 212, 255);
            text-decoration: none;
        }

        a:hover {
            color: grey;
        }

        .notA:hover {

            color: rgb(206, 206, 206);
            background-color: rgb(192, 32, 83);
        }



        .material-symbols-outlined {
            font-variation-settings:
                'FILL'0,
                'wght'400,
                'GRAD'0,
                'opsz'48
        }
        .addBasket{
            cursor: pointer;
        }
        .addBasket:hover{
            color:grey;
        }


    </style>
</head>

<body>
    <div id="mySidenav" class="sidenav">

        <a href="javascript:void(0)" class="closebtn isA" onclick="closeNav()">&times;</a>
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
<span class='name'>" . $row['name'] . "</span> <span onclick='dropItem(" . $row['id'] . ");' class='material-symbols-outlined dropItemMenu' style='color: red; cursor:pointer;'>
close
</span> <br>
<span class='price'>" . $row['price'] . " CHF</span><br>
<div><br> 
";
                $totalPrice += $row['price'];
            }
            if($totalPrice != 0){
            echo "<hr><br>Total: " . $totalPrice . " CHF
            </div>
            <div id='bottom_menu'>
                <span><a class='notA' href='checkout.php' id='checkOut'>Checkout</a></span>
            </div>";
            }
            else{
                echo "<h2 style='text-align:center;'>Your basket it empty<h2>";
            }
            ?>



    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script>
        function dropItem(id) {
            window.open("dropBasket.php?pid=" + id + "&dest=Shop.php");
        }

        function openNav() {
            document.getElementById("mySidenav").style.width = "400px";
            document.getElementById("mySidenav").style.visibility='visible';
   
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0px";
            document.getElementById("mySidenav").style.visibility='hidden';
  
        }
    </script>

</body>

</html>