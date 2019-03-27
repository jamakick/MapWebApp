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
										<form action="search/search.cgi">
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
				<br>
		<div class="profile">
		<h1>User Profile information</h1>
		</div>

		<div class="content">

			<?php
			if (!isset($_SESSION['username'])) {
				echo '<p>You are not currently logged in to view your profile.</p>';
			}
			?>

			<p id="info"></p>

			<?php  $connection=mysqli_connect("db.soic.indiana.edu", "i494f18_team38", "my+sql=i494f18_team38", "i494f18_team38");

			if (!$connection) {
				die("Failed to connect to MySQL: " . mysqli_connect_error() );
			}

			$user = $_SESSION['username'];

			$userQuery = mysqli_query($connection, "Select * from users where username = '$user'");

			if (mysqli_num_rows($userQuery) > 0) {
				while ($row = mysqli_fetch_assoc($userQuery)) {

					$oneCase = array(utf8_encode($row["user_id"]),
								utf8_encode($row["user_email"]),
								utf8_encode($row["user_first"]),
								utf8_encode($row["user_last"]),
								utf8_encode($row["username"]),
								utf8_encode($row["browsing_history"]));

				}
				mysqli_free_result($userQuery);

			}
			mysqli_close($connection);

			?>

			<script>

			var info = <?php echo json_encode($oneCase) ?>;

			var infoHolder = document.getElementById("info");

			infoHolder.innerHTML = info;

			</script>

		</div>


		<footer>
		<div class="footerDiv">
		<p>footer</p>
		</div>
		</footer>
		</div></div>
	</body>
</html>