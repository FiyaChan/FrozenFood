<?php include 'includes/db_connect.php'; ?>
  <!DOCTYPE html>
  <html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="style_admin.css">
  </head>
  <body>
    <nav class="admin-nav">
      <div class="logo"><img src="../image/Logo1.png" width="150"></div>
      <ul>
        <li><a href="admin_home.php" class="active">Dashboard</a></li>
        <li><a href="manage_products.php">Products</a></li>
        <li><a href="manage_orders.php">Orders</a></li>
        <li><a href="manage_users.php">Users</a></li>
        <li><a href="reports.php">Reports</a></li>
        <li><a href="../logout.php">Logout</a></li>
      </ul>
    </nav>

    <section class="dashboard">
      <h1>Welcome to Admin Dashboard</h1>
      <div class="cards">
        <?php
          $users = $conn->query("SELECT COUNT(*) AS total FROM users")->fetch_assoc()['total'];
          $orders = $conn->query("SELECT COUNT(*) AS total FROM orders")->fetch_assoc()['total'];
          $products = $conn->query("SELECT COUNT(*) AS total FROM products")->fetch_assoc()['total'];
        ?>
        <div class="card">Total Users: <?php echo $users; ?></div>
        <div class="card">Total Orders: <?php echo $orders; ?></div>
        <div class="card">Total Products: <?php echo $products; ?></div>
      </div>
    </section>

    <footer>
      <p>© 2025 FrozenFood Admin Panel</p>
    </footer>
  </body>
</html>
