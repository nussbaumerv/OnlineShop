<?php 
$host_name = '109.106.246.1';
$user_name = 'u701930346_Online';
$password = '3yzSGbksoSih4J8q';
$database = 'u701930346_OnlineShop';

$connect = mysqli_connect($host_name, $user_name, $password, $database);
mysqli_query($connect, "SET NAMES 'utf8'");

if (!$connect) {
    echo "<script> alert('Es konnte keine Verbindung zum Server hergestellt werden.'); </script>";
}

?>
