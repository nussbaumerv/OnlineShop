<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
            echo "<hr><br>Total: " . $totalPrice . " CHF";
            ?>
        </div>
        <div id="bottom_menu">

            <span><a class="notA" href="checkout.php" id="checkOut">Checkout</a></span>

        </div>


    </div>

    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    <script>
        function dropItem(id) {
            window.open("dropBasket.php?pid=" + id + "&dest=shop.php");
        }

        function openNav() {
            document.getElementById("mySidenav").style.width = "400px";
            document.getElementById("main").style.marginLeft = "400px";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0px";
            document.getElementById("main").style.marginLeft = "0";
        }
    </script>

</body>

</html>