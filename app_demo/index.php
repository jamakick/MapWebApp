<?php
session_start();
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Cold Case Connection</title>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="css/normalize.css">
		<link rel="stylesheet" href="css/styles.css">
		<link rel="stylesheet" href="framework/css/framework.css">

		<!--[if lte IE 9]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
		<![endif]-->

	</head>

	<body>
	<div class="ccc-box"><div class="ccc-box__body">
		<nav role="navigation">
					<div class="logo">
					<a href="http://cgi.soic.indiana.edu/~team38/app/index.php"><h1>Cold Case Connection</h1></a>
					</div>
					
					<div class="ccc-container ccc-container--center">
						<div class="ccc-grid">
							<div class="ccc-grid__item-8-md-up">
								<form action="../search/search.cgi">
									<div class="ccc-input-group">
										<input class="ccc-input-group__input" type="text" name ="terms">
										<div class="ccc-input-group__append">
											<input class="ccc-button" type="submit" value="Search">
										</div>
									</div>
								</form>
							</div>
							<div class="ccc-grid__item">
								<button class="ccc-button ccc-button--plain"><a href="http://cgi.soic.indiana.edu/~team38/app/subscription.php">Subscriptions</a></button>
							</div>
							<div class="ccc-grid__item">
								<button class="ccc-button ccc-button--plain"><a href="http://cgi.soic.indiana.edu/~team38/app/profile.php">Profile</a></button>
							</div>
							<div class="ccc-grid__item">
								<button class="ccc-button ccc-button--plain">
									<?php
									if (isset($_SESSION['username'])) {
										echo '<a href="http://cgi.soic.indiana.edu/~team38/app/users/logout.php">Log Out</a>';
									}

									else if (!isset($_SESSION['username'])) {
										echo '<a href="http://cgi.soic.indiana.edu/~team38/app/users/login.php">Log In</a>';
									}
									?>
								</button>
							</div>
							<p>
							<?php
							if (isset($_SESSION['name'])) {
								echo $_SESSION['name'];
							 }
							 ?>
						 	</p>
						</div>
					</div>
		</nav>
	</div></div>
	
		<div class="ccc-container"><br>
			<div class="ccc-grid">
				<div class="ccc-grid__item-8-md-up">
					<div id="map"></div>
				</div>
				<div class="rvt-grid__item-4-md-up">
					<span>SIDE PANEL GOES HERE</span>
				</div>
			</div>
		</div>

		<div class="ccc-box"><div class="ccc-box__body">
		<?php  $connection=mysqli_connect("db.soic.indiana.edu", "i494f18_team38", "my+sql=i494f18_team38", "i494f18_team38");

		if (!$connection) {
			die("Failed to connect to MySQL: " . mysqli_connect_error() );
		}

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

		<script>

		var cases = <?php echo json_encode($allCases) ?>;

		if (window.location.search) {

		var searchIDs = window.location.search.split("=")[1].split(",");

		console.log(searchIDs);

		var newCases = new Array();

		for (var i = 0; i < cases.length; i++) {
			if (searchIDs.includes(cases[i][0])) {
				newCases.push(cases[i])
			}
		}

		cases = newCases;

		}

		var map;

		var markers = []

		function createMarker(location, title, infoString) {
			var marker = new google.maps.Marker({
				position: location,
				map: map,
				title: title
			});

			var infowindow = new google.maps.InfoWindow({
				content: infoString,
				maxWidth: 600
			});

			markers.push(marker);

			google.maps.event.addListener(marker, 'click', function() {
				infowindow.open(map, marker);
			});
		}

		function initMap() {
			map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: 37.0902, lng: -95.7129},
				zoom: 5
			});

		for (var i = 0; i < cases.length; i++) {
			var markerString = String(cases[i]) + "<a href='http://cgi.soic.indiana.edu/~team38/app/caseinfo.php?id=" + cases[i][0] + "'>Go to Case Details</a>";
			var position = {lat: parseFloat(cases[i][12]), lng: parseFloat(cases[i][13])};

			createMarker(position, "testTitle", markerString);

			}

		}

		</script>

		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_ZEJyvEqCczHBAYFHU28pUA1AMHYgOFg&callback=initMap" aysnc defer></script>

		<div id="sideView">


		<div id="results">

		<script>

		var output = "";

		var results = document.getElementById("results");

		for (var i = 0; i < cases.length; i++) {
			output += "<p>";
			output += cases[i].toString();
			output += "</p>";
			output += "<a href='http://cgi.soic.indiana.edu/~team38/app/caseinfo.php?id=" + cases[i][0] + "'>Go to Case Details</a><hr>";
		}

		results.innerHTML = output;

		</script>

		</div>

		</div>

		<footer>
		<div class="footerDiv">
		<p>footer</p>
		</div>
		</footer>
		</div></div>
	</body>
</html>
