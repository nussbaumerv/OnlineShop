<?php
$children = $_POST['children'];
$adults = $_POST['adults'];

require 'vendor/autoload.php';
// This is your test secret API key.
\Stripe\Stripe::setApiKey('sk_test_51K01ZnDeahJqsgaaUwkl1hqpVAvTyLiMgJiLINOggQgjc5qXKrMTf6ZQCUArO0UnYufMg6g9wxeOAo8KLtLOzV5Q00nkGPhfB2');

header('Content-Type: application/json');

$YOUR_DOMAIN = 'http://localhost:8888/others/Theater/payment/prebuild/public';

$checkout_session = \Stripe\Checkout\Session::create([
  'line_items' => [[
    # Provide the exact Price ID (e.g. pr_1234) of the product you want to sell
    'price' => 'price_1KYnCMDeahJqsgaaWgcPLlco',
    'quantity' => 3, ],

    ['price' => 'price_1KYnC6DeahJqsgaaPTPhkLfD',
    'quantity' => 5,
  ]],
  'mode' => 'payment',
  'success_url' => $YOUR_DOMAIN . '/success.html',
  'cancel_url' => $YOUR_DOMAIN . '/cancel.html',
]);

header("HTTP/1.1 303 See Other");
header("Location: " . $checkout_session->url);