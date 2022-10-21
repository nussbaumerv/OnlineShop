<?php

include("connect.php");
include("PHPMailer/mail.php");
session_start();

$id = $_SESSION['uid'];

$user_id_url = $id * 69;

$Validator = $_GET['key'] / $id / $id / 34;

$sql = "SELECT * FROM customers WHERE id = '$id'";
$result = mysqli_query($connect, $sql);
if(!$result){
    echo "Something went wrong";
}
$row = mysqli_fetch_assoc($result);
if ($Validator == $row['validator']) {
    $products = json_decode($_SESSION['basket'], true);

    foreach ($products as $product) {
        $sql_p = "SELECT * FROM products WHERE id = '$product'";
        $result_p = mysqli_query($connect, $sql_p);
        $row_p = mysqli_fetch_assoc($result_p);
        $available = $row_p['available'] - 1;

        $sql_update = "UPDATE products SET available = '$available' WHERE id = '$product'";
        $result_update = mysqli_query($connect, $sql_update);
    }

    $subject = 'Order confirmation';
    $message = 'Hi, <br>
                    Thank you for your order. <br>
                    Your order of ' . $row['price'] . 'CHF will be sent to your adress in the next few days.
                    <a style="color:white;" href="https://localhost/OnlineShop/pdf.php?uid=' . $user_id_url . '">Here</a> you can download your bill as a PDF<br>
                    ';
    $to = $row['email'];
    //send_mail($to, $subject, $message);

    $sql_update = "UPDATE customers SET paid = 'Yes' WHERE id = '$id'";
    $result_update = mysqli_query($connect, $sql_update);

    $products = array();
    $products = json_encode($products, true);
    $_SESSION['basket'] = $products;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/1.png" type="img/vnd.microsoft.icon" />
    <title>Danke</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:ital@1&display=swap" rel="stylesheet">
    <link href="thanks.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <div id="text">
            <titel>Thanks for your Order</titel><br>
            <a href="pdf.php?uid=<?php echo $user_id_url; ?>">Download your bill</a>
        </div>
    </div>

</body>

</html>