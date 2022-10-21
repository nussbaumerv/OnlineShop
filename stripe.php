<?php

include("connect.php");
session_start();
$id = $_SESSION['uid'];

$sql = "SELECT * FROM customers WHERE id = '$id'";
$result = mysqli_query($connect, $sql);

$row = mysqli_fetch_assoc($result);

$get_key = $id * $row['validator'] * $id * 34;


$products = [
  [
    'price' => 'price_1LutEYHEg6xGmK2rM9vPe24b',
    'quantity' => $_SESSION['amount'],

  ],
];

require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51KZX6GHEg6xGmK2r1wDefPxcusuk2V3oc36ULvCfosMncCjTGxmyJsvgm36Ep6N0sNnEDUutQDVSBwezTfe4IGo000smUGXXQZ');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://shop.valentin-nussbaumer.com';

$checkout_session = \Stripe\Checkout\Session::create([
  'customer_email' => $_POST['email'],
  'line_items' => $products,
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/thanks.php?key=' . $get_key,
  'cancel_url' => $YOUR_DOMAIN . '/cancel.php',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
