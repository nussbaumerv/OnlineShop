<html>
    <head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Rechnung hochladen</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://avatars.githubusercontent.com/u/83828188?v=4" type="img/vnd.microsoft.icon" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
<script src="https://www.google.com/recaptcha/enterprise.js?render=6LeulSQfAAAAALR-WNApmKm51zXJDwuiq4BYy-sF"></script>
<script>
grecaptcha.enterprise.ready(function() {
    grecaptcha.enterprise.execute('6LeulSQfAAAAALR-WNApmKm51zXJDwuiq4BYy-sF', {action: 'login'}).then(function(token) {
       ...
    });
});
</script>

    <style>
        body {
            -webkit-appearance: none;
            margin: 0px;
            text-align: center;
        }

        titel {
            font-family: 'Playfair Display', serif;
            font-size: 50px;
        }
        input[type="file"],
        input[type="text"] {
            padding: 10 20px;
            width: 60vw;
            background-color: rgb(255, 255, 255);
            border: solid;
            border-color: #c72f2f;
            font-size: 16px;
        }

        input[type="file"]:focus,
        input[type="text"]:focus {
            outline: none;
            background-color: #e0e0e0;
        }

        input[type="submit"] {
            padding: 5px 10px;
            color: rgb(0, 0, 0);
            background-color: rgb(226, 225, 225);
            border: solid;
            font-size: 16px;
            border-color: #c72f2f;
            cursor: pointer;
            transition: opacity .2s;
        }

        input[type="submit"]:hover {
            opacity: 0.7;
            transition: opacity .2s;
        }
    </style>
</head>
<body>
    <titel>Rechnung hochladen</titel> <br><br>
    
<form action="process.php" method="post" enctype="multipart/form-data">

<input type="file" name="file" size="50"><br><br>
<input type="text" id="usr" name="id" placeholder="Kundenummer">

<br><br>

<input type="submit" value="Upload">

</body>

</form>
</html>

<?php
if(isset($_GET['usr'])){
    echo '
    <script>
    document.getElementById("usr").style.display = "none";
    document.getElementById("usr").value = "'.$_GET['usr'].'"; 
    </script>';
}
?>