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
		<link rel="stylesheet" href="css/styles2.css">

		<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">


		<!--[if lte IE 9]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
		<![endif]-->

	</head>

	<body>

		<nav role="navigation">
			<div>
			<a href="http://cgi.soic.indiana.edu/~team38/index.php"><h1 class="logo">Cold Case Connection</h1></a>
			</div>
			<div class="row">
				<div class="seven columns" id="searchBar">
					<form action="search/search.cgi">
						<input class="eight columns" type="text" name ="terms">
						<input class="four columns button-primary" type="submit" value="Search">
					</form>
				</div>
				<div class="five columns">
					<a href="http://cgi.soic.indiana.edu/~team38/profile.php">Profile</a>&emsp;&emsp;
					<a href="http://cgi.soic.indiana.edu/~team38/subscription.php ">Subscriptions</a>&emsp;&emsp;
					<?php
					if (isset($_SESSION['username'])) {
						echo '<a href="http://cgi.soic.indiana.edu/~team38/users/logout.php">Log Out</a>&emsp;&emsp;';
					}

					else if (!isset($_SESSION['username'])) {
						echo '<a href="http://cgi.soic.indiana.edu/~team38/users/login.php">Log In</a>&emsp;&emsp;';
					}
					?>
					<i>
					<?php
					if (isset($_SESSION['name'])) {
						echo "Hello, " . $_SESSION['name'];
					 }
					 ?>
				 	</i>
				</div>
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
		var allCases = cases;

		if (window.location.search) {

		var searchIDs = window.location.search.split("=")[1].split(",");

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
		var allMarkers = []

		function createMarker(location, title, infoString, markerIcon) {
			var marker = new google.maps.Marker({
				position: location,
				map: map,
				title: title,
				icon: markerIcon
			});

			markers.push(marker);

			marker.addListener('click', function() {
				map.setZoom(10);
				map.setCenter(marker.getPosition());

				var collapse = document.getElementsByClassName("collapse");
				var i;

				for (i = 0; i < collapse.length; i++) {
					var content = collapse[i].nextElementSibling;
					content.style.display = "none";
					collapse[i].classList.remove("active");
				}

				var id = markers.indexOf(marker);

				content = collapse[id].nextElementSibling;

				if (content.style.display == "block") {
					content.style.display = "none";
				}
				else {
					content.style.display = "block";
				}

				var topPos = content.offsetTop - 400;
				document.getElementById("sideView").scrollTop = topPos;
			});
		}

		function initMap() {
			map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: 37.0902, lng: -95.7129},
				zoom: 5
			});

		for (var i = 0; i < cases.length; i++) {
			var markerString = String(cases[i]) + "<a href='http://cgi.soic.indiana.edu/~team38/caseinfo.php?id=" + cases[i][0] + "'>Go to Case Details</a>";
			var position = {lat: parseFloat(cases[i][12]), lng: parseFloat(cases[i][13])};

			var icon = cases[i][10];

			var iconImg;

			switch (icon) {

				case "murder":
					iconImg = "http://cgi.soic.indiana.edu/~team38/icons/murder.svg";
					break;
				case "hit and run":
					iconImg = "http://cgi.soic.indiana.edu/~team38/icons/hit_and_run.svg";
					break;
				case "kidnapping":
					iconImg = "http://cgi.soic.indiana.edu/~team38/icons/kidnapping.svg";
					break;
				case "missing presumed dead":
					iconImg = "http://cgi.soic.indiana.edu/~team38/icons/missing.svg";
					break;
			}

			console.log(iconImg);

			createMarker(position, "Click to Zoom", markerString, iconImg);

			}

		for (var i = 0; i < allCases.length; i++) {

			var location = {lat: parseFloat(allCases[i][12]), lng: parseFloat(allCases[i][13])};


			var marker = new google.maps.Marker({
				position: location,
				map: map,
				title: "None"
			});

			allMarkers.push(marker);

			marker.setMap(null);

		}

		}

		</script>

		<script src="https://maps.googleapis.com/maps/api/js?key=Nonecallback=initMap" aysnc defer></script>

		<div id="sideView">

		<div id="results">

		</div>

		</div>

		<script>

		var output = "";

		var results = document.getElementById("results");

		for (var i = 0; i < cases.length; i++) {
			output += '<button class="collapse">';
			output += cases[i][1] + " " + cases[i][2];
			output += " - " + cases[i][6] + ", " + cases[i][7];
			output += '</button>';
			output += '<div class="sideResult" data-id="' + cases[i][0] + '"><p>';
			output += "<br>Name: " + cases[i][1] + " " + cases[i][2];
			output += "<br>Gender: " + cases[i][3];
			output += "<br>Nationality: " + cases[i][4];
			output += "</p>";
			output += "<a href='http://cgi.soic.indiana.edu/~team38/caseinfo.php?id=" + cases[i][0] + "'>Go to Case Details</a></div>";
		}

		results.innerHTML = output;


		var collapse = document.getElementsByClassName("collapse");
		var i;

		for (i = 0; i < collapse.length; i++) {
			collapse[i].addEventListener("click", function() {
			for (i = 0; i < collapse.length; i++) {
				var content = collapse[i].nextElementSibling;
				content.style.display = "none";
				collapse[i].classList.remove("active");
			}
			this.classList.toggle("active");
			var resultContent = this.nextElementSibling;
			var id = resultContent.getAttribute("data-id");
			map.setZoom(10);
			console.log(allMarkers[id - 1]);
			map.setCenter(allMarkers[id - 1].getPosition());
			if (resultContent.style.display == "block") {
				resultContent.style.display = "none";
			}
			else {
				resultContent.style.display = "block";
			}

		});
	}

		</script>

		<footer>
		<div class="footerDiv">

		<a href="http://cgi.soic.indiana.edu/~team38/index.php">Home</a>
		<a href="http://cgi.soic.indiana.edu/~team38/profile.php">Profile</a>
		<a href="http://cgi.soic.indiana.edu/~team38/subscription.php">Subscriptions</a>
		<?php
		if (isset($_SESSION['username'])) {
			echo '<a href="http://cgi.soic.indiana.edu/~team38/users/logout.php">Log Out</a>';
		}

		else if (!isset($_SESSION['username'])) {
			echo '<a href="http://cgi.soic.indiana.edu/~team38/users/login.php">Log In</a>';
		}
		?>

		</div>
		</footer>

	</body>
</html>
