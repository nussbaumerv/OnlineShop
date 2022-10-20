<?php
include("PHPMailer/mail.php");
if (isset($_POST['Email'])) {
    $to = "nussbaumerv9@gmail.com";
    $subject = "New form submissions";
    $message = $_POST['Email']. "contacted us. <br>He wrote:". $_POST['Message'];
    send_mail($to, $subject, $message);
}
header("Location: thankYou.html")