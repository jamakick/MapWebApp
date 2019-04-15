<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Cold Case Connection</title>
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
					</div>


			<?php
			session_start();
			if (isset ($_SESSION["username"])) {
				$username = $_SESSION["username"];
			}
			if (isset($_GET["id"])) {
				$id = $_GET["id"]; //this is the case ID
			}

			$connection=mysqli_connect("db.soic.indiana.edu", "i494f18_team38", "my+sql=i494f18_team38", "i494f18_team38");

			if (!$connection) {
				die("Failed to connect to MySQL: " . mysqli_connect_error() );
			}

			echo "<div class='row'><h1 id ='createThread'>Create a New Forum Thread</h1></div>";

			$nameQuery = mysqli_query($connection, "SELECT * FROM cases WHERE id = $id;");


			while ($case = mysqli_fetch_assoc($nameQuery)) {
				$first_name = $case["victim_first"];
				$last_name = $case["victim_last"];

			}

			echo "<p><a href='../index.php'>Home</a> / <a href='../caseinfo.php?id=$id'>Case Info: $first_name $last_name </a> /<a href='../caseinfo.php?id=$id#discussion'> Case Discussion </a>/ Create Discussion Thread</p>";

			echo "<form action='createThreadProcess.php?id=$id' method='post'>";
			echo "<div class='row'>";
			echo "<div class='six columns'><label>Thread Title</label> <input class='u-full-width' type='text' name='title' placeholder = 'Enter title here...' required></div>";
			echo "</div>";
			echo "<div class='row'>";
			echo "<div class='six columns'><label>Thread Content</label> <textarea class='u-full-width' name='content' placeholder = 'Enter text here... 'required></textarea></div>";
			echo "</div>";

			echo "<div class='response'>";


				if($_GET) {
					$response = $_GET['response'];
					if (strcmp($response, "title") == 0) {
						echo '<p>You must include a title with your thread.</p>';
					}
					if (strcmp($response, "content") == 0) {
						echo '<p>The body of your post must include some content.</p>';
					}
				}
				?>

			</div>

			<div class="createThreadForm"><input class="button-primary" type="submit" value="Submit"></div>
			<div class="createThreadForm"><input type="reset"></div>

			</form>

			<footer>
			<div class="footerDiv2">

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
