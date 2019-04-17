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

				echo "<div class='victiminfo'>";
				echo "<p>Victim's Name: " . $row["victim_first"] . " " . $row["victim_last"] . "</p>";
				echo "<p>Victim's Gender: " . $row["victim_gender"] . "</p>";
				echo "<p>Victim's Race: " . $row["victim_race"] . "</p>";
				echo "<p>Victim's Date of Birth: " . $row["victim_dob"] . "</p>";
				echo "<p>Crime Location: " . $row["city"] . ", " . $row["state"] . " " . $row["zip"] . "</p>";
				echo "<p>Victim's Cause of Death: " . $row["cause"] . "</p>";
				echo "<p>Crime Offense: " . $row["offense"] . "</p>";
				echo "<p>Year of Crime: " . $row["year"] . "</p></div>";

				echo "<img class='caseImg' src='imgs/" . $row["img"] . "'>";
			}

		}
		/////////////////////////// END JAKE'S STUFF ///////////////////////

		echo "<h2>Case Summary</h2><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Curabitur dapibus a tortor consectetur scelerisque. Nullam tempus id ipsum nec mattis. Suspendisse tristique, lorem a feugiat varius, mi eros laoreet nunc, id pharetra arcu nisl vel lorem. Maecenas ut diam id eros semper aliquam ac quis felis. Sed purus ante, feugiat ut tempor nec, ultricies at nisi. Proin nec sapien suscipit, cursus nulla semper, bibendum dolor. Mauris id arcu sit amet sapien convallis viverra. Curabitur nec mauris a libero luctus molestie ut sed elit. Etiam iaculis purus at vestibulum feugiat. Morbi mi enim, efficitur a feugiat quis, condimentum id dolor.

Cras lobortis vestibulum justo rutrum ultrices. Donec sodales, lacus quis feugiat elementum, lacus eros imperdiet risus, non aliquam dolor nisi in elit. Sed in justo at est pretium tincidunt nec id eros. Suspendisse et arcu tincidunt, molestie est ac, commodo ex. Nullam in magna dolor. Nulla lorem augue, fringilla quis massa eu, pharetra ultrices risus. Duis dapibus quam id massa imperdiet vestibulum. Phasellus viverra mi id pulvinar interdum. Integer quis consequat augue. Nam suscipit dictum ipsum, tincidunt convallis risus auctor eu. Ut sed sem lacinia, vulputate tortor ut, interdum risus. Donec eleifend egestas elit, ut viverra erat viverra at. Aliquam facilisis mi eu ornare viverra. Aenean vulputate ipsum libero, rutrum ullamcorper enim elementum at. Vestibulum eu ligula sed nisl suscipit placerat.

Nulla a turpis sit amet nisl rutrum pharetra at et risus. Nunc egestas vitae sem at convallis. Phasellus auctor eros accumsan hendrerit vulputate. Donec non dui ultricies ligula pharetra interdum. Vestibulum feugiat leo metus, et gravida ante luctus a. Nulla facilisi. Nulla ante ante, feugiat vel nisi a, pulvinar facilisis urna. Nunc velit elit, sodales a metus non, aliquet sollicitudin ante. Aliquam iaculis, turpis nec iaculis tempor, felis arcu aliquet magna, eu placerat dolor odio id dui. In quam felis, consequat tempus rhoncus nec, faucibus a purus. In maximus lectus risus, quis sodales eros egestas et. Praesent at sem nec nibh vehicula condimentum. Morbi commodo metus a urna elementum tincidunt. Pellentesque eu dictum neque. Etiam nec porttitor purus, quis suscipit turpis. Proin ac augue aliquam, congue mi eget, vulputate mauris.</p>" ;

		echo "<h2>Photos</h2><p>Note: Photos are uploaded by users and are subject to our Terms of Service.</p>";
		echo "<div class='gallery'>";
		$gallery_dir = "uploads/";

		//iterate over all the photos in /uploads

		foreach (glob("$gallery_dir{*.jpg,*.png,*.jpeg}", GLOB_BRACE) as $img) {
			//get just the basename of the image
			$img_name = explode("/", $img);
			$img_name = end($img_name);

			echo "<a href='$img' title='$img_name'>";
			echo "<div style='float:left; border:1px solid black; width:250px; height:250px; padding:10px; margin:10px; text-align:center;'>";
			echo "<img src='$img' style='height:100%; width:100%; object-fit:contain;'><br><span>$imgName</span>";
			echo "</div>";
			echo "</a>";
		}
			echo "</div>";
		?>

		<form action='forum/upload.php?id=<?php echo $id; ?>' method='post' enctype='multipart/form-data'>
			Select an image to upload:
			<input type="file" name="toUpload" id="toUpload" required>
			<br><input type="submit" value="Upload Image" name="submit">
	   </form>

	   <?php

		$threadQuery = mysqli_query($connection, "Select * from Threads where thread_case = $id");
		$caseQuery = mysqli_query($connection, "Select victim_first, victim_last from cases where id = $id");

		if (mysqli_num_rows($caseQuery) > 0) {
			while ($record = mysqli_fetch_assoc($caseQuery)) {
				echo "<h2 id='discussion'>Case Discussion: " . $record["victim_first"] . " " . $record["victim_last"] . "</h2>";
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

		echo "<p><a class='button' href='forum/createThreadForm.php?id=$id'>Create new discussion thread</a></p>";


	?>

		 <a href="subscribe/addsub.php?id=<?php echo $id; ?>"><p class="button"> Subscribe to case </p></a>

		 <a class="button" href="index.php">Return to Home</a>

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
