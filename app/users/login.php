<?php
session_start();

// if (isset($_SESSION['username'])) {
// 	header("Location: ../index.html");
// };

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

		<!--[if lte IE 9]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
		<![endif]-->
	</head>

	<body>

	<h1 id ="register"> Log In </h1>

	<form action="login-process.php" method="post">
	<div>
	<div class="registerForm">Username: <input type="text" name="username" required></div>
	<div class="registerForm">Password: <input type="password" name="password" required></div>

	<div class="registerForm"><input type="submit" value="Submit"></div>

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


	</body>
</html>
