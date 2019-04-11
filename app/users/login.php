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
		<title>Log in</title>
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
					<div class="row">
						<div class="six columns" id="searchBar">
							<form action="http://cgi.soic.indiana.edu/~team38/search/search.cgi">
								<input class="seven columns" type="text" name ="terms">
								<input class="four columns button-primary" type="submit" value="Search">
							</form>
						</div>
						<div class="one column">
							<a href="http://cgi.soic.indiana.edu/~team38/profile.php">Profile</a>
						</div>
						<div class="two columns">
							<a href="http://cgi.soic.indiana.edu/~team38/subscription.php ">Subscriptions</a>
						</div>
					</div>
		</nav>
	<h1 id ="register"> Log In </h1>

	<form action="loginProcess.php" method="post">
		<div class="row">
		<div class="three columns"><label for="Username">Username</label><input class="u-full-width" type="text" name="username" required></div>
		</div>
		<div class="row">
		<div class="three columns"><label for="Password">Password</label><input class="u-full-width" type="password" name="password" required></div>
		</div>
		<div><input type="submit" value="Submit"></div>

	<div class="response">

	<?php

	if($_GET) {
		$response = $_GET['login'];

		if (strcmp($response, "fail") == 0) {
			echo '<p>The username or password you entered was incorrect. </p>';
		}
	}

	 ?>

	</div>

	<div class="registerForm"><p>Need to Register? Click <a href="registerForm.php">Here</a></p></div>
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
