<?php
include 'db_connect.php'; // sambungan ke database

$sql = "SELECT * FROM products ORDER BY product_id ASC";
$result = $conn->query($sql);
$products = [];

if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $products[] = $row;
  }
}
?>
