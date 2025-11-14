<?php
	session_start();
	session_destroy();  // Buang semua sesi user
	header("Location: loginadmin.html"); 
	exit();
?>
