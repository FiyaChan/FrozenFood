<?php include 'includes/db_connect.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Manage Users | Admin</title>
  <link rel="stylesheet" href="style_admin.css">
  <style>
    body {
      background: #FFF4F9;
      color: #333;
      font-family: 'Poppins', sans-serif;
    }
    .admin-nav {
      background: #FF8EC7;
      padding: 15px 30px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .admin-nav ul { list-style: none; display: flex; gap: 20px; }
    .admin-nav ul li a { text-decoration: none; color: black; font-weight: 500; transition: 0.3s; }
    .admin-nav ul li a.active, .admin-nav ul li a:hover { color: white; }

    .dashboard { padding: 60px 20px; text-align: center; }
    .dashboard h1 { font-size: 30px; margin-bottom: 30px; }

    table {
      margin: auto;
      background: white;
      border-collapse: collapse;
      width: 85%;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    th, td {
      border: 1px solid #ddd;
      padding: 12px;
      text-align: center;
    }
    th { background-color: #FF8EC7; color: white; }
    button {
      padding: 6px 10px;
      border: none;
      border-radius: 5px;
      cursor: pointer;
    }
    .edit-btn { background: #28a745; color: white; }
    .delete-btn { background: #ff4d4d; color: white; }
  </style>
</head>
<body>
  <nav class="admin-nav">
    <div class="logo"><img src="../image/Logo1.png" width="150"></div>
    <ul>
      <li><a href="admin_home.php">Dashboard</a></li>
      <li><a href="manage_products.php">Products</a></li>
      <li><a href="manage_orders.php">Orders</a></li>
      <li><a href="manage_users.php" class="active">Users</a></li>
      <li><a href="reports.php">Reports</a></li>
      <li><a href="../logout.php">Logout</a></li>
    </ul>
  </nav>

  <section class="dashboard">
    <h1>Manage Users</h1>
    <table>
      <tr>
        <th>User ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Action</th>
      </tr>

      <?php
      $sql = "SELECT * FROM users ORDER BY created_at DESC";
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          echo "
            <tr>
              <td>{$row['user_id']}</td>
              <td>" . htmlspecialchars($row['name']) . "</td>
              <td>" . htmlspecialchars($row['email']) . "</td>
              <td>{$row['role']}</td>
              <td>
                <a href='edit_user.php?id={$row['user_id']}'><button class='edit-btn'>Edit</button></a>
                <a href='delete_user.php?id={$row['user_id']}' onclick='return confirm(\"Delete this user?\")'><button class='delete-btn'>Delete</button></a>
              </td>
            </tr>
          ";
        }
      } else {
        echo "<tr><td colspan='5'>No users found.</td></tr>";
      }
      ?>
    </table>
  </section>

  <footer>
    <p>© 2025 FrozenFood Admin Panel</p>
  </footer>
</body>
</html>
