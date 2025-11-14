<?php
include 'includes/db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_POST['user_id'];
    $name    = $_POST['name'];
    $email   = $_POST['email'];
    $phone   = $_POST['phone'];
    $address = $_POST['address'];

    $query = $conn->prepare("UPDATE users SET name=?, email=?, phone=?, address=? WHERE user_id=?");
    $query->bind_param("ssssi", $name, $email, $phone, $address, $user_id);

    if ($query->execute()) {
        $_SESSION['message'] = "Profile updated successfully!";
        header("Location: profile.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }
}
?>
