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

    <h2>Edit Thread Reply</h2>


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

    //pull up original reply and populate it in the text box

    //lookup reply & fetch parent thread's ID

    $replyLookup = mysqli_query($connection, "SELECT * FROM Replies WHERE reply_id = $id;");

    while ($record = mysqli_fetch_assoc($replyLookup)) {
      $parentId = $record["reply_thread"];
      $replyText = $record["reply_content"];
    }

		if (!mysqli_num_rows($replyLookup)) {
      echo "There was a problem retrieving your reply: " . mysqli_error($connection);
    }

    echo "<form action='editReplyProcess.php?id=$id' method='POST'>";
	//	echo "The reply id should be: " . $id . " and the parent id should be " . $parentId;
    echo "<div class='editReplyForm'>Reply Content: <textarea name='content' required>$replyText</textarea></div>";
  ?>
    <div class="editReplyForm"><input type="submit" value="Submit"></div>
    <div class="editReplyForm"><input type="reset"></div>
  </form>

</body>

</html>
