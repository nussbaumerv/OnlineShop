<?php
include("connect.php");

$sql = "SELECT * FROM plätze_demo WHERE aufführung = '1'";
$result = mysqli_query($connect, $sql);
$sql_2 = "SELECT * FROM plätze_demo WHERE aufführung = '2'";
$result_2 = mysqli_query($connect, $sql_2);

$free_places = false;
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://avatars.githubusercontent.com/u/83828188?v=4" type="img/vnd.microsoft.icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
    <title>Platz reservieren</title>
    <style>
        body {
            text-align: center;
            margin: 0px;
            font-family: arial;
            -webkit-appearance: none;
        }

        #place {
            width: 20px;
            height: 20px;
            background-color: #000;
            margin: 0.5vw;
            cursor: pointer;
            position: absolute;
            -webkit-appearance: none;
        }

        #place:disabled {
            cursor: not-allowed;
            background-color: rgb(151, 151, 151);
        }

        #place:checked {
            background-color: white;
            border: solid;
            border-color: #c72f2f;
        }

        table {
            margin-left: auto;
            margin-right: auto;
        }


        input[type="text"],
        input[type="tel"],
        input[type="email"],
        input[type="number"] {
            padding: 10 20px;
            width: 60vw;
            background-color: rgb(255, 255, 255);
            border: solid;
            border-color: #c72f2f;
            font-size: 16px;
        }

        input[type="text"]:focus,
        input[type="tel"]:focus,
        input[type="email"]:focus,
        input[type="number"]:focus {
            outline: none;
            background-color: #e0e0e0;
        }

        #submit_button {
            padding: 5 10px;
            color: rgb(0, 0, 0);
            background-color: rgb(226, 225, 225);
            border: solid;
            font-size: 16px;
            border-color: #c72f2f;
            cursor: pointer;
            transition: opacity .2s;
        }

        #submit_button:hover {
            opacity: 0.7;
            transition: opacity .2s;
        }

        .r_1 {
            transform: rotate(0deg);
            top: 16px;
            left: 100px;
        }

        .r_2 {
            transform: rotate(55deg);
            bottom: 169px;
            left: 51px;
        }

        .r_3 {
            transform: rotate(17deg);
            top: 75px;
            left: 20px
        }

        .r_4 {
            transform: rotate(75deg);
            top: 125px;
            left: 20px;
        }

        .r_5 {
            transform: rotate(35deg);
            top: 170px;
            left: 50px;
        }

        .r_6 {
            transform: rotate(35deg);
            bottom: 170px;
            right: 50px;
        }

        .r_7 {
            transform: rotate(15deg);
            top: 125px;
            right: 20px;
        }

        .r_8 {
            transform: rotate(72deg);
            top: 75px;
            right: 20px;
        }

        .r_9 {
            transform: rotate(55deg);
            top: 170px;
            right: 50px;
        }

        .r_10 {
            transform: rotate(0deg);
            bottom: 16px;
            left: 100px;
        }

        .circle {
            width: 120px;
            height: 120px;
            border-radius: 75px;
            position: absolute;
            top: 55px;
            left: 55px;
            background-color: #000;
        }

        .elements {
            width: 230px;
            height: 230px;
            position: absolute;
        }

        .elements_static {
            position: static;
            width: 100vw;
            height: 230px;
        }

        #el_2 {
            right: 100px;
        }

        #el_1 {
            left: 100px;
        }

        p {
            font-family: 'Playfair Display', serif;
            font-size: 40px;
            color: white;
            margin-top: 30px;
        }

        @media only screen and (min-width: 900px) {
            #el_2 {
                right: 150px;
            }

            #el_1 {
                left: 150px;
            }
        }

        @media only screen and (min-width: 1100px) {
            #el_2 {
                right: 300px;
            }

            #el_1 {
                left: 300px;
            }
        }

        @media only screen and (min-width: 1300px) {
            #el_2 {
                right: 400px;
            }

            #el_1 {
                left: 400px;
            }
        }

        titel {
            font-family: 'Playfair Display', serif;
            font-size: 50px;
        }
        suptitel{
            font-family: 'Playfair Display', serif;
            font-size: 25px;
        }

        #bühne {
            width: 60vw;
            margin-left: 20vw;
            color: rgb(88, 88, 88);
            background-color: rgba(0, 0, 0, 0.055);
            padding: 10px;
            margin-bottom: 30px;
            margin-top: 30px;
        }

        #price {
            position: fixed;
            margin: 0px;
            bottom: 0px;
            box-shadow: 30px 20px 30px 40px rgba(0, 0, 0, .1);
            padding: 10px;
            width: 100vw;
            background-color: white;
            opacity: 0.98;
        }

        input[type="radio"] {
            color: black;
        }

        .label {
            border: solid;
            border-color: #c72f2f;
            padding-top: 10px;
            padding-bottom: 10px;
            display: block;
        }

        .container>input[type="radio"] {
            visibility: hidden;
            position: absolute;
        }

        .container>input[type="radio"]+.label {
            cursor: pointer;

        }

        .container>input[type="radio"]:checked+.label {
            background-color: #e0e0e0;

        }

        .label2 {
            border: solid;
            border-color: #c72f2f;
            display: inline-block;
            padding: 5px 10px;
            margin: 0 10px;
        }

        .container2>input[type="radio"] {
            visibility: hidden;
            position: absolute;
        }

        .container2>input[type="radio"]+.label2 {
            cursor: pointer;
        }

        .container3 {
            display: flex;
            justify-content: center;
        }


        .container2>input[type="radio"]:checked+.label2 {
            background-color: #e0e0e0;

        }

        #zahlungsmethoden {
            width: 60vw;
            margin-left: 20vw;
        }

        .nurfacts {
            width: 60vw;
            margin-left: 20vw;

        }

        #two {
            display: none;
        }

        @media only screen and (max-width: 650px) {

            input[type="text"],
            input[type="tel"],
            input[type="email"],
            input[type="number"] {
                width: 80vw;
            }

            #place {
                width: 10px;
                height: 10px;
                background-color: #000;
                margin: 0.25vw;
                cursor: pointer;
                position: absolute;
            }

            .r_1 {
                top: 8px;
                left: 50px;
            }

            .r_2 {
                bottom: 84.5px;
                left: 25.5px;
            }

            .r_3 {
                top: 37.5px;
                left: 10px
            }

            .r_4 {
                top: 62.5px;
                left: 10px;
            }

            .r_5 {
                top: 85px;
                left: 25px;
            }

            .r_6 {
                bottom: 85px;
                right: 25px;
            }

            .r_7 {
                top: 62.5px;
                right: 10px;
            }

            .r_8 {
                top: 37.5px;
                right: 10px;
            }

            .r_9 {
                top: 85px;
                right: 25px;
            }

            .r_10 {
                bottom: 8px;
                left: 50px;

            }

            .circle {
                width: 60px;
                height: 60px;
                border-radius: 30px;
                top: 27.5px;
                left: 27.5px;
            }

            .elements {
                width: 115px;
                height: 115px;
            }

            .elements_static {
                position: static;
                width: 100vw;
                height: 115px;
            }

            #el_2 {
                right: 60px;
            }

            #el_1 {
                left: 60px;
            }

            p {
                font-family: 'Playfair Display', serif;
                font-size: 20px;
                color: white;
                margin-top: 15px;
            }
        }

        @media only screen and (min-width: 500px) {
            #el_2 {
                right: 150px;
            }

            #el_1 {
                left: 150px;
            }
        }

        @media only screen and (min-width: 650px) {
            #el_2 {
                right: 50px;
            }

            #el_1 {
                left: 50px;
            }
        }



        @media only screen and (min-width: 900px) {
            #el_2 {
                right: 150px;
            }

            #el_1 {
                left: 150px;
            }
        }

        @media only screen and (min-width: 1100px) {
            #el_2 {
                right: 300px;
            }

            #el_1 {
                left: 300px;
            }
        }

        @media only screen and (min-width: 1300px) {
            #el_2 {
                right: 400px;
            }

            #el_1 {
                left: 400px;
            }
        }

        textarea {
            padding: 10 20px;
            width: 60vw;
            background-color: rgb(255, 255, 255);
            border: solid;
            border-color: #c72f2f;
            font-size: 16px;
            text-align: center;
            font-family: arial;
        }

        textarea:focus {
            outline: none;
            background-color: #e0e0e0;
        }

        details {
            cursor: pointer;
        }
    </style>
