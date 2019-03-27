<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Cold Case Connection</title>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/styles.css">

		<!--[if lte IE 9]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
		<![endif]-->

	</head>

	<body>

		<nav role="navigation">
					<div class="logo">
					<a href="http://cgi.soic.indiana.edu/~team38/index.php"><h1>Cold Case Connection</h1></a>
					</div>
					<div class="menuLinks">
						<ul>
							<li><a href="http://cgi.soic.indiana.edu/~team38/profile.php">Profile</a></li>
							<li><a href="http://cgi.soic.indiana.edu/~team38/subscription.php ">Subscriptions</a></li>
							<li>
						<?php
						if (isset($_SESSION['username'])) {
							echo '<a href="http://cgi.soic.indiana.edu/~team38/users/logout.php">Log Out</a>';
						}

						else if (!isset($_SESSION['username'])) {
							echo '<a href="http://cgi.soic.indiana.edu/~team38/users/login.php">Log In</a>';
						}
						?>
							</li>
						</ul>

		<p>
		<?php
		if (isset($_SESSION['name'])) {
			echo $_SESSION['name'];
		 }
		 ?>
		</p>
					</div>
		</nav>

		<div class="profile">
		<h1>User Profile information</h1>
		</div>


		<footer>
		<div class="footerDiv">
		<p>footer</p>
		</div>
		</footer>

	</body>
</html>
