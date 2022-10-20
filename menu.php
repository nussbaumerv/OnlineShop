<?php
include("connect.php");
$products = json_decode($_COOKIE['basket'], true);
?>
<html>

<head>
</head>

<body>
    <div id="mySidenav" class="sidenav">

        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>

        <div id="top_menu">
            <?php
            foreach ($products as $product) {
                $sql = "SELECT * FROM products WHERE id = '$product'";
                $result = mysqli_query($connect, $sql);
                if (!$result) {
                    echo "<script> alert('Daten konnten nicht geladen Werden.'); </script>";
                }

                $row = mysqli_fetch_assoc($result);
                echo $row['name'];
            }
            ?>
        </div>
        <div id="bottom_menu">
            <form method="get" action="createRoom.php">
                <input placeholder="Room Name" class="input_menu" type="text" name="r" required> <br>
                <button class="button_menu" type="submit" onclick="save();">Create Room</button>
            </form>
        </div>
    </div>

    <div class="zo">
        <span class="navib" onclick="openNav()"> &#9776; </span>
    </div>

    <script>
        function openNav() {
            document.getElementById("mySidenav").style.width = "250px";
            document.getElementById("main").style.marginLeft = "250px";
            document.body.style.backgroundColor = "black";
        }

        function closeNav() {
            document.getElementById("mySidenav").style.width = "0px";
            document.getElementById("main").style.marginLeft = "0";
            document.body.style.backgroundColor = "black";
        }
    </script>