</head>
<br>
<titel>Platz Reservieren</titel><br>
<suptitel>inklusive 3-Gänge-Menu</suptitel>
<br><br>

<div class="container3">
    <label class="container2">
        <input onclick="date_1()" type="radio" name="dates" value="1" checked>
        <div class="label2">Do 12 Mai</div>
    </label><br>

    <label class="container2">
        <input onclick="date_3()" type="radio" name="dates" value="3">
        <div class="label2">Fr 13 Mai</div>
    </label><br>
</div>
<script>
    function date_1() {
        document.getElementById('one').style.display = "block";
        document.getElementById('two').style.display = "none";
    }

    function date_3() {
        document.getElementById('two').style.display = "block";
        document.getElementById('one').style.display = "none";
    } 
</script>
<div id="bühne">BÜHNE</div>
<?php

$counter = 0;
echo '<form id="formi" action="process.php" method="post">';
echo '<div  id="one">';
while ($row = mysqli_fetch_assoc($result)) {
    $location = $row['Location'];
    if ($counter == "0") {
        echo '     
        <div class="elements_static">
        <div id="el_1" class="elements">
            <div class="circle">
            <p>A</p>
            </div>';
    }
    if ($counter == "10") {
        echo '  
        </div>
        <div id="el_2" class="elements">
            <div class="circle">
                <p>B</p>
            </div>';
    }
    if ($counter == "20") {
        echo '
        </div>
        </div>
        <div class="elements_static">
        <div id="el_1" class="elements">
            <div class="circle">
                <p>C</p>
            </div>';
    }
    if ($counter == "30") {
        echo ' 
        </div>
        <div id="el_2" class="elements">
            <div class="circle">
                <p>D</p>
            </div>';
    }
    if ($counter == "40") {
        echo '  
        </div>
        </div>
        <div class="elements_static">
        <div id="el_1" class="elements">
            <div class="circle">
                <p>E</p>
            </div>';
    }

    if ($counter == "50") {
        echo '  
        </div>
        <div id="el_2" class="elements">
            <div class="circle">
                <p>F</p>
            </div>';
    }
    if ($counter == "60") {
        echo '  
        </div>
        </div>
        <div class="elements_static">
        <div id="el_1" class="elements">
            <div class="circle">
                <p>G</p>
            </div>';
    }
    if ($counter == "70") {
        echo '  
        </div>
        <div id="el_2" class="elements">
            <div class="circle">
                <p>H</p>
            </div>';
    }

    $first_letter = explode('/', $location, -1);
    if ($row['ordeble'] == "1") {
        echo '<input id="place" class="places r_' . $first_letter[0] . '" name="sitze[]" value="1,' . $location . '" type="checkbox" onclick="money()" />';
        $free_places = true;
    } else {
        echo '<input id="place" class="places r_' . $first_letter[0] . '" name="sitze[]" value="1,' . $location . '" type="checkbox" disabled /> ';
    }
    if ($counter == "79") {
        echo '  </div> </div>';
    }

    $counter = $counter + 1;
}
echo "</div>";

