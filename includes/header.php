<?php
	include 'includes/modal.php';
	include 'includes/common.php';
?>

<nav class="nav navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#mynavBar">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
			<a href="products.php" class="navbar-brand"><i class="glyphicon glyphicon-gift"></i>CouponRevive</a>
		</div>
		<div class="collapse navbar-collapse" id="mynavBar">
			<ul class="nav navbar-nav navbar-right">
				<?php
				$url1 = basename($_SERVER['PHP_SELF']);
				$url2 = "success.php";
				if (isset($_SESSION["email"])) {
					if ($url1 == $url2) {
						echo '<li><a href="settings.php"><span class="glyphicon glyphicon-user"></span> Settings</a></li>';
						echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
					} else {
						echo '<li><a href="review.php"><span class="glyphicon glyphicon-star"></span> Review</a></li>';
						echo '<li><a href="seller_upload.php"><span class="glyphicon glyphicon-cloud-upload"></span> Sell</a></li>';
						echo '<li><a href="cart.php"><span class="glyphicon glyphicon-shopping-cart"></span> Cart</a></li>';
						echo '<li><a href="settings.php"><span class="glyphicon glyphicon-user"></span> Dashboard</a></li>';
						echo '<li><a href="contact.php"><span class="glyphicon glyphicon-phone"></span> Contact Us</a></li>';
						echo '<li><a href="logout.php"><span class="glyphicon glyphicon-log-out"></span> Logout</a></li>';
					}
				} else {
					echo '<li><a href="signup.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>';
					echo '<li><a href="#" data-toggle="modal" data-target="#loginmodal"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>';
					echo '<li><a href="about.php"><span class="glyphicon glyphicon-tasks"></span> About Us</a></li>';
				}
				?>
			</ul>
		</div>
	</div>
</nav>
