<?php
include '../includes/connect.php';
$status = $_POST['status'];
$id = $_POST['id'];

$sql = "UPDATE orders SET status='$status' WHERE id=$id;";
$db->query($sql);

header("location: ../all-orders.php");
?>