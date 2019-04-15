<!doctype html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<title>Registering..</title>
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

		<?php

		function validate($item) {
			$item = htmlspecialchars(stripslashes(trim($item)));
			return $item;
		}

		$connection=mysqli_connect("db.soic.indiana.edu", "i494f18_team38", "my+sql=i494f18_team38", "i494f18_team38");

		if (!$connection) {
			die("Failed to connect to MySQL: " . mysqli_connect_error() );
		}

		$username = mysqli_real_escape_string($connection, validate($_POST['username']));

		$email = mysqli_real_escape_string($connection, validate($_POST['email']));

		$firstName = mysqli_real_escape_string($connection, validate($_POST['firstName']));

		$confirmPass = mysqli_real_escape_string($connection, validate($_POST['confirmPass']));

		$password = mysqli_real_escape_string($connection, validate($_POST['password']));

		$lastName = mysqli_real_escape_string($connection, validate($_POST['lastName']));

		$emailQuery = "SELECT user_email from users where email = '$email';";

		$userQuery = "SELECT username from users where username = '$username';";

		$fail = False;

		if (mysqli_num_rows(mysqli_query($connection, $emailQuery)) > 0) {
			$fail = True;
			header('Location: registerForm.php?response=email');
		}

		if (mysqli_num_rows(mysqli_query($connection, $userQuery)) > 0) {
			$fail = True;
			header('Location: registerForm.php?response=user');
		}

		mysqli_free_result($emailQuery);
		mysqli_free_result($userQuery);

		if ($password == $confirmPass) {

		$newPass = password_hash($password, PASSWORD_DEFAULT);

		$query = "INSERT INTO users (username, password, user_email, user_first, user_last) VALUES ('$username', '$newPass', '$email', '$firstName', '$lastName')";
		}

		else {
			header('Location: registerForm.php?response=pass');
		}
		if ($fail == False) {
		if (mysqli_query($connection, $query)) {
		echo "Account Created, redirecting to Login Page.";
		} else {
		die('SQL Error: ' . mysqli_error($connection));
		}

	}

		mysqli_close($connection);

		?>

		<script>

		document.onload = setTimeout(function () { window.location.replace("login.php") }, 2000);

		</script>


	</body>
</html>
