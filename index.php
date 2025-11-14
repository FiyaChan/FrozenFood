<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head><title>Home</title></head>
<body>

<?php if(isset($_SESSION['user_id'])): ?>
    <p>Selamat datang, <?= $_SESSION['username']; ?>!</p>
    <a href="logout.php">Logout</a>

<?php else: ?>
    <p>Anda belum login!</p>
    <a href="login.php">Login</a>

<?php endif; ?>

</body>
</html>
