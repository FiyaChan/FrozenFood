<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "shopdb";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Sambungan gagal: " . $conn->connect_error);
}

$name = $_POST['name'];
$category = $_POST['category'];
$price = $_POST['price'];
$description = $_POST['description'];
$image = "";

// Upload gambar (jika ada)
if (!empty($_FILES['image']['name'])) {
  $target_dir = "uploads/";
  if (!is_dir($target_dir)) {
    mkdir($target_dir, 0777, true);
  }
  $image = $target_dir . basename($_FILES["image"]["name"]);
  move_uploaded_file($_FILES["image"]["tmp_name"], $image);
}

$sql = "INSERT INTO products (name, category, price, description, image)
        VALUES ('$name', '$category', '$price', '$description', '$image')";

if ($conn->query($sql) === TRUE) {
  echo "<script>alert('Produk berjaya ditambah!'); window.location.href='addProduct.html';</script>";
} else {
  echo "Ralat: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
