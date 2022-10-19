<?php

include("connect.php");
session_start();
$id = $_POST['id'];
$_SESSION['id'] = $id;

$sql = "SELECT * FROM kunden_demo WHERE id = '$id'";
$result = mysqli_query($connect, $sql);

$row = mysqli_fetch_assoc($result);

$get_key = $id * $row['Validator'] * $id * 34;

$adults = $_POST['amount'];

if ($_POST['kids'] == $_POST['amount']) {
  $kids = $_POST['kids'];
  $products = [
    [
      'price' => 'price_1KiHP4HEg6xGmK2rhcFf5bSE',
      'quantity' => $kids,

    ],
  ];
} else {
  if ($_POST['kids']) {
    $kids = $_POST['kids'];
    $adults_c = $_POST['amount'] - $_POST['kids'];

    $products = [
      [
        'price' => 'price_1KiHPVHEg6xGmK2rCEoLsmew',
        'quantity' => $adults_c,
      ],
      [
        'price' => 'price_1KiHP4HEg6xGmK2rhcFf5bSE',
        'quantity' => $kids,

      ],
    ];
  } else {
    $products = [
      [
        'price' => 'price_1KiHPVHEg6xGmK2rCEoLsmew',
        'quantity' => $adults,
      ],
    ];
  }
}

require 'vendor/autoload.php';

\Stripe\Stripe::setApiKey('sk_test_51KZX6GHEg6xGmK2r1wDefPxcusuk2V3oc36ULvCfosMncCjTGxmyJsvgm36Ep6N0sNnEDUutQDVSBwezTfe4IGo000smUGXXQZ');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'https://sommernachtstraum.me/demo';

$checkout_session = \Stripe\Checkout\Session::create([
  'customer_email' => $_POST['email'],
  'line_items' => $products,
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/thanks.php?key=' . $get_key,
  'cancel_url' => $YOUR_DOMAIN . '/cancel.php',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);
