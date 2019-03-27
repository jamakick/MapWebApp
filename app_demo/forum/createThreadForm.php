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
		<link rel="stylesheet" href="../framework/css/framework.css">
		
		<!--[if lte IE 9]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
		<![endif]-->
	</head>

	<body>
		<div class="ccc-box"><div class="ccc-box__body">

		<h1 id ="createThread">Create a New Forum Thread</h1>

		<form action="createThreadProcess.php" method="post">
		<div>
		<div class="createThreadForm">
			<label for="demo-3">Thread Title</label>
			<input type="text" id="demo-3" name="title" required>
		</div>
		<div class="createThreadForm">
			<label for="demo-3">Thread Content:</label>
			<textarea id="demo-3" class="ccc-m-bottom-md" name="content" required>Enter text here...</textarea>
		</div>
		<div class="response">

			<?php
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

		<div class="ccc-button ccc-button--success"><input type="submit" value="Submit"></div>
		<div class="ccc-button ccc-button--plain"><input type="reset">
		</div>

		</form>

		</div></div>
		</body>
	</html>
