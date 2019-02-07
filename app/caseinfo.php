<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Case Information</title>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/styles.css">

		<!--[if lte IE 9]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
		<![endif]-->

	</head>

	<body>

		<?php

		// $username = $_SESSION['username'];

		if (isset($_GET["id"])) {
			$id = $_GET["id"];
		}

		$connection=mysqli_connect("db.soic.indiana.edu", "i494f18_team38", "my+sql=i494f18_team38", "i494f18_team38");

		if (!$connection) {
			die("Failed to connect to MySQL: " . mysqli_connect_error() );
		}

		$userQuery = mysqli_query($connection, "Select * from cases where id = $id");

		if (mysqli_num_rows($userQuery) > 0) {
			while ($row = mysqli_fetch_assoc($userQuery)) {

				echo "<p>Victim's ID: " . $row["id"] . "</p>";
				echo "<p>Victim's Name: " . $row["victim_first"] . " " . $row["victim_last"] . "</p>";
				echo "<p>Victim's Gender: " . $row["victim_gender"] . "</p>";
				echo "<p>Victim's Race: " . $row["victim_race"] . "</p>";
				echo "<p>Victim's Date of Birth: " . $row["victim_dob"] . "</p>";
				echo "<p>Crime Location: " . $row["city"] . ", " . $row["state"] . " " . $row["zip"] . "</p>";
				echo "<p>Victim's Cause of Death: " . $row["cause"] . "</p>";
				echo "<p>Crime Offense: " . $row["offense"] . "</p>";
				echo "<p>Year of Crime: " . $row["year"] . "</p>";
			}

		}

		 ?>


		 <a href="#"><p> Subscribe to case </p></a>


	</body>
</html>
