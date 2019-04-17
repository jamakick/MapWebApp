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

		$email = $_POST['email'];

		$confirmPass = mysqli_real_escape_string($connection, validate($_POST['confirmPass']));

		$password = mysqli_real_escape_string($connection, validate($_POST['password']));

		$fail = False;

		if ($password == $confirmPass) {

		$newPass = password_hash($password, PASSWORD_DEFAULT);

		$query = "UPDATE users set password = '$newPass' where user_email = '$email'";
		}

		else {
			header('Location: resetPassProcess3.php?response=pass&email=' . $email);
		}
		if ($fail == False) {
		if (mysqli_query($connection, $query)) {
		mysqli_commit($connection);
		echo "Password Changed, redirecting to Login Page.";
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
