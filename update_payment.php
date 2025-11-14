<?php
include 'includes/db_connect.php';

$order_id = $_POST['order_id'];
$status   = $_POST['payment_status'];

$sql = "UPDATE orders SET payment_status='$status' WHERE order_id='$order_id'";
$conn->query($sql);

header("Location: manage_orders.php");
exit;
?>
