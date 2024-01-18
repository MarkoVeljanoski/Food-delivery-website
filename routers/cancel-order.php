<?php
include '../includes/connect.php';
include '../includes/wallet.php';
$status = $_POST['status'];
$id = $_POST['id'];
$sql = "UPDATE orders SET status='$status', deleted=1 WHERE id=$id;";
$db->query($sql);
$sql = mysqli_query($db, "SELECT * FROM orders where id=$id");
while($row1 = mysqli_fetch_array($sql)){
$total = $row1['total'];
}
if($_POST['payment_type'] == 'Wallet'){
	$balance = $balance+$total;
	$sql = "UPDATE wallet_details SET balance = $balance WHERE wallet_id = $wallet_id;";
	$db->query($sql);
}
header("location: ../orders.php");
?>