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
							<form action="http://cgi.soic.indiana.edu/~team38/search/search.cgi">
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
			echo "Hello, " . $_SESSION['name'];
		 }
		 ?>
	 	</p></div>
					</div>
		</nav>

		<?php

		$connection= mysqli_connect("db.soic.indiana.edu", "i494f18_team38", "my+sql=i494f18_team38", "i494f18_team38");

		if (!$connection) {
			die("Failed to connect to MySQL: " . mysqli_connect_error() );
		}

		$username = $_SESSION['username'];

		if (isset($_GET["id"])) {
			$id = $_GET["id"];
			$db = "Threads";
			$idName = "thread_id"; //Inelegant -- fix this
			$contentName = "thread_content";
			$isThread = true;

		} elseif (isset($_GET["rid"])) {
			$id = $_GET["rid"];
			$db = "Replies";
			$idName = "reply_id"; // inelegant -- fix this
			$contentName = "reply_content";
			$isThread = false;

		} else {
			echo "We were unable to locate the thread or reply you were replying to. Please try again.";
		}

		$caseQuery = mysqli_query($connection, "SELECT * FROM $db WHERE $idName = $id;");

		while ($record = mysqli_fetch_assoc($caseQuery)) {
			if ($isThread) {
				$case_id = $record["thread_case"];

			}
			else {
				$case_id = $record["reply_case"];
			}

		}

		$nameQuery = mysqli_query($connection, "SELECT * FROM cases WHERE id = $case_id;");


		while ($case = mysqli_fetch_assoc($nameQuery)) {
			$first_name = $case["victim_first"];
			$last_name = $case["victim_last"];

		}

		echo "<p><a href='../index.php'>Home</a> / <a href='../caseinfo.php?id=$case_id'>Case Info: $first_name $last_name </a> /<a href='../caseinfo.php?id=$case_id#discussion'> Case Discussion </a>/ Create Reply</p>";


	 	echo "<h1 id ='createReply'>Create reply</h1>" ;
	 	echo "<h2>Reply to:</h2>" ;



		$findParent = mysqli_query($connection, "SELECT * FROM $db WHERE $idName = $id;");

		if(!mysqli_num_rows($findParent)): {
				//the query failed, quit
				echo "An error occured finding the parent thread or reply." . mysqli_error($connection) . " Please try again later.";
		}
		else: {
				//echo "A parent thread or comment was found<br>";
				while ($record = mysqli_fetch_assoc($findParent)) {
					$content = $record[$contentName];
				}
				echo "<p>" . $content . "</p>";

			}
		endif;


	echo "<form action='createReplyProcess.php?id=$id' method='POST'>";
	?>
	<div>
	<div class="row">
	<div class="six columns"><label>Reply Content</label> <textarea class='u-full-width' name="content" required>Type your reply here:</textarea></div>
	</div>

	<div class="response">

 <!-- <? /*
		 if($_GET) {
			$response = $_GET['response'];
			if (strcmp($response, "content") == 0): {
				echo '<p>Your reply must include some content.</p>';
			}
		endif;
		}
	endif; */

	?> -->

	</div>

	<div class="createReplyForm"><input class="button-primary" type="submit" value="Submit"></div>
	<div class="createReplyForm"><input type="reset"></div>

</div>

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
