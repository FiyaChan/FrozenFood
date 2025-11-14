<?php
session_start();
include "db.php";

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
$result = mysqli_query($conn, $sql);

if(mysqli_num_rows($result) == 1){
    $row = mysqli_fetch_assoc($result);

    $_SESSION['user_id'] = $row['id'];       // Session disimpan di sini ✅
    $_SESSION['username'] = $row['name'];    // Data user disimpan juga

    header("Location: index.php");
    exit();
}else{
    echo "Email atau password salah!";
}
?>
