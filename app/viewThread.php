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
					<a href="../index.php"><h1>Cold Case Connection</h1></a>
					</div>
					<div class="menuLinks">
						<ul>
							<li><a href="#">Search</a></li>
							<li><a href="#">Profile</a></li>
							<li><a href="#">Subscriptions</a></li>
						</ul>
					</div>
		</nav>

		<div class="forum">


		<?php
<<<<<<< Updated upstream

		// $username = $_SESSION['username'];
=======
		session_start();

		$username = $_SESSION['username'];
>>>>>>> Stashed changes

		if (isset($_GET["id"])) {
			$id = $_GET["id"];
      //echo "This is the id: " . $id ;
		}

		$connection=mysqli_connect("db.soic.indiana.edu", "i494f18_team38", "my+sql=i494f18_team38", "i494f18_team38");

		if (!$connection) {
			die("Failed to connect to MySQL: " . mysqli_connect_error() );
		}

<<<<<<< Updated upstream
		$replyQuery = mysqli_query($connection, "Select * from Replies where reply_thread = $id;"); #dynamically generated
		$caseQuery = mysqli_query($connection, "Select * from Threads where thread_id = $id;"); #dynamically generated

		if (mysqli_num_rows($caseQuery) > 0) {
			while ($record = mysqli_fetch_assoc($caseQuery)) {
=======
		$userQuery = mysqli_query($connection, "Select user_id from users where username = '$username';");
		if (mysqli_num_rows($userQuery) > 0) {
			while ($user = mysqli_fetch_assoc($userQuery)) {
				$user_id = $user["user_id"];
			//	echo "Confirmed user ID";
			}
		}

		$replyQuery = mysqli_query($connection, "Select * from Replies where reply_thread = $id;");
		$threadQuery = mysqli_query($connection, "Select * from Threads where thread_id = $id;");


		if (mysqli_num_rows($threadQuery) > 0) {
			while ($record = mysqli_fetch_assoc($threadQuery)) {
>>>>>>> Stashed changes
				echo "<h1>Case Discussion: </h1>";
        echo "<h2>" . $record["thread_title"] . "</h2>";
        echo "<p>Votes:" . $record["votes"] . " <a href='#'>Upvote</a> <a href='#'>Downvote</a></p>";
        echo "<p>" . $record["thread_content"] . "</p>";
        echo "<p><a href='createReplyForm.php?id=$id'>Reply to Thread</a></p>";
<<<<<<< Updated upstream
=======
				if ($user_id == $record["thread_by"]) {
					echo "<p><a href='#'>Delete Thread</a></p>";
				}
>>>>>>> Stashed changes
			}
		}




		if (mysqli_num_rows($replyQuery) > 0) {
      echo "<table border=1px>";
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
        echo "<td><a href='createReplyForm.php?rid=$replyId'>Reply</a></td>";
        echo "<td><a href='#'>Report</a></td>";
<<<<<<< Updated upstream
=======
				if ($user_id == $authorId) {
					echo "<td><a href='#'>Delete Thread</a></td>";
				}
>>>>>>> Stashed changes
				echo "</tr>";

			}
		} else {
      echo "There are no replies yet.";
    }

		echo "</table>";

		 ?>
		</div>


		<footer>
		<div class="footerDiv">
		<p>footer</p>
		</div>
		</footer>

	</body>
</html>
