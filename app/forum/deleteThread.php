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
    session_start();

    $username = $_SESSION['username'];

    if (isset($_GET["id"])) {
      $id = $_GET["id"];
      //echo "This is the id: " . $id ;
    }

    $connection=mysqli_connect("db.soic.indiana.edu", "i494f18_team38", "my+sql=i494f18_team38", "i494f18_team38");

    if (!$connection) {
      die("Failed to connect to MySQL: " . mysqli_connect_error() );
    }

    $threadQuery = mysqli_query($connection, "SELECT * FROM Threads WHERE thread_id = $id;");
    echo "<h2>Delete Thread?</h2>";
    if (mysqli_num_rows($threadQuery) > 0) {
      while ($record = mysqli_fetch_assoc($threadQuery)) {
        echo "<h3>" . $record["thread_title"] . "</h3>";
        echo "<p>Votes:" . $record["votes"] . " <a href='#'>Upvote</a> <a href='#'>Downvote</a></p>";
        echo "<p>" . $record["thread_content"] . "</p>";
        echo "<p><a href='createReplyForm.php?id=$id'>Reply to Thread</a></p>";
      }
    }
    echo "<a href='deleteThreadProcess.php?id=$id'>Yes, Delete</a><br>";
    echo "<a href='viewThread.php?id=$id'>No, go back!</a>";