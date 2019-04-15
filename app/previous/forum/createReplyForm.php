<!doctype html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<title>Reply to Discussion Thread</title>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Stylesheets -->
		<link rel="stylesheet" href="../css/normalize.css">
		<link rel="stylesheet" href="../css/styles.css">
		<link rel="stylesheet" href="../css/styles2.css">

		<!--[if lte IE 9]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
		<![endif]-->
	</head>

	<body>

	<h1 id ="createReply">Create reply</h1>

	<h2>Reply to:</h2>
	<?php

		// $username = $_SESSION['username'];

		if (isset($_GET["id"])) {
			$id = $_GET["id"];
			$db = "Threads";
			$idName = "thread_id"; //Inelegant -- fix this
			$contentName = "thread_content";
		//	echo "Got parent thread information<br>";
		//	echo "This is the id: " . $id ;
		//	echo " This is the idName: " . $idName	;
		} elseif (isset($_GET["rid"])) {
			$id = $_GET["rid"];
			$db = "Replies";
			$idName = "reply_id"; // inelegant -- fix this
			$contentName = "reply_content";
		//	echo "Got parent reply information<br>";
		} else {
			echo "We were unable to locate the thread or reply you were replying to. Please try again.";
		}

		$connection= mysqli_connect("db.soic.indiana.edu", "i494f18_team38", "my+sql=i494f18_team38", "i494f18_team38");

		if (!$connection) {
			die("Failed to connect to MySQL: " . mysqli_connect_error() );
		}

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


	</body>
</html>
