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

		<div class="forum">


		<?php


		$username = $_SESSION['username'];

		if (isset($_GET["id"])) {
			$id = $_GET["id"];
      //echo "This is the id: " . $id ;
		}

		$connection=mysqli_connect("db.soic.indiana.edu", "i494f18_team38", "my+sql=i494f18_team38", "i494f18_team38");

		if (!$connection) {
			die("Failed to connect to MySQL: " . mysqli_connect_error() );
		}

		$replyQuery = mysqli_query($connection, "Select * from Replies where reply_thread = $id;");
		$threadQuery = mysqli_query($connection, "Select * from Threads where thread_id = $id;");


		$userQuery = mysqli_query($connection, "Select user_id from users where username = '$username';");
		if (mysqli_num_rows($userQuery) > 0) {
			while ($user = mysqli_fetch_assoc($userQuery)) {
				$user_id = $user["user_id"];
			//	echo "Confirmed user ID";
			}
		}


		if (mysqli_num_rows($threadQuery) > 0) {
			while ($record = mysqli_fetch_assoc($threadQuery)) {
				echo "<h1>Case Discussion: </h1>";
        echo "<h2>" . $record["thread_title"] . "</h2>";
        echo "<p>Votes: " . $record["thread_votes"] . " <a class='button' href='vote.php?type=up&id=$id'>Upvote</a> <a class='button' href='vote.php?type=down&id=$id'>Downvote</a></p>";
        echo "<p>" . $record["thread_content"] . "</p>";
        echo "<p><a class='button' href='createReplyForm.php?id=$id'>Reply to Thread</a></p>";
				if ($user_id == $record["thread_by"]) {
					echo "<p><a href='deleteThread.php?id=$id'>Delete Thread</a></p>";
				}
			}
		}


		if (mysqli_num_rows($replyQuery) > 0) {
      echo "<table class='u-full-width'>";
      echo "<tr>";
      echo "<th>Username</th>";
      echo "<th>Reply text</th>";
      echo "<th>Date</th>";
      echo "<th>Replies</th>";
      echo "<th>Votes</th>";
      echo "</tr>";

			while ($row = mysqli_fetch_assoc($replyQuery)) {

        $authorId = $row["reply_by"];

        $replyId = $row["reply_id"];

        $authorQuery = mysqli_query($connection, "Select username from users where user_id = $authorId;");

        while ($record = mysqli_fetch_assoc($authorQuery)) {
          $replyAuthor = $record["username"];
        }

        //echo "<p>This is the author of the reply: " . $replyAuthor . "</p>";


				echo "<tr>";
				echo "<td>" . $replyAuthor . "</td>";
        echo "<td>" . $row["reply_content"] . "</td>";
				echo "<td>" . $row["reply_date"] . "</td>";
				echo "<td>" . $row["reply_replies"] . "</td>";
				echo "<td>" . $row["reply_votes"]  . "</td>";
				echo "<td><a href='vote.php?type=up&rid=$replyId'>Upvote</a></td>";
				echo "<td><a href='vote.php?type=down&rid=$replyId'>Downvote</a></td>";
				if ($user_id == $authorId) {
					echo "<td><a href='deleteReply.php?id=$replyId'>Delete</a></td>";
					echo "<td><a href='editReplyForm.php?id=$replyId'>Edit</a></td>";
				}
				echo "</tr>";

			}
		} else {
      echo "There are no replies yet.";
    }

		echo "</table>";
		mysqli_free_result($replyQuery);
		mysqli_free_result($threadQuery);

 ?>
		</div>


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
