<?php
session_start();
?>
<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Remove Subscription</title>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<link rel="stylesheet" href="../css/normalize.css">
		<link rel="stylesheet" href="../css/styles.css">
		<link rel="stylesheet" href="../css/styles2.css">

		<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">


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

				$subs = str_replace($id, "", $subs);

				if ($subs[0] == " ") {
					$subs = substr($subs, 1);
				}

				mysqli_query($connection, "Update users set subscription = '$subs' where username = '$username'");
				mysqli_commit($connection);

				header("Location: ../subscription.php");


			}
						}}

	else if (mysqli_num_rows($subQuery) == 0) {
		echo 'You are not subscribed to any cases.';
		echo "<a href='http://cgi.soic.indiana.edu/~team38/subscription.php'>Return to Subscriptions</a>";
	}


}

else if (!isset($_SESSION['username'])) {
	echo "You are not currently logged in to unsubscribe to a case. ";
	echo "<a href='http://cgi.soic.indiana.edu/~team38/index.php'>Return to Home</a>";
}


?>

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
