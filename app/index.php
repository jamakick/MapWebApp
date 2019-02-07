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

		<div id="map"></div>

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

		var map;

		function initMap() {
			map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: 37.0902, lng: -95.7129},
				zoom: 5
			});

		for (var i = 0; i < cases.length; i++) {
			var markerString = String(cases[i]) + "<a href='http://cgi.soic.indiana.edu/~team38/caseinfo.php?id=" + cases[i][0] + "'>Go to Case Details</a>";

			var marker = new google.maps.Marker({
			  	position: {lat: parseFloat(cases[i][12]), lng: parseFloat(cases[i][13])},
			  	map: map,
			  	title: "testTitle"
				});

			var infowindow = new google.maps.InfoWindow({
				content: markerString,
				maxWidth: 600
				});

			marker.addListener('click', function() {
				infowindow.open(map, marker);
			});

			}

		}

		</script>

		<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB_ZEJyvEqCczHBAYFHU28pUA1AMHYgOFg&callback=initMap" aysnc defer></script>

		<div class="sideView">
		<h1> SIDE PANEL FOR SEARCH RESULTS/MAP INFORMATION</h1>
		</div>


		<footer>
		<div class="footerDiv">
		<p>footer</p>
		</div>
		</footer>

	</body>
</html>
