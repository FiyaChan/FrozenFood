<?php session_start(); ?>

<?php if(isset($_SESSION['username'])) { ?>
    <li><a href="profile.php"><i class="fas fa-user-circle"></i> <?= $_SESSION['username']; ?></a></li>
<?php } else { ?>
    <li><a href="login.html"><i class="fas fa-user-circle"></i></a></li>
<?php } ?>
