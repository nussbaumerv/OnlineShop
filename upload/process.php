<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>lädt...</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://avatars.githubusercontent.com/u/83828188?v=4" type="img/vnd.microsoft.icon" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
    <style>
        .loader {
            border: 16px solid #f3f3f3;
            border-radius: 50%;
            border-top: 16px solid grey;
            width: 120px;
            height: 120px;
            -webkit-animation: spin 1s linear infinite;
            animation: spin 1s linear infinite;
        }

        @-webkit-keyframes spin {
            0% {
                -webkit-transform: rotate(0deg);
                border-top: 16px solid lightgrey;
            }

            50% {
                border-top: 16px solid grey;
            }

            100% {
                -webkit-transform: rotate(360deg);
                border-top: 16px solid lightgrey;
            }
        }

        @keyframes spin {
            0% {
                transform: rotate(0deg);
                border-top: 16px solid lightgrey;
            }

            50% {
                border-top: 16px solid grey;
            }

            100% {
                transform: rotate(360deg);
                border-top: 16px solid lightgrey;
            }
        }

        #container {
            min-height: 100vh;
            display: flex;

        }

        #content {
            margin: auto;
            font-size:40px;
            font-family: 'Playfair Display', serif;
        }
    </style>
</head>

<body>
    <div id="container">
        <div id="content">
        <div class="loader"></div>
        </div>
    </div>


</body>

</html>
<?php
include("connect.php");

$id = $_POST['id'];

$sql = "SELECT Paid FROM kunden_demo WHERE id = '$id'";
$result = mysqli_query($connect, $sql);
$row = mysqli_fetch_assoc($result);

if($row['Paid'] == "Nein"){

$file = "uploads/user". $id .".pdf";
 
$ok=1;

$file_type=$_FILES['file']['type'];

if ($file_type=="application/pdf") {

 if(move_uploaded_file($_FILES['file']['tmp_name'], $file))

 {
 $sql_update = "UPDATE kunden_demo SET Paid = 'Unbekannt' WHERE id = '$id'";
$result_update = mysqli_query($connect, $sql_update);
    echo '<script> document.getElementById("content").innerHTML = "Ihr Dokument wurde hochgeladen"; </script>';
}

 else {

    echo '<script> document.getElementById("content").innerHTML = "Es ist etwas schief gegangen"; </script>';

 }

}

else {
    echo '<script> document.getElementById("content").innerHTML = "Es sind nur PDFs erlaubt"; </script>';

}
}
else{
    echo '<script> document.getElementById("content").innerHTML = "Sie habe Ihre Rechnung bereits hochgeladen"; </script>';
}

?>