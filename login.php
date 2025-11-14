<?php
session_start();
include 'db_connect.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    $email = $_POST['email'];
    $password = $_POST['password'];

    $result = $conn->query("SELECT * FROM users WHERE email='$email'");

    if ($result->num_rows > 0) {

        $row = $result->fetch_assoc();

        if (password_verify($password, $row['password'])) {

            $_SESSION['customer_id'] = $row['id'];
            $_SESSION['name'] = $row['username'];
            $_SESSION['email'] = $row['email'];

            header("Location: homeUser.html"); 
            exit();
        }
    }

    echo "<script>alert('Invalid login'); window.history.back();</script>";
}
?>
