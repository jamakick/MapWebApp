<?php
session_start();

if (isset($_SESSION['username'])) {
	header("Location: ../index.php");
};

?>
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

		<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">


		<!--[if lte IE 9]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
		<![endif]-->

	</head>

	<body>

		<nav role="navigation">
					<div class="logo">
					<a href="http://cgi.soic.indiana.edu/~team38/index.php"><h1>Cold Case Connection</h1></a>
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
		<div class="row">
					<div><label for="disclaimer">Disclosure: due to the nature of our site, by continuing to register and use our platform you confirm that you are over 18 years of age and may be exposed to mature content related to the cold cases on our site.</label><input type="checkbox" name="disclaimer" value="confirm" required>I am over 18 years old and acknowledge that this site contains mature content.</div> <br>
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

	</div>

	<div class="registerForm"><input type="submit" value="Submit"></div>
	</div>

	</form>

	<footer>
	<div class="footerDiv2">

	<a href="http://cgi.soic.indiana.edu/~team38/index.php">Home</a>
	<a href="http://cgi.soic.indiana.edu/~team38/profile.php">Profile</a>
	<a href="http://cgi.soic.indiana.edu/~team38/subscription.php">Subscriptions</a>
	<?php
	if (isset($_SESSION['username'])) {
		echo '<a href="http://cgi.soic.indiana.edu/~team38/users/logout.php">Log Out</a>';
	}

	else if (!isset($_SESSION['username'])) {
		echo '<a href="http://cgi.soic.indiana.edu/~team38/users/login.php">Log In</a>';
	}
	?>

	</div>
	</footer>

</body>
</html>
