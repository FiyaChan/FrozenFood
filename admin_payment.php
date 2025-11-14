<?php
include "db_connect.php";
$result = mysqli_query($conn, "SELECT * FROM payments");
?>

<!doctype html>
<html>
<head>
<title>Admin - Payments</title>
<style>
table {
  width: 100%;
  border-collapse: collapse;
}
th, td {
  padding: 12px;
  border-bottom: 1px solid #ccc;
  text-align: center;
}
th { background: pink; }
</style>
</head>
<body>

<h2 style="text-align:center;">Payment Records</h2>

<table>
  <tr>
    <th>ID</th>
    <th>Full Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Address</th>
    <th>Method</th>
    <th>Date</th>
  </tr>

  <?php while($row = mysqli_fetch_assoc($result)) { ?>
  <tr>
    <td><?= $row['payment_id'] ?></td>
    <td><?= $row['fullname'] ?></td>
    <td><?= $row['email'] ?></td>
    <td><?= $row['phone'] ?></td>
    <td><?= $row['address'] ?></td>
    <td><?= $row['method'] ?></td>
    <td><?= $row['created_at'] ?></td>
  </tr>
  <?php } ?>

</table>
</body>
</html>
