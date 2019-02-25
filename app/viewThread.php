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

		// $username = $_SESSION['username'];

		if (isset($_GET["id"])) {
			$id = $_GET["id"];
      //echo "This is the id: " . $id ;
		}

		$connection=mysqli_connect("db.soic.indiana.edu", "i494f18_team38", "my+sql=i494f18_team38", "i494f18_team38");

		if (!$connection) {
			die("Failed to connect to MySQL: " . mysqli_connect_error() );
		}

		$replyQuery = mysqli_query($connection, "Select * from Replies where reply_thread = $id"); #dynamically generated
		$caseQuery = mysqli_query($connection, "Select * from Threads where thread_id = $id"); #dynamically generated

		if (mysqli_num_rows($caseQuery) > 0) {
			while ($record = mysqli_fetch_assoc($caseQuery)) {
				echo "<h1>Case Discussion: </h1>";
        echo "<h2>" . $record["thread_title"] . "</h2>";
        echo "<p>Votes:" . $record["votes"] . " <a href='#'>Upvote</a> <a href='#'>Downvote</a></p>";
        echo "<p>" . $record["thread_content"] . "</p>";
        echo "<p><a href='createThreadForm.php?id=$id'>Reply to Thread</a></p>";
			}
		}




		if (mysqli_num_rows($replyQuery) > 0) {
      echo "<table border=1px>";
      echo "<tr>";
      echo "<th>Username</th>";
      echo "<th>Reply text</th>";
      echo "<th>Date</th>";
      echo "<th>Votes</th>";
      echo "</tr>";
			while ($row = mysqli_fetch_assoc($replyQuery)) {

        $authorId = $row["reply_by"];

        $replyId = $row["reply_id"];

        $replyAuthor = mysqli_query($connection, "Select username from users where id = $authorId;");


				echo "<tr>";
				echo "<td>" . $replyAuthor . "</td>";
				echo "<td>" . $row["thread_date"] . "</td>";
				echo "<td>" . $row["thread_replies"] . "</td>";
				echo "<td>" . $row["thread_votes"]  . "</td>";
        echo "<td><a href='createReplyForm.php?rid=$replyId'>Reply</a></td>";
				echo "</tr>";

			}
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
