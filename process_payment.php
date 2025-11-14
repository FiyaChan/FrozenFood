<?php
include "db_connect.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $name = $_POST['fullname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $method = $_POST['method'];

    $sql = "INSERT INTO payments (fullname, email, phone, address, method)
            VALUES ('$name', '$email', '$phone', '$address', '$method')";

    if (mysqli_query($conn, $sql)) {
        header("Location: payment_success.html");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
