<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://avatars.githubusercontent.com/u/83828188?v=4" type="img/vnd.microsoft.icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
    <title>Admin</title>
    
    <script>
        function change(id){
            if(id == 1){
                document.getElementById("plätze").style.display = "none";
                document.getElementById("kunden").style.display = "block";
            }
            else{
                document.getElementById("kunden").style.display = "none";
                document.getElementById("plätze").style.display = "block";

            }
            
        }
        function detail(){
            alert("nice");
            var detail = document.getElementsByClassName("detail").style.display = "block";
            alert(detail);

            if(detail.style.display == "none"){
                detail.style.display = "block";
            }

        }

    </script>
    <style>
        body{
            margin:0px;
            font-family: Arial;
            text-align: center;
        }
        table{
            width:95vw;
            margin-left:2.5vw;
            text-align: center;
            margin-bottom:100px;
        }
        td{
            outline:solid;
            outline-color:black;
            padding:5px;
            color:white;
        }
        th{
            padding:7.5px;
            outline:solid;
            outline-color:black;
            background-color: lightgrey;
        }
        #plätze{
            display:none;
        }
        button {
            padding: 5px 10px;
            color: rgb(0, 0, 0);
            background-color: rgb(226, 225, 225);
            border: solid;
            font-size: 16px;
            border-color: #c72f2f;
            cursor: pointer;
            transition: opacity .2s;
        }

        button:hover {
            opacity: 0.7;
            transition: opacity .2s;
        }
        .detail{
            display:none;
        }
        #logout{
            text-decoration: none;
            float:left;
            margin-left:15px;
            color:black;

        }
        a{
            color:white;
        }  
        #webmail{
            float:right;
            margin-right:15px;
            color:black;
        }
        #webmail a{
            color:black;
        }
        #bottom{
            width:100vw;
            padding:15px 0px;
            position:fixed;
            bottom:0px;
            right:0px;
            background-color:white;
        }
        value{
            padding:20px;
            font-weight:bold;
            font-size:25px;
        }
        </style>
</head>
<body>
<?php
session_start();
include("connect.php");

        if($_SESSION['pwd'] != "Winternachtstraum07"){
            header("Location: /demo/login.php");
            exit;
        }
     $sql_kunden = "SELECT * FROM kunden_demo ORDER BY id DESC";
    $kunden_result = mysqli_query($connect, $sql_kunden);

    echo "
    <div id='kunden'>
    <br>
    <button onclick='change(2)'>Sitzplätze anzeigen</button>
    <h1>Kunden</h1>
    <table>
    <tr>
    <th>Name</th>
    <th>Email</th>
    <th>Adresse</th>
    <th>Plätze</th>
    <th>Telefon</th>
    <th>Zahlungsmethode</th>
    <th>Preis</th>
    <th>Bezahlt</th>
    <th>ID</th>
    
    </tr>";
    while($row = mysqli_fetch_assoc($kunden_result)){
        if($row['Payment_method'] == "Karte" && $row['Paid'] == "Nein"){
            
        }
        else{

        $style = "";
        $a = "";
        
        if($row['Paid'] == "Unbekannt"){
            $style = "style='background-color:orange;'";
            $a = "href='https://sommernachtstraum.me/demo/upload/viewer.php?usr=".$row['id']."'";
        }
        if($row['Paid'] == "Nein"){
            $style = "style='background-color:red;'";
        }
        if($row['Paid'] == "Ja"){
            $style = "style='background-color:green;'";
        }
    

        echo "<tr ".$style.">
        <td>".$row['Vorname']. " " .$row['Nachname']."</td>
        <td>".$row['Email']."</td>
        <td>".$row['Adresse']. " | " .$row['Postleitzahl']." | " .$row['Ort']."</td>
        <td>".$row['Plätze']."</td>
        <td>".$row['Telefon']."</td>
        <td>".$row['Payment_method']."</td>
        <td>".$row['Price']."</td>
        <td><a ".$a.">".$row['Paid']."</a></td>
        <td>".$row['id']."</td>
        </tr>";
        }
    }
    echo "</table></div>";

    $sql_plätze = "SELECT * FROM plätze_demo WHERE ordeble = '0' ORDER BY aufführung ASC";
    $plätze_result = mysqli_query($connect, $sql_plätze);

    echo "
    <div id='plätze'>
    <br>
    <button onclick='change(1)'>Kunden anzeigen</button>
    <h1>Sitzplätze</h1>
    <table>
    <tr>
    <th>Platz</th>
    <th>Tisch</th>
    <th>Aufführung</th>
    <th>Kind</th>
    <th>Allergien</th>
    <th>ID</th>
    </tr>";
    while($row = mysqli_fetch_assoc($plätze_result)){
            
            $location = $row['Location'];
            $locationArray = explode('/', $location);
        
        
        if ($locationArray[1] == 1) {
                $table = "A";
            }
            if ($locationArray[1] == 2) {
                $table = "B";
            }
            if ($locationArray[1] == 3) {
                $table = "C";
            }
            if ($locationArray[1] == 4) {
                $table = "D";
            }
            if ($locationArray[1] == 5) {
                $table = "E";
            }
            if ($locationArray[1] == 6) {
                $table = "F";
            }
            if ($locationArray[1] == 7) {
                $table = "G";
            }
            if ($locationArray[1] == 8) {
                $table = "H";
            }
            
        if($row['aufführung'] == 1){
            $sa = "style='background-color:darkgrey;'";
            $aufführung = "Donnerstag";
        }
        else{
            $sa = "style='background-color:grey;'";
            $aufführung = "Freitag";
            
        }
        if($row['kinder'] == 1){
            $kcount += 1;
            $price += 20;
            $kind = "Ja";
            $ks = "style='background-color: #bd9b06;'";
        }
        else{
            $ecount += 1;
            $price += 25;
            $kind = "Nein";
            $ks = "style='background-color: blue;'";
        }

        if($row['alergene'] == "" || $row['alergene'] == "keine"){
            $alergene = "Keine";
            $sal = "style='background-color: green;'";
        }
        else{
            $alergene = $row['alergene'];
            $sal = "style='background-color: red;'";
        }
        echo "<tr>
        <td ".$sa." >".$locationArray[0]."</td>
        <td ".$sa." >".$table."</td>
        <td ".$sa." >".$aufführung."</td>
        <td ".$ks." >".$kind."</td>
        <td ".$sal." >".$alergene."</td>
        <td ".$sa." >".$row['usr_id']."</td>
        </tr>";
    }
    echo "</table>
    </div>     <div id='bottom'>
    <div id='stats'><value>Umsatz: ".$price." CHF</value> <value>Kinder: ".$kcount."</value><value>Erwachsene: ".$ecount."</value></div>
    <a id='logout' href='/demo/logout.php'>Logout</a>
    <span id='webmail'>Passwort: Winternachtstraum07! | <a href='https://mail.hostinger.com/?clearSession=true&_user=contact@sommernachtstraum.me&_ga=2.40604644.779347310.1648450316-1762173112.1646149980'>Webmail</a></span>
    </div>";

    
?>

</body>
</html>

