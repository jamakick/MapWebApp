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
							<li><a href="http://cgi.soic.indiana.edu/~team38/subscription.php">Subscriptions</a></li>
						</ul>
					</div>
		</nav>

	<h1 id ="register"> Register New User </h1>

	<form action="registerProcess.php" method="post">
	<div>
	<div class="registerForm">First Name: <input type="text" name="firstName" required></div>
	<div class="registerForm">Last Name: <input type="text" name="lastName" required></div>
	<div class="registerForm">Username: <input type="text" name="username" required></div>
	<div class="registerForm">Email: <input type="text" name="email" required></div>
	<div class="registerForm">Password: <input type="password" name="password" required></div>
	<div class="registerForm">Confirm Password: <input type="password" name="confirmPass" required></div>

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

	</div>

	<div class="registerForm"><input type="submit" value="Submit"></div>
	</div>

	</form>


	</body>
</html>
