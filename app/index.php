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

		<script>

		var map;
		function initMap() {
			map = new google.maps.Map(document.getElementById('map'), {
				center: {lat: 37.0902, lng: -95.7129},
				zoom: 5
			});
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
