<?php
session_start();
$destination = $_GET['dest'];
$id = $_GET['pid'];
if($id != 0){
    $products = json_decode($_SESSION['basket'], true);
    array_push($products, $id);
    $products = json_encode($products, true);
    $_SESSION['basket'] = $products;
    if($destination != ""){
        header("Location: ".$destination."");
    }
    else{
        header("Location: index.php");
    }
}