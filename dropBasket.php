<?php
session_start();
$destination = $_GET['dest'];
$id = $_GET['pid'];
if($id != 0){
    $products = json_decode($_SESSION['basket'], true);
    if (($key = array_search($id, $products)) !== false) {
        unset($products[$key]);
    }
    $products = json_encode($products, true);
    $_SESSION['basket'] = $products;
    if($destination != ""){
        header("Location: ".$destination."");
    }
    else{
        header("Location: shop.php");
    }
}