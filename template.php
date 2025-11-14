<?php session_start(); ?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>FrozenFood</title>
<style type="text/css">
	
	body {
        font-family: Arial, sans-serif;
        margin: 0;
        background-color: #fdfdfd;
        color: #333;
    }
	.title {
		font-family: Baskerville;
		font-size: 16px;
		color: #000000;
	}
	.bgimage{
		background-image: url(image/background1.png);
        background-repeat: no-repeat;
		background-size: cover;
		padding-top:65px;
		width:100%;
		height:300px;
	}
	.link{
		color: #000000;
		text-decoration: none;
	}
	
	footer{
		background:#222;
		color:#fff;
		text-align:center;
		padding:20px;
		margin-top:30px;
	}
	.footer-container {
		display: flex;
		justify-content: center;
		flex-wrap: wrap;
		gap: 50px;
		margin-bottom: 30px;
		text-align: left;
	}

	.footer-column h4 {
		font-size: 16px;
		font-weight: bold;
		margin-bottom: 15px;
		color: aliceblue;
	}

	.footer-column ul {
		list-style: none;
		padding: 0;
		margin: 0;
	}

	.footer-column ul li {
		margin-bottom: 10px;
	}

	.footer-column ul li a {
		text-decoration: none;
		color: #fff;
		font-size: 14px;
	}

	.footer-column ul li a:hover {
		color: #b22222; /* merah maroon */
	}

	.footer-social {
		text-align: center;
		margin-bottom: 20px;
	}

	.footer-social a {
		color: #000;
		margin: 0 10px;
		font-size: 22px;
		transition: color 0.3s;
	}

	.footer-social a:hover {
		color: #b22222; /* merah maroon */
	}

	.footer-bottom {
		text-align: center;
		font-size: 13px;
		color: #555;
	}
	
	.popup-container {
		position: relative;
		display: inline-block;
		cursor: pointer;
	}

	.popup-text {
	  visibility: hidden;
	  opacity: 0;
	  position: absolute;
	  top: calc(100% + 6px);
	  left: 50%;
	  transform: translateX(-50%);
	  opacity: 0;
	  transition: opacity .18s ease, visibility .18s;
	  pointer-events: auto;
		z-index: 999;
	}

	.popup-container:hover .popup-text,
	.popup-text:hover {
	  visibility: visible;
	  opacity: 1;
	}
	.popup-text.active {
    display: block;
    opacity: 1;
	}
	
</style>
</head>

<body>
<header>
  <table width="100%" border="0" bgcolor="#F8E9E9" class="title">
		  <tbody>
			<tr>
			<td width="231" height="56"><img src="image/logo1.png" width="218" height="97" alt=""/></td>
			  <td width="400">&nbsp;</td>
			  <td width="100" align="center"><a href="Page1.html" target="_blank" class="link"><strong>HOME</strong></a></td>
			  <td width="117" align="center"><a href="Product.html" target="_blank" class="link"><strong>PRODUCTS</strong></a></td>
			<td width="116" align="center"><a href="tips&tricks.html" target="_blank" class="link"><strong>TIPS AND TRICKS</strong></a></td>
			  <td width="111" align="center"><a href="aboutus.html" target="_blank" class="link"><strong>ABOUT US</strong></a></td>
			  <td width="123" align="center"><strong>CONTACT US</strong></td>
			  <td width="66" align="center"><img src="image/search.png" width="37" height="37" alt=""/></td>
			  <td width="66" align="center"><img src="image/cart.png" width="40" height="37" alt=""/></td>			
			  <td width="70" align="center"><a href="profile.html" target="_blank" class="link">
				  <div class="popup-container"><img src="image/profile.png" width="39" height="36" alt=""/>
					  <div class="popup-text">
						  <?php if(isset($_SESSION['user_id'])): ?>
						  <a href="profile.php" class="link">My Profile</a><br>
						  <a href="logout.php" class="link">Logout</a>
						  <?php else: ?>
						  <a href="login.php" class="link">Login</a><br>
						  <a href="register.php" class="link">Register</a>
						  <?php endif; ?>
					  </div>
				  </div></a>
				</td>
			</tr>
		  </tbody>
		</table>
</header>
	

	<!-- Footer -->
<footer>
	<div class="footer-container">
		<div class="footer-column">
			<h4>Track My Order</h4>
			<h4>Services</h4>
			<ul>
				<li><a href="#">Catering</a></li>
				<li><a href="#">E-Invoice</a></li>
			</ul>
		</div>

		<div class="footer-column">
			<h4>About Us</h4>
			<ul>
				<li><a href="#">Our History</a></li>
				<li><a href="#">Location</a></li>
			</ul>
		</div>

		<div class="footer-column">
			<h4>Our Food</h4>
			<ul>
				<li><a href="#">Halal Policy</a></li>
				<li><a href="#">Tips and Trick</a></li>
			</ul>
		</div>

		<div class="footer-column">
			<h4>Help & Support</h4>
			<ul>
				<li><a href="#">Share Your Feedback</a></li>
				<li><a href="#">Customer Service</a></li>
				<li><a href="#">Scam Alert</a></li>
				<li><a href="#">FAQ</a></li>
			</ul>
		</div>
	</div>
	<p>&copy; 2025 FrozenFood. All Rights Reserved.</p>
	<p>Follow us on</p>
	<p>
		<a href="https://www.facebook.com/ninjavanmalaysia/" target="_blank"><img src="image/facebook.png" width="47" height="44" alt=""/></a>&nbsp;
		<a href="https://www.instagram.com/ninjavanmalaysia/" target="_blank"><img src="image/instagram.png" width="47" height="44" alt=""/></a>&nbsp;
		<a href="https://www.tiktok.com/@frozenfood4life?_t=ZS-90Fv23X9ao0&_r=1" target="_blank"><img src="image/tiktok.png" width="47" height="44" alt=""/></a>&nbsp;
	</p>
		
	
</footer>
	<script>
		document.addEventListener("DOMContentLoaded", function() {
			const icon = document.querySelector(".popup-container");
			const popup = document.querySelector(".popup-text");

			// Toggle popup bila klik icon
			icon.addEventListener("click", function(e) {
				e.stopPropagation(); // stop click keluar dari icon
				popup.classList.toggle("active");
			});

			// Klik dalam popup jangan tutup
			popup.addEventListener("click", function(e) {
				e.stopPropagation();
			});

			// Klik luar popup → tutup
			document.addEventListener("click", function() {
				popup.classList.remove("active");
			});
		});
	</script>
	
</body>
</html>
