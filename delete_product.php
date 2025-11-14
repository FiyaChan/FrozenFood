<?php
include 'includes/db_connect.php';

if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $conn->query("DELETE FROM products WHERE product_id = '$id'");
}

header("Location: manage_products.php");
exit();
?>
