<?php
session_start();
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Add Subscription</title>
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
							<li><a href="http://cgi.soic.indiana.edu/~team38/users/login.php">Profile</a></li>
							<li><a href="http://cgi.soic.indiana.edu/~team38/subscription.php">Subscriptions</a></li>
						</ul>
					</div>
		</nav>

<?php

if (isset($_GET["id"])) {
	$id = $_GET["id"];
}

$connection=mysqli_connect("db.soic.indiana.edu", "i494f18_team38", "my+sql=i494f18_team38", "i494f18_team38");

if (!$connection) {
	die("Failed to connect to MySQL: " . mysqli_connect_error() );
}

if (isset($_SESSION['username'])) {
	$username = mysqli_real_escape_string($connection, $_SESSION['username']);

	$subQuery = mysqli_query($connection, "Select subscription from users where username = '$username'");


	if (mysqli_num_rows($subQuery) > 0) {
		while ($row = mysqli_fetch_assoc($subQuery)) {
			$subs = (string) $row['subscription'];

			if (strpos($subs, $id) !== false) {
				echo 'You are already subscribed to this case.';
				echo "<a href='../caseinfo.php?id=$id'>Return to Case Details</a>";
			}

			else if (strpos($subs, $id) !== true) {
				$subs = $subs . " " . (string) $id;

				mysqli_query($connection, "Update users set subscription = '$subs' where username = '$username'");
				mysqli_commit($connection);

				echo "Case added to subscriptions";
				echo "<a href='../caseinfo.php?id=$id'>Return to Case Details</a>";


			}
						}}

	else if (mysqli_num_rows($subQuery) == 0) {
		$subs = (string) $id;

		mysqli_query($connection, "Update users set subscription = '$subs' where username = '$username'");
		mysqli_commit($connection);

		echo "Case added to subscriptions";
		echo "No cases";
		echo "<a href='../caseinfo.php?id=$id'>Return to Case Details</a>";
	}


}

else if (!isset($_SESSION['username'])) {
	echo "You are not currently logged in to subscribe to a case. ";
	echo "<a href='../caseinfo.php?id=$id'>Return to Case Details</a>";
}


?>
