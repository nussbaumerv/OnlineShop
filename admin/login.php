<?php
session_start();
$pwd = "Winternachtstraum07";

if($_SESSION['pwd'] == $pwd){
    header("Location: index.php");
}

if ($_POST['submit']) {
    if ($_POST['password'] == $pwd) {
        $_SESSION['pwd'] = $pwd;
        header("Location: index.php");
    }
    else{
        echo "Falsches Passwort";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="https://avatars.githubusercontent.com/u/83828188?v=4" type="img/vnd.microsoft.icon" />
    <title>Login</title>
    <style>
        body {
            text-align: center;
            font-family: Arial;
            margin:0px;
        }
        input[type="password"] {
            padding: 10px 20px;
            width: 300px;
            background-color: rgb(255, 255, 255);
            border: solid;
            border-color: #c72f2f;
            font-size: 16px;
        }

        input[type="password"]:focus {
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
        #container{
            min-height: 100vh;
            display: flex;
        }
        #content{
            margin:auto;
        }
        titel{
            font-size: 50px;
        }

    </style>
</head>

<body>
    
    <div id="container">
        <div id="content">
    <titel>Login</titel>
    <form method="post" action="login.php"><br>
        <input type="password" placeholder="Passwort" name="password"><br><br>
        <input name="submit" type="submit">
    </form>
    </div>
    </div>

</body>

</html>