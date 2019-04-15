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
            <form action="search/search.cgi">
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
    echo $_SESSION['name'];
   }
   ?>
 	</p></div>
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
