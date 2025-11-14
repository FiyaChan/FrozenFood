<?php include 'includes/db_connect.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Add Product | Admin</title>
  <link rel="stylesheet" href="style_admin.css">
  <style>
    body { background: #FFF4F9; font-family: 'Poppins', sans-serif; text-align:center; }
    form { background:white; padding:30px; margin:50px auto; width:400px; border-radius:10px; box-shadow:0 3px 8px rgba(0,0,0,0.1); }
    input, button { width:90%; padding:10px; margin:10px 0; border:1px solid #ccc; border-radius:5px; }
    button { background:#FF8EC7; color:white; border:none; cursor:pointer; }
    button:hover { background:#ff66b2; }
  </style>
</head>
<body>
  <h1>Add New Product</h1>
  <form method="POST">
    <input type="text" name="product_name" placeholder="Product Name" required>
    <input type="number" name="price" step="0.01" placeholder="Price (RM)" required>
    <button type="submit" name="add">Add Product</button>
    <br>
    <a href="manage_products.php">← Back to Product List</a>
  </form>

  <?php
  if (isset($_POST['add'])) {
    $name = $_POST['product_name'];
    $price = $_POST['price'];

    $insert = $conn->query("INSERT INTO products (product_name, price) VALUES ('$name', '$price')");
    if ($insert) {
      echo "<script>alert('Product added successfully!'); window.location='manage_products.php';</script>";
    } else {
      echo "<script>alert('Error adding product.');</script>";
    }
  }
  ?>
</body>
</html>
