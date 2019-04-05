<!doctype html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<title>Register</title>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Stylesheets -->
		<link rel="stylesheet" href="../css/normalize.css">
		<link rel="stylesheet" href="../css/styles.css">
		<link rel="stylesheet" href="../css/styles2.css">

		<!--[if lte IE 9]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
		<![endif]-->
	</head>

	<body>

		<nav role="navigation">
					<div class="logo">
					<a href="http://cgi.soic.indiana.edu/~marcmeng/app/index.php"><h1>Cold Case Connection</h1></a>
					</div>
					<div class="row">
						<div class="seven columns" id="searchBar">
							<form action="search/search.cgi">
								<input class="eight columns" type="text" name ="terms">
								<input class="three columns button-primary" type="submit" value="Search">
							</form>
						</div>
						<div class="one column">
							<a href="http://cgi.soic.indiana.edu/~marcmeng/app/profile.php">Profile</a>
						</div>
						<div class="two columns">
							<a href="http://cgi.soic.indiana.edu/~marcmeng/app/subscription.php ">Subscriptions</a>
						</div>

		<p>
		<?php
		if (isset($_SESSION['name'])) {
			echo $_SESSION['name'];
		 }
		 ?>
	 	</p>
					</div>
		</nav>

	<h1 id ="register"> Register New User </h1>

	<form action="registerProcess.php" method="post">
	<div class="row">
			<div class="three columns"><label for="firstName">First Name</label><input class="u-full-width" type="text" name="firstName" required></div>
	</div>
	<div class="row">
			<div class="three columns"><label for="lastName">Last Name</label><input class="u-full-width" type="text" name="lastName" required></div>
	</div>
	<div class="row">
			<div class="three columns"><label for="username">Username</label><input class="u-full-width" type="text" name="username" required></div>
	</div>
	<div class="row">
			<div class="three columns"><label for="email">Email</label><input class="u-full-width" type="text" name="email" required></div>
	</div>
	<div class="row">
			<div class="three columns"><label for="password">Password</label><input class="u-full-width" type="password" name="password" required></div>
	</div>
	<div class="row">
				<div class="three columns"><label for="confirmPass">Confirm Password</label><input class="u-full-width" type="password" name="confirmPass" required></div>
	</div>

	<div class="response">

		<?php

		if($_GET) {
			$response = $_GET['response'];

			if (strcmp($response, "pass") == 0) {
				echo '<p>The password fields did not match.</p>';
			}

			if (strcmp($response, "user") == 0) {
				echo '<p>The username you chose is already taken. </p>';
			}

			if (strcmp($response, "email") == 0) {
				echo '<p>The email you have entered has already been used. </p>';
			}
		}

		?>


	<div class="registerForm"><input type="submit" value="Submit"></div>
	</div>

	</form>


	</body>
</html>
