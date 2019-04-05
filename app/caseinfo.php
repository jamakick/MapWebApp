<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Case Information</title>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="css/styles2.css">

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
						<div class="two columns">
						<?php
						if (isset($_SESSION['username'])) {
							echo '<a href="http://cgi.soic.indiana.edu/~marcmeng/app/users/logout.php">Log Out</a>';
						}

						else if (!isset($_SESSION['username'])) {
							echo '<a href="http://cgi.soic.indiana.edu/~marcmeng/app/users/login.php">Log In</a>';
						}
						?>
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

		<h2>Case Information</h2>

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
		/////////////////////////// END JAKE'S STUFF ///////////////////////

		$threadQuery = mysqli_query($connection, "Select * from Threads where thread_case = $id");
		$caseQuery = mysqli_query($connection, "Select victim_first, victim_last from cases where id = $id");

		if (mysqli_num_rows($caseQuery) > 0) {
			while ($record = mysqli_fetch_assoc($caseQuery)) {
				echo "<h2>Case Discussion: " . $record["victim_first"] . " " . $record["victim_last"] . "</h2>";
			}
		}

		echo "<table class='u-full-width'>";
		echo "<thead>";
		echo "<tr>";
		echo "<th>Thread Title</th>";
		echo "<th>Date</th>";
		echo "<th>Replies</th>";
		echo "<th>Votes</th>";
		echo "</tr>";
		echo "</thead>";

		if (mysqli_num_rows($threadQuery) > 0) {
			while ($row = mysqli_fetch_assoc($threadQuery)) {
				echo "<tbody>";
				echo "<tr>";
				echo "<td><a href='forum/viewThread.php?id=" . $row["thread_id"] . "'>" . $row["thread_title"] . "</a></td>";
				echo "<td>" . $row["thread_date"] . "</td>";
				echo "<td>" . $row["thread_replies"] . "</td>";
				echo "<td>" . $row["thread_votes"]  . "</td>";
				echo "</tr>";
				echo "</tbody>";

			}
		}

		echo "</table>";

		echo "<p><a href='forum/createThreadForm.php?id=$id'>Create new discussion thread</a></p>"

	?>


		 <a href="subscribe/addsub.php?id=<?php echo $id; ?>"><p> Subscribe to case </p></a>

		 <a href="index.php">Return to Home</a>


	</body>
</html>
