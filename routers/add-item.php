<?php
include '../includes/connect.php';

$name = $_POST['name'];
$price = $_POST['price'];
$sql = "INSERT INTO items (name, price) VALUES ('$name', $price)";
$db->query($sql);
header("location: ../admin-page.php");
?>