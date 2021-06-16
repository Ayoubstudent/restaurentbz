<?php

session_start();
define('SITEURL', 'http://localhost/restaurante/');

$conn = mysqli_connect('localhost', 'root', '') or die(mysqli_error());
$db_select = mysqli_select_db($conn, 'food-ordere') or die(mysqli_error());




?>