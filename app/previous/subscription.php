<?php
session_start();
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Subscriptions</title>
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
					<a href="http://cgi.soic.indiana.edu/~team38/index.php"><h1>Cold Case Connection</h1></a>
					</div>
					<div class="row">
						<div class="six columns" id="searchBar">
							<form action="search/search.cgi">
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
						<div class="two columns">
						<?php
						if (isset($_SESSION['username'])) {
							echo '<a href="http://cgi.soic.indiana.edu/~team38/users/logout.php">Log Out</a>';
						}

						else if (!isset($_SESSION['username'])) {
							echo '<a href="http://cgi.soic.indiana.edu/~team38/users/login.php">Log In</a>';
						}
						?>
						</div>
		<div class="one column"><p>
		<?php
		if (isset($_SESSION['name'])) {
			echo $_SESSION['name'];
		 }
		 ?>
	 	</p></div>
					</div>
		</nav>
		
	<?php

	$connection=mysqli_connect("db.soic.indiana.edu", "i494f18_team38", "my+sql=i494f18_team38", "i494f18_team38");

	if (!$connection) {
		die("Failed to connect to MySQL: " . mysqli_connect_error() );
	}

	if (isset($_SESSION['username'])) {
		$username = mysqli_real_escape_string($connection, $_SESSION['username']);

		$subQuery = mysqli_query($connection, "Select subscription from users where username = '$username'");


		if (mysqli_num_rows($subQuery) > 0) {
			while ($row = mysqli_fetch_assoc($subQuery)) {
				echo "Your subscribed cases:";
				$subs = (string) $row["subscription"];}}


		else if (mysqli_num_rows($subQuery) == 0) {
			echo "You are not currently subscribed to any cases. ";
			$subs = "";
			echo "<a href='http://cgi.soic.indiana.edu/~team38/index.php'>Return to Home</a>";
		}

	}

	else if (!isset($_SESSION['username'])) {
		echo "You are not currently logged in to look at your subscribed cases.";
		$subs = "";
		echo "<a href='http://cgi.soic.indiana.edu/~team38/users/login.php'>Login</a>";
	}

	mysqli_free_result($subQuery);

	$userQuery = mysqli_query($connection, "Select * from cases");

	$allCases = array();

	if (mysqli_num_rows($userQuery) > 0) {
		while ($row = mysqli_fetch_assoc($userQuery)) {

			$oneCase = array(utf8_encode($row["id"]),
						utf8_encode($row["victim_first"]),
						utf8_encode($row["victim_last"]),
						utf8_encode($row["victim_gender"]),
						utf8_encode($row["victim_race"]),
						utf8_encode($row["victim_dob"]),
						utf8_encode($row["city"]),
						utf8_encode($row["state"]),
						utf8_encode($row["zip"]),
						utf8_encode($row["cause"]),
						utf8_encode($row["offense"]),
						utf8_encode($row["year"]),
						utf8_encode($row["lat"]),
						utf8_encode($row["longtd"]));

			array_push($allCases, $oneCase);

		}
		mysqli_free_result($userQuery);

	}
	mysqli_close($connection);

	?>

	<div id="results"></div>

	<script>

	var output = "";

	var results = document.getElementById("results");

	var cases = <?php echo json_encode($allCases) ?>;

	var subs = <?php echo json_encode($subs) ?>;

	for (i = 0; i < cases.length; i++) {
		if (subs.includes(cases[i][0])) {
			output += "<p>";
			output += cases[i].toString();
			output += "</p>";
			output += "<a href='http://cgi.soic.indiana.edu/~team38/caseinfo.php?id=" + cases[i][0] + "'>Go to Case Details</a><br>";
			output += "<a href='http://cgi.soic.indiana.edu/~team38/subscribe/removesub.php?id=" + cases[i][0] + "'>Remove from Subscribed Cases</a><hr>";
		}
	}

		results.innerHTML = output;

		</script>

	</script>
