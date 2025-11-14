<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Ambil data dari form
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password']; // password plain text dari user

    // Check jika email sudah wujud
    $stmt = $conn->prepare("SELECT * FROM customers WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Email sudah digunakan!'); window.history.back();</script>";
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Masukkan data ke database
    $stmt = $conn->prepare("INSERT INTO customers (username, email, opassword) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $email, $hashed_password);

    if ($stmt->execute()) {
        // Set session
        $_SESSION['customer_id'] = $conn->insert_id;
        $_SESSION['name'] = $username;
        $_SESSION['email'] = $email;

        // Redirect terus ke homepage
        header("Location: homeUser.html");
        exit();
    } else {
        echo "<script>alert('Ada masalah semasa register.'); window.history.back();</script>";
    }
}
?>