$counter = 0;
echo '<div id="two">';
while ($row = mysqli_fetch_assoc($result_2)) {
    $location = $row['Location'];
    if ($counter == "0") {
        echo '     
        <div class="elements_static">
        <div id="el_1" class="elements">
            <div class="circle">
            <p>A</p>
            </div>';
    }
    if ($counter == "10") {
        echo '  
        </div>
        <div id="el_2" class="elements">
            <div class="circle">
                <p>B</p>
            </div>';
    }
    if ($counter == "20") {
        echo '
        </div>
        </div>
        <div class="elements_static">
        <div id="el_1" class="elements">
            <div class="circle">
                <p>C</p>
            </div>';
    }
    if ($counter == "30") {
        echo ' 
        </div>
        <div id="el_2" class="elements">
            <div class="circle">
                <p>D</p>
            </div>';
    }
    if ($counter == "40") {
        echo '  
        </div>
        </div>
        <div class="elements_static">
        <div id="el_1" class="elements">
            <div class="circle">
                <p>E</p>
            </div>';
    }

    if ($counter == "50") {
        echo '  
        </div>
        <div id="el_2" class="elements">
            <div class="circle">
                <p>F</p>
            </div>';
    }
    if ($counter == "60") {
        echo '  
        </div>
        </div>
        <div class="elements_static">
        <div id="el_1" class="elements">
            <div class="circle">
                <p>G</p>
            </div>';
    }
    if ($counter == "70") {
        echo '  
        </div>
        <div id="el_2" class="elements">
            <div class="circle">
                <p>H</p>
            </div>';
    }

    $first_letter = explode('/', $location, -1);
    if ($row['ordeble'] == "1") {
        echo '<input id="place" class="places r_' . $first_letter[0] . '" name="sitze[]" value="2,' . $location . '" type="checkbox" onclick="money()" />';
        $free_places = true;
    } else {
        echo '<input id="place" class="places r_' . $first_letter[0] . '" name="sitze[]" value="2,' . $location . '" type="checkbox" disabled /> ';
    }
    if ($counter == "79") {
        echo '  </div> </div>';
    }

    $counter = $counter + 1;
}
echo "</div>";

