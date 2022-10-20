<?php
include("PHPMailer/mail.php");
if (isset($_POST['Email'])) {
    $to = "nussbaumerv9@gmail.com";
    $subject = "New form submissions";
    $message = $_POST['Name']." contacted us. <br>
    Name: ".$_POST['Name']. "<br>
    Email: <a style='color:white;' href='".$_POST['Email']. "'>".$_POST['Email']."</a><br>
    Message:". $_POST['Message'];
    send_mail($to, $subject, $message);
}
header("Location: thankYou.html");