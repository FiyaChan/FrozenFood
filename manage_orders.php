<?php include 'includes/db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Orders</title>
  <link rel="stylesheet" href="style_admin.css">
</head>
<body>
  <nav class="admin-nav">
    <div class="logo"><img src="../image/Logo1.png" width="150"></div>
    <ul>
      <li><a href="admin_home.php">Dashboard</a></li>
      <li><a href="manage_products.php">Products</a></li>
      <li><a href="manage_orders.php" class="active">Orders</a></li>
      <li><a href="manage_users.php">Users</a></li>
      <li><a href="reports.php">Reports</a></li>
      <li><a href="../logout.php">Logout</a></li>
    </ul>
  </nav>

  <section class="dashboard">
    <h1>Manage Orders</h1>

    <table border="1" cellpadding="10" style="margin:auto; background:white; width:90%;">
      <tr>
        <th>Order ID</th>
        <th>Customer</th>
        <th>Date</th>
        <th>Total (RM)</th>
        <th>Payment Status</th>
        <th>Action</th>
      </tr>

      <?php
        $result = $conn->query("SELECT * FROM orders ORDER BY order_id DESC");
        while($row = $result->fetch_assoc()) {
          ?>
          <tr>
            <td><?= $row['order_id'] ?></td>
            <td><?= $row['customer_name'] ?></td>
            <td><?= $row['order_date'] ?></td>
            <td>RM <?= $row['total_amount'] ?></td>

            <!-- Payment Status -->
            <td>
              <?= $row['payment_status'] ?>
            </td>

            <td>
              <!-- Edit button -->
              <a href='edit_order.php?id=<?= $row['order_id'] ?>'>
                <button>Edit</button>
              </a>

              <!-- Delete button -->
              <a href='delete_order.php?id=<?= $row['order_id'] ?>' onclick='return confirm("Delete this order?")'>
                <button>Delete</button>
              </a>

              <!-- Update Payment Status -->
              <form action="update_payment.php" method="POST" style="margin-top:5px;">
                <input type="hidden" name="order_id" value="<?= $row['order_id'] ?>">

                <select name="payment_status">
                  <option value="Pending" <?= ($row['payment_status'] == 'Pending') ? 'selected' : '' ?>>Pending</option>
                  <option value="Paid" <?= ($row['payment_status'] == 'Paid') ? 'selected' : '' ?>>Paid</option>
                </select>

                <button type="submit">Update</button>
              </form>
            </td>
          </tr>
      <?php } ?>
    </table>

  </section>

  <footer>
    <p>© 2025 FrozenFood Admin Panel</p>
  </footer>
</body>
</html>