if($free_places == false){
    $sql = "UPDATE plätze_demo SET usr_id = 0, ordeble = 1, food = NULL, alergene = ''";
    $result = mysqli_query($connect, $sql);
    header("Location: reservieren.php");
}
?>
<script>
    function money() {
        var inputElems = document.getElementsByClassName("places");
        var kids = document.getElementById("kids");
        var people = document.getElementById("people_menu");
        var people_fields = document.getElementById("people_fields");

        var div = "";
        var div_fields = "";

        var count = 0;
        var first = 0;
        for (var i = 0; i < inputElems.length; i++) {
            if (inputElems[i].type === "checkbox" && inputElems[i].checked === true) {
                var location = inputElems[i].value;
                const array = location.split(",");

                if (array[0] == 1) {
                    color = "red";
                }
                if (array[0] == 2) {
                    color = "green";
                }
                var p = '"';

                var count_out = count + 1;
                count_out = "Person " + count_out;

                var result = "<label class='container2'><input type='radio' onclick='food(" + p + array[1] + p + ")' id='radio_food' name='place_select'><div class='label2'>" + count_out + "</div></label>";

                var result_fields = "<div style='display:none' class='nurfacts' id='nur," + array[1] + "'><br> <label class='container'><input name='eat," + array[1] + "' type='radio' value='Vegi' checked> <div class='label'>Vegetarisches 3-Gänge-Menu inbegriffen</div></label><br><textarea name='alergene," + array[1] + "' placeholder='Allergien'></textarea></div>";

                div_fields += result_fields;
                div += result;

                people.innerHTML = div;
                people_fields.innerHTML = div_fields;

                count++;
                if (count < kids.value) {
                    kids.innerHTML = 0;
                }
            }
        }

        if (count == 0) {
            document.getElementById("money").innerHTML = 0;
            people.innerHTML = "";
            if (kids.value != 0) {
                alert("Zu hoher Kinderanteil");
                kids.value = 0;
            }
        }
        if (first == 0) {
            document.getElementById("radio_food").click();

        }
        first = 1;
        if (count < kids.value) {
            alert("Zu hoher Kinderanteil");
            kids.value = 0;
        }
        kids = kids.value * 5;
        count *= 25;
        price = count - kids;
        document.getElementById("money").innerHTML = price;
    }

    function check() {
        var inputElems = document.getElementsByClassName("places");
        let count = 0;
        for (var i = 0; i < inputElems.length; i++) {
            if (inputElems[i].type === "checkbox" && inputElems[i].checked === true) {
                count++;
            }
        }
        if (count == 0) {
            alert("Sie müssen einen Sitzplatz auswählen");

        } else {
            if (document.getElementById("money").innerHTML != 0) {
                document.getElementById('submit').click();
            } else {
                alert("Sie müssen einen Sitzplatz auswählen");

            }
        }
    }
    var old = 0;

    function food(id) {
        if (old == 0) {} else {
            document.getElementById("nur," + old).style.display = "none";
        }
        document.getElementById("nur," + id).style.display = "block";
        old = id;
    }
</script>

<br><br> <br>
<input id="kids" name="kids" onchange="money()" type="number" min="0" placeholder="Anzahl Personen unter 16"><br><br>

<h1 id="price"><span id="money">0</span> CHF</h1>
<br><br>
<h2>Informationen</h2><input name="vorname" type="text" placeholder="Vorname" required><br><br>
<input name="name" type="text" placeholder="Nachname" required><br><br> <br>
<input name="adresse" type="text" placeholder="Adresse" required><br><br>
<input name="postleitzahl" type="text" placeholder="Postleitzahl" required><br><br>
<input name="ort" type="text" remove placeholder="Ort" required><br><br> <br>

<input name="email" type="email" placeholder="Email" required><br><br>
<input name="telefon" type="tel" placeholder="Telefon" required><br><br>

<h2>Zahlungsmethoden</h2>
<div id="zahlungsmethoden">
    <label class="container">
        <input type="radio" name="payment_method" value="card" checked>
        <div class="label">Kartenzahlung</div>
    </label><br>

    <label class="container" id="bill_email">
        <input type="radio" name="payment_method" value="bill_email">
        <div id="email" class="label">Rechnung per Email</div>
</div><br>
<h2>Allergien / Vegetarismus</h2>
<div class="container3" id="people_menu"></div>
<div id="people_fields"></div>
<br>
<details>
    <summary>Menukarte / Allergien</summary><br>
    <b>Vorspeise:</b><br> Mozzarella Spiesse mit grünem Pesto & Baguette <br>
    <b>Hauptgang:</b><br> Pasta an rotem Tomatenpesto<br>
    <b>Dessert:</b><br> Lemon-Blueberry-Cheesecake im Glas<br> <br>
    <b>Allergene:</b><br> Laktose, Nüsse (Pinienkerne), Weizen, Gluten<br>
    <br><br>

</details>
<br>

<input hidden type="submit" id="submit">

</form>
<button id="submit_button" onclick="check()">Abschliessen</button>
<br><br><br><br>
<?php include("footer.php"); ?>
<br><br><br>