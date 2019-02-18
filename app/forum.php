<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Cold Case Connection</title>
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
					<a href="index.html"><h1>Cold Case Connection</h1></a>
					</div>
					<div class="menuLinks">
						<ul>
							<li><a href="#">Search</a></li>
							<li><a href="#">Profile</a></li>
							<li><a href="#">Subscriptions</a></li>
						</ul>
					</div>
		</nav>

		<div class="forum">


		<?php

		// $username = $_SESSION['username'];

		if (isset($_GET["id"])) {
			$id = $_GET["id"];
		}

		$connection=mysqli_connect("db.soic.indiana.edu", "i494f18_team38", "my+sql=i494f18_team38", "i494f18_team38");

		if (!$connection) {
			die("Failed to connect to MySQL: " . mysqli_connect_error() );
		}

		$threadQuery = mysqli_query($connection, "Select * from Threads where thread_case = 13"); #hard coded for now
		$caseQuery = mysqli_query($connection, "Select victim_first, victim_last from cases where id = 13"); #also hard coded

		if (mysqli_num_rows($caseQuery) > 0) {
			while ($record = mysqli_fetch_assoc($caseQuery)) {
				echo "<h1>Case Discussion: " . $record["victim_first"] . " " . $record["victim_last"] . "</h1>";
			}
		}


		echo "<table border=1px>";
		echo "<tr>";
		echo "<th>Thread Title</th>";
		echo "<th>Date</th>";
		echo "<th>Replies</th>";
		echo "<th>Votes</th>";
		echo "</tr>";

		if (mysqli_num_rows($threadQuery) > 0) {
			while ($row = mysqli_fetch_assoc($threadQuery)) {


				echo "<tr>";
				echo "<td>" . $row["thread_title"] . "</td>";
				echo "<td>" . $row["thread_date"] . "</td>";
				echo "<td>17</td>"; #also hard coded for now
				echo "<td>398</td>"; #also hard coded for now
				echo "</tr>";

			}
		}

		echo "</table>";

		 ?>
		</div>


		<footer>
		<div class="footerDiv">
		<p>footer</p>
		</div>
		</footer>

	</body>
</html>