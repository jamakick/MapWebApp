<!doctype html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<title>Create Discussion Thread</title>
		<meta http-equiv="x-ua-compatible" content="ie=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Stylesheets -->
		<link rel="stylesheet" href="../css/normalize.css">
		<link rel="stylesheet" href="../css/styles.css">

		<!--[if lte IE 9]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
		<![endif]-->
	</head>

	<body>
	<?php
	if (isset($_GET["id"])) {
		$id = $_GET["id"]; //this is the case ID
	}

	echo "<h1 id ='createThread'>Create a New Forum Thread</h1>";

	echo "<form action='createThreadProcess.php?id=$id' method='post'>";
	echo "<div>";
	echo "<div class='createThreadForm'>Thread Title: <input type='text' name='title' required></div>";
	echo "<div class='createThreadForm'>Thread Content: <textarea name='content' required>Enter text here...</textarea></div>";

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

	<div class="createThreadForm"><input type="submit" value="Submit"></div>
	<div class="createThreadForm"><input type="reset">
	</div>

	</form>


	</body>
</html>